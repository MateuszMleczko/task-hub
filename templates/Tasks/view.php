<?php
    $this->Html->css('tasksStyle', ['block' => true]);
?>

<div class="tasks">
    <?= $this->Html->link(
        '<i class="bi bi-arrow-left" aria-hidden="true"></i>' . h(__('Tasks')),
        ['controller' => 'Tasks', 'action' => 'index'],
        ['class' => 'tasks__back', 'escape' => false]
    ) ?>

    <div class="task-view">
        <div class="task-view__header">
            <div class="task-view__heading">
                <div class="task-view__badges">
                    <span class="task-view__badge task-view__badge--<?= h($statusAccents[$task->status]) ?>">
                        <?= h($statuses[$task->status]) ?>
                    </span>
                    <span class="task-view__badge task-view__badge--<?= h($priorityAccents[$task->priority]) ?>">
                        <?= h($priorities[$task->priority]) ?>
                    </span>
                </div>
                <h1 class="tasks__title"><?= h($task->title) ?></h1>
                <p class="task-view__meta">#<?= (int)$task->id ?></p>
            </div>

            <div class="task-view__actions">
                <?= $this->Html->link(
                    '<i class="bi bi-pencil-square" aria-hidden="true"></i>' . h(__('Edit')),
                    ['controller' => 'Tasks', 'action' => 'edit', $task->id],
                    ['class' => 'tasks__btn', 'escape' => false]
                ) ?>
                <?= $this->Form->postLink(
                    '<i class="bi bi-trash3" aria-hidden="true"></i>',
                    ['controller' => 'Tasks', 'action' => 'delete', $task->id],
                    [
                        'class' => 'task-view__delete',
                        'escape' => false,
                        'confirm' => __('Are you sure you want to delete this task?'),
                        'title' => __('Delete task'),
                        'aria-label' => __('Delete task'),
                    ]
                ) ?>
            </div>
        </div>

        <div class="task-view__body">
            <section class="task-view__section">
                <h2 class="task-view__section-title task-view__section-title--<?= h($statusAccents[$task->status]) ?>"><?= __('Description') ?></h2>
                <?php if ($task->description): ?>
                    <div class="task-view__description"><?= $this->Text->autoParagraph(h($task->description)) ?></div>
                <?php else: ?>
                    <p class="task-view__empty"><?= __('No description') ?></p>
                <?php endif; ?>
            </section>

            <aside class="task-view__section">
                <h2 class="task-view__section-title"><?= __('Details') ?></h2>

                <div class="task-view__row">
                    <span class="task-view__row-label"><?= __('Status') ?></span>
                    <span class="task-view__row-value task-view__row-value--<?= h($statusAccents[$task->status]) ?>">
                        <?= h($statuses[$task->status]) ?>
                    </span>
                </div>

                <div class="task-view__row">
                    <span class="task-view__row-label"><?= __('Priority') ?></span>
                    <span class="task-view__row-value task-view__row-value--<?= h($priorityAccents[$task->priority]) ?>">
                        <?= h($priorities[$task->priority]) ?>
                    </span>
                </div>

                <div class="task-view__row">
                    <span class="task-view__row-label"><?= __('Deadline') ?></span>
                    <?php if ($task->deadline): ?>
                        <span class="task-view__row-value<?= $task->is_overdue ? ' task-view__row-value--overdue' : '' ?>">
                            <?= h($task->deadline->nice()) ?>
                            <?php if ($task->is_overdue): ?>
                                <small class="task-view__row-note"><?= __('Overdue') ?></small>
                            <?php endif; ?>
                        </span>
                    <?php else: ?>
                        <span class="task-view__row-value task-view__row-value--muted"><?= __('No deadline') ?></span>
                    <?php endif; ?>
                </div>

                <div class="task-view__row">
                    <span class="task-view__row-label"><?= __('Created') ?></span>
                    <span class="task-view__row-value"><?= h($task->created?->nice()) ?></span>
                </div>

                <div class="task-view__row">
                    <span class="task-view__row-label"><?= __('Modified') ?></span>
                    <span class="task-view__row-value"><?= h($task->modified?->nice()) ?></span>
                </div>
            </aside>
        </div>
    </div>
</div>
