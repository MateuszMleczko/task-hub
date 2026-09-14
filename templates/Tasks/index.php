<?php
    use App\Enum\TaskStatusEnum;

    $this->Html->css('tasksStyle', ['block' => true]);
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
    <div class="tasks__board">
        <div class="tasks__column tasks__column--todo">
            <div class="tasks__column-header">
                <span class="tasks__column-name"><?= h($statuses[TaskStatusEnum::TO_DO]) ?></span>
                <span class="tasks__column-count"><?= (int)($counts[TaskStatusEnum::TO_DO] ?? 0) ?></span>
            </div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status === TaskStatusEnum::TO_DO): ?>
                    <div class="task-card">
                        <h3 class="task-card__title">
                            <?= $this->Html->link(
                                $task->title,
                                ['controller' => 'Tasks', 'action' => 'view', $task->id],
                                ['class' => 'task-card__link']
                            ) ?>
                        </h3>
                        <span class="task-card__id">#<?= (int)$task->id ?></span>
                        <div class="task-card__meta">
                            <span class="task-card__priority task-card__priority--<?= h($priorityAccents[$task->priority]) ?>">
                                <?= h($priorities[$task->priority]) ?>
                            </span>
                            <?php if ($task->deadline): ?>
                                <span class="task-card__deadline<?= $task->is_overdue ? ' task-card__deadline--overdue' : '' ?>">
                                    <i class="bi <?= $task->is_overdue ? 'bi-clock-history' : 'bi-calendar3' ?>" aria-hidden="true"></i>
                                    <?= h($task->deadline->nice()) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?= $this->Html->link(
                            '<i class="bi bi-pencil-square" aria-hidden="true"></i>',
                            ['controller' => 'Tasks', 'action' => 'edit', $task->id],
                            [
                                'class' => 'task-card__edit',
                                'escape' => false,
                                'title' => __('Edit task'),
                                'aria-label' => __('Edit task'),
                            ]
                        ) ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="tasks__column tasks__column--progress">
            <div class="tasks__column-header">
                <span class="tasks__column-name"><?= h($statuses[TaskStatusEnum::IN_PROGRESS]) ?></span>
                <span class="tasks__column-count"><?= (int)($counts[TaskStatusEnum::IN_PROGRESS] ?? 0) ?></span>
            </div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status === TaskStatusEnum::IN_PROGRESS): ?>
                    <div class="task-card">
                        <h3 class="task-card__title">
                            <?= $this->Html->link(
                                $task->title,
                                ['controller' => 'Tasks', 'action' => 'view', $task->id],
                                ['class' => 'task-card__link']
                            ) ?>
                        </h3>
                        <span class="task-card__id">#<?= (int)$task->id ?></span>
                        <div class="task-card__meta">
                            <span class="task-card__priority task-card__priority--<?= h($priorityAccents[$task->priority]) ?>">
                                <?= h($priorities[$task->priority]) ?>
                            </span>
                            <?php if ($task->deadline): ?>
                                <span class="task-card__deadline<?= $task->is_overdue ? ' task-card__deadline--overdue' : '' ?>">
                                    <i class="bi <?= $task->is_overdue ? 'bi-clock-history' : 'bi-calendar3' ?>" aria-hidden="true"></i>
                                    <?= h($task->deadline->nice()) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?= $this->Html->link(
                            '<i class="bi bi-pencil-square" aria-hidden="true"></i>',
                            ['controller' => 'Tasks', 'action' => 'edit', $task->id],
                            [
                                'class' => 'task-card__edit',
                                'escape' => false,
                                'title' => __('Edit task'),
                                'aria-label' => __('Edit task'),
                            ]
                        ) ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="tasks__column tasks__column--blocked">
            <div class="tasks__column-header">
                <span class="tasks__column-name"><?= h($statuses[TaskStatusEnum::BLOCKED]) ?></span>
                <span class="tasks__column-count"><?= (int)($counts[TaskStatusEnum::BLOCKED] ?? 0) ?></span>
            </div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status === TaskStatusEnum::BLOCKED): ?>
                    <div class="task-card">
                        <h3 class="task-card__title">
                            <?= $this->Html->link(
                                $task->title,
                                ['controller' => 'Tasks', 'action' => 'view', $task->id],
                                ['class' => 'task-card__link']
                            ) ?>
                        </h3>
                        <span class="task-card__id">#<?= (int)$task->id ?></span>
                        <div class="task-card__meta">
                            <span class="task-card__priority task-card__priority--<?= h($priorityAccents[$task->priority]) ?>">
                                <?= h($priorities[$task->priority]) ?>
                            </span>
                            <?php if ($task->deadline): ?>
                                <span class="task-card__deadline<?= $task->is_overdue ? ' task-card__deadline--overdue' : '' ?>">
                                    <i class="bi <?= $task->is_overdue ? 'bi-clock-history' : 'bi-calendar3' ?>" aria-hidden="true"></i>
                                    <?= h($task->deadline->nice()) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?= $this->Html->link(
                            '<i class="bi bi-pencil-square" aria-hidden="true"></i>',
                            ['controller' => 'Tasks', 'action' => 'edit', $task->id],
                            [
                                'class' => 'task-card__edit',
                                'escape' => false,
                                'title' => __('Edit task'),
                                'aria-label' => __('Edit task'),
                            ]
                        ) ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="tasks__column tasks__column--done">
            <div class="tasks__column-header">
                <span class="tasks__column-name"><?= h($statuses[TaskStatusEnum::DONE]) ?></span>
                <span class="tasks__column-count"><?= (int)($counts[TaskStatusEnum::DONE] ?? 0) ?></span>
            </div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status === TaskStatusEnum::DONE): ?>
                    <div class="task-card">
                        <h3 class="task-card__title">
                            <?= $this->Html->link(
                                $task->title,
                                ['controller' => 'Tasks', 'action' => 'view', $task->id],
                                ['class' => 'task-card__link']
                            ) ?>
                        </h3>
                        <span class="task-card__id">#<?= (int)$task->id ?></span>
                        <div class="task-card__meta">
                            <span class="task-card__priority task-card__priority--<?= h($priorityAccents[$task->priority]) ?>">
                                <?= h($priorities[$task->priority]) ?>
                            </span>
                            <?php if ($task->deadline): ?>
                                <span class="task-card__deadline<?= $task->is_overdue ? ' task-card__deadline--overdue' : '' ?>">
                                    <i class="bi <?= $task->is_overdue ? 'bi-clock-history' : 'bi-calendar3' ?>" aria-hidden="true"></i>
                                    <?= h($task->deadline->nice()) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?= $this->Html->link(
                            '<i class="bi bi-pencil-square" aria-hidden="true"></i>',
                            ['controller' => 'Tasks', 'action' => 'edit', $task->id],
                            [
                                'class' => 'task-card__edit',
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
