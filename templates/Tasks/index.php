<?php
    use App\Enum\TaskStatusEnum;

    $this->Html->css('tasksStyle', ['block' => true]);
?>

<div class="tasks">
    <div class="tasks__header">
        <h1 class="tasks__header-title"><?= __('Tasks') ?></h1>

        <?= $this->Html->link(
            '<i class="bi bi-plus-lg" aria-hidden="true"></i>' . h(__('Add Task')),
            ['controller' => 'Tasks', 'action' => 'add'],
            ['class' => 'tasks__header-btn', 'escape' => false]
        ) ?>
    </div>
    <div class="tasks__content">
        <div class="tasks_content_list tasks_content_list--todo">
            <div class="tasks_content_list-header">
                <span class="tasks_content_list-name"><?= h($statuses[TaskStatusEnum::TO_DO]) ?></span>
                <span class="tasks_content_list-count"><?= (int)($counts[TaskStatusEnum::TO_DO] ?? 0) ?></span>
            </div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status === TaskStatusEnum::TO_DO): ?>
                    <div class="tasks_content_list_card">
                        <h3 class="tasks_content_list_card-title">
                            <?= $this->Html->link(
                                $task->title,
                                ['controller' => 'Tasks', 'action' => 'view', $task->id],
                                ['class' => 'tasks_content_list_card-link']
                            ) ?>
                        </h3>
                        <p class="tasks_content_list_card-description"><?= h($task->description) ?></p>
                        <p class="tasks_content_list_card-user"><?= h($task->user->name) ?> <?= h($task->user->surname) ?></p>
                        <?= $this->Html->link(
                            '<i class="bi bi-pencil-square" aria-hidden="true"></i>',
                            ['controller' => 'Tasks', 'action' => 'edit', $task->id],
                            [
                                'class' => 'tasks_content_list_card-btn',
                                'escape' => false,
                                'title' => __('Edit task'),
                                'aria-label' => __('Edit task'),
                            ]
                        ) ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="tasks_content_list tasks_content_list--progress">
            <div class="tasks_content_list-header">
                <span class="tasks_content_list-name"><?= h($statuses[TaskStatusEnum::IN_PROGRESS]) ?></span>
                <span class="tasks_content_list-count"><?= (int)($counts[TaskStatusEnum::IN_PROGRESS] ?? 0) ?></span>
            </div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status === TaskStatusEnum::IN_PROGRESS): ?>
                    <div class="tasks_content_list_card">
                        <h3 class="tasks_content_list_card-title">
                            <?= $this->Html->link(
                                $task->title,
                                ['controller' => 'Tasks', 'action' => 'view', $task->id],
                                ['class' => 'tasks_content_list_card-link']
                            ) ?>
                        </h3>
                        <p class="tasks_content_list_card-description"><?= h($task->description) ?></p>
                        <p class="tasks_content_list_card-user"><?= h($task->user->name) ?> <?= h($task->user->surname) ?></p>
                        <?= $this->Html->link(
                            '<i class="bi bi-pencil-square" aria-hidden="true"></i>',
                            ['controller' => 'Tasks', 'action' => 'edit', $task->id],
                            [
                                'class' => 'tasks_content_list_card-btn',
                                'escape' => false,
                                'title' => __('Edit task'),
                                'aria-label' => __('Edit task'),
                            ]
                        ) ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="tasks_content_list tasks_content_list--blocked">
            <div class="tasks_content_list-header">
                <span class="tasks_content_list-name"><?= h($statuses[TaskStatusEnum::BLOCKED]) ?></span>
                <span class="tasks_content_list-count"><?= (int)($counts[TaskStatusEnum::BLOCKED] ?? 0) ?></span>
            </div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status === TaskStatusEnum::BLOCKED): ?>
                    <div class="tasks_content_list_card">
                        <h3 class="tasks_content_list_card-title">
                            <?= $this->Html->link(
                                $task->title,
                                ['controller' => 'Tasks', 'action' => 'view', $task->id],
                                ['class' => 'tasks_content_list_card-link']
                            ) ?>
                        </h3>
                        <p class="tasks_content_list_card-description"><?= h($task->description) ?></p>
                        <p class="tasks_content_list_card-user"><?= h($task->user->name) ?> <?= h($task->user->surname) ?></p>
                        <?= $this->Html->link(
                            '<i class="bi bi-pencil-square" aria-hidden="true"></i>',
                            ['controller' => 'Tasks', 'action' => 'edit', $task->id],
                            [
                                'class' => 'tasks_content_list_card-btn',
                                'escape' => false,
                                'title' => __('Edit task'),
                                'aria-label' => __('Edit task'),
                            ]
                        ) ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="tasks_content_list tasks_content_list--done">
            <div class="tasks_content_list-header">
                <span class="tasks_content_list-name"><?= h($statuses[TaskStatusEnum::DONE]) ?></span>
                <span class="tasks_content_list-count"><?= (int)($counts[TaskStatusEnum::DONE] ?? 0) ?></span>
            </div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status === TaskStatusEnum::DONE): ?>
                    <div class="tasks_content_list_card">
                        <h3 class="tasks_content_list_card-title">
                            <?= $this->Html->link(
                                $task->title,
                                ['controller' => 'Tasks', 'action' => 'view', $task->id],
                                ['class' => 'tasks_content_list_card-link']
                            ) ?>
                        </h3>
                        <p class="tasks_content_list_card-description"><?= h($task->description) ?></p>
                        <p class="tasks_content_list_card-user"><?= h($task->user->name) ?> <?= h($task->user->surname) ?></p>
                        <?= $this->Html->link(
                            '<i class="bi bi-pencil-square" aria-hidden="true"></i>',
                            ['controller' => 'Tasks', 'action' => 'edit', $task->id],
                            [
                                'class' => 'tasks_content_list_card-btn',
                                'escape' => false,
                                'title' => __('Edit task'),
                                'aria-label' => __('Edit task'),
                            ]
                        ) ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
