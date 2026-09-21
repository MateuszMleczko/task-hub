<?php
    use App\Enum\TaskStatusEnum;

    $this->Html->css('tasksStyle', ['block' => true]);
    $this->Html->script('tasks', ['block' => true, 'type' => 'module']);
?>

<div class="tasks">
    <div class="tasks__header">
        <h1 class="tasks__title"><?= __('Tasks') ?></h1>

        <?= $this->Html->link(
            '<i class="bi bi-plus-lg" aria-hidden="true"></i>' . h(__('Add Task')),
            ['controller' => 'Tasks', 'action' => 'add'],
            ['class' => 'tasks__btn', 'escape' => false]
        ) ?>
    </div>
    <div class="tasks__board"
         data-status-url="<?= $this->Url->build(['controller' => 'Tasks', 'action' => 'changeStatus']) ?>"
         data-csrf-token="<?= h($this->request->getAttribute('csrfToken')) ?>">
        <div class="tasks__column tasks__column--todo">
            <div class="tasks__column-header">
                <span class="tasks__column-name"><?= h($statuses[TaskStatusEnum::TO_DO]) ?></span>
                <span class="tasks__column-count"><?= (int)($counts[TaskStatusEnum::TO_DO] ?? 0) ?></span>
            </div>
            <div class="tasks__list" data-status="<?= TaskStatusEnum::TO_DO ?>">
                <?php foreach ($tasks[TaskStatusEnum::TO_DO] as $task): ?>
                    <?= $this->element('task_card', ['task' => $task, 'priorities' => $priorities, 'priorityAccents' => $priorityAccents]) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tasks__column tasks__column--progress">
            <div class="tasks__column-header">
                <span class="tasks__column-name"><?= h($statuses[TaskStatusEnum::IN_PROGRESS]) ?></span>
                <span class="tasks__column-count"><?= (int)($counts[TaskStatusEnum::IN_PROGRESS] ?? 0) ?></span>
            </div>
            <div class="tasks__list" data-status="<?= TaskStatusEnum::IN_PROGRESS ?>">
                <?php foreach ($tasks[TaskStatusEnum::IN_PROGRESS] as $task): ?>
                    <?= $this->element('task_card', ['task' => $task, 'priorities' => $priorities, 'priorityAccents' => $priorityAccents]) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tasks__column tasks__column--blocked">
            <div class="tasks__column-header">
                <span class="tasks__column-name"><?= h($statuses[TaskStatusEnum::BLOCKED]) ?></span>
                <span class="tasks__column-count"><?= (int)($counts[TaskStatusEnum::BLOCKED] ?? 0) ?></span>
            </div>
            <div class="tasks__list" data-status="<?= TaskStatusEnum::BLOCKED ?>">
                <?php foreach ($tasks[TaskStatusEnum::BLOCKED] as $task): ?>
                    <?= $this->element('task_card', ['task' => $task, 'priorities' => $priorities, 'priorityAccents' => $priorityAccents]) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tasks__column tasks__column--done">
            <div class="tasks__column-header">
                <span class="tasks__column-name"><?= h($statuses[TaskStatusEnum::DONE]) ?></span>
                <span class="tasks__column-count"><?= (int)($counts[TaskStatusEnum::DONE] ?? 0) ?></span>
            </div>
            <div class="tasks__list" data-status="<?= TaskStatusEnum::DONE ?>">
                <?php foreach ($tasks[TaskStatusEnum::DONE] as $task): ?>
                    <?= $this->element('task_card', ['task' => $task, 'priorities' => $priorities, 'priorityAccents' => $priorityAccents]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
