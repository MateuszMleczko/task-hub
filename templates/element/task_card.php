<div class="task-card" data-task-id="<?= (int)$task->id ?>">
    <h3 class="task-card__title">
        <?= $this->Html->link(
            $task->title,
            ['controller' => 'Tasks', 'action' => 'view', $task->id],
            ['class' => 'task-card__link', 'draggable' => 'false']
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
            'draggable' => 'false',
            'escape' => false,
            'title' => __('Edit task'),
            'aria-label' => __('Edit task'),
        ]
    ) ?>
</div>
