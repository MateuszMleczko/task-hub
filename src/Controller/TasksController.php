<?php
declare(strict_types=1);

namespace App\Controller;

use App\Enum\TaskPriorityEnum;
use App\Enum\TaskStatusEnum;
use App\Model\Entity\Task;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $groups = $this->Tasks
            ->find()
            ->where([
                'Tasks.user_id' => $this->currentUserId(),
            ])
            ->contain(['Users'])
            ->all()
            ->groupBy('status')
            ->toArray();

        $empty = array_fill_keys(array_keys(TaskStatusEnum::getStatuses()), []);
        $tasks = array_replace($empty, $groups);
        $counts = array_map('count', $tasks);

        $this->set($this->getLabels());
        $this->set(compact('tasks', 'counts'));
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->getOwnTask($id);

        $this->set($this->getLabels());
        $this->set(compact('task'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            $task->user_id = $this->currentUserId();
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        $this->set('options', $this->getOptions());
        $this->set(compact('task'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->getOwnTask($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        $this->set('options', $this->getOptions());
        $this->set(compact('task'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->getOwnTask($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete done method
     *
     * Removes every task of the logged in user that has the "Done" status.
     *
     * @return \Cake\Http\Response|null Redirects to profile.
     */
    public function deleteDone()
    {
        $this->request->allowMethod(['post', 'delete']);

        if ($this->Tasks->deleteAll([
            'user_id' => $this->currentUserId(),
            'status' => TaskStatusEnum::DONE,
        ])) {
            $this->Flash->success(__('Completed tasks have been deleted.'));
        } else {
            $this->Flash->error(__('Deleting completed tasks failed. Try again later.'));
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'profile']);
    }

    /**
     * Change status method
     *
     * Moves a task to another board column.
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response Json payload telling whether the status was changed.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When the task is missing or belongs to another user.
     */
    public function changeStatus($id = null)
    {
        $this->request->allowMethod(['post']);

        $task = $this->getOwnTask($id);
        $task = $this->Tasks->patchEntity($task, [
            'status' => $this->request->getData('status'),
        ]);
        $saved = (bool)$this->Tasks->save($task);

        return $this->response
            ->withStatus($saved ? 200 : 422)
            ->withType('application/json')
            ->withStringBody((string)json_encode(['success' => $saved]));
    }

    /**
     * Translated labels and css accent slugs for status / priority, keyed by enum value.
     *
     * @return array<string, array<int, string>>
     */
    private function getLabels(): array
    {
        return [
            'statuses' => TaskStatusEnum::getStatuses(),
            'priorities' => TaskPriorityEnum::getPriorities(),
            'statusAccents' => TaskStatusEnum::getAccents(),
            'priorityAccents' => TaskPriorityEnum::getAccents(),
        ];
    }

    private function getOptions(): array
    {
        return [
            'statuses' => $this->buildRadioOptions(TaskStatusEnum::getStatuses(), TaskStatusEnum::getAccents()),
            'priorities' => $this->buildRadioOptions(TaskPriorityEnum::getPriorities(), TaskPriorityEnum::getAccents()),
        ];
    }

    /**
     * Builds FormHelper radio options with an accent modifier class per value (status / priority tiles).
     *
     * @param array<int, string> $labels Value => translated label.
     * @param array<int, string> $accents Value => css modifier slug.
     * @return array<int, array<string, mixed>>
     */
    private function buildRadioOptions(array $labels, array $accents): array
    {
        $options = [];
        foreach ($labels as $value => $text) {
            $options[] = [
                'value' => $value,
                'text' => $text,
                'class' => 'task-form__tile-input task-form__tile-input--' . $accents[$value],
            ];
        }

        return $options;
    }

    /**
     * Loads a task by id limited to the logged in user, so nobody can reach
     * somebody else's task by changing the id in the url.
     *
     * @param string|null $id Task id.
     * @return \App\Model\Entity\Task
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When the task is missing or belongs to another user.
     */
    private function getOwnTask(?string $id): Task
    {
        return $this->Tasks->get($id, conditions: ['Tasks.user_id' => $this->currentUserId()]);
    }
}
