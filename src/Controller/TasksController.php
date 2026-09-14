<?php
declare(strict_types=1);

namespace App\Controller;

use App\Enum\TaskPriorityEnum;
use App\Enum\TaskStatusEnum;

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
        $tasks = $this->Tasks
            ->find()
            ->where([
                'Tasks.user_id' => $this->currentUserId(),
            ])
            ->contain(['Users'])
            ->all();

        $counts = [];
        foreach ($tasks as $task) {
            $counts[$task->status] = ($counts[$task->status] ?? 0) + 1;
        }

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
        $task = $this->Tasks->get($id);

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
        $task = $this->Tasks->get($id, contain: []);
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
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
}
