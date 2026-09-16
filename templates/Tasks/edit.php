<?php
    $this->Html->css('tasksStyle', ['block' => true]);
?>

<div class="tasks">
    <?= $this->Html->link(
        '<i class="bi bi-arrow-left" aria-hidden="true"></i>' . h(__('Back to task')),
        ['controller' => 'Tasks', 'action' => 'view', $task->id],
        ['class' => 'tasks__back', 'escape' => false]
    ) ?>

    <div class="tasks__header">
        <div>
            <h1 class="tasks__title"><?= __('Edit task') ?></h1>
            <p class="tasks__subtitle">#<?= (int)$task->id ?> · <?= h($task->title) ?></p>
        </div>
    </div>

    <?= $this->Form->create($task, ['class' => 'task-form']) ?>
        <div class="task-form__body">
            <div class="task-form__main">
                <div class="task-form__field">
                    <label class="task-form__label" for="title"><?= __('Title') ?></label>
                    <?= $this->Form->text('title', [
                        'class' => 'task-form__input',
                        'placeholder' => __('What needs to be done?'),
                    ]) ?>
                    <?= $this->Form->error('title') ?>
                </div>

                <div class="task-form__field">
                    <label class="task-form__label" for="description"><?= __('Description') ?></label>
                    <?= $this->Form->textarea('description', [
                        'class' => 'task-form__input task-form__input--textarea',
                        'placeholder' => __('Details, links, notes…'),
                        'rows' => 10,
                    ]) ?>
                    <?= $this->Form->error('description') ?>
                </div>
            </div>

            <div class="task-form__side">
                <div class="task-form__field">
                    <span class="task-form__label"><?= __('Status') ?></span>
                    <div class="task-form__tiles task-form__tiles--status">
                        <?= $this->Form->radio('status', $options['statuses'], [
                            'label' => ['class' => 'task-form__tile'],
                            'hiddenField' => false,
                        ]) ?>
                    </div>
                </div>

                <div class="task-form__field">
                    <span class="task-form__label"><?= __('Priority') ?></span>
                    <div class="task-form__tiles task-form__tiles--priority">
                        <?= $this->Form->radio('priority', $options['priorities'], [
                            'label' => ['class' => 'task-form__tile'],
                            'hiddenField' => false,
                        ]) ?>
                    </div>
                </div>

                <div class="task-form__field">
                    <label class="task-form__label" for="deadline"><?= __('Deadline') ?></label>
                    <?= $this->Form->dateTime('deadline', ['class' => 'task-form__input']) ?>
                    <p class="task-form__help"><?= __('Leave it empty if the task has no deadline.') ?></p>
                    <?= $this->Form->error('deadline') ?>
                </div>
            </div>
        </div>

        <div class="task-form__footer">
            <?= $this->Form->postLink(
                '<i class="bi bi-trash3" aria-hidden="true"></i>' . h(__('Delete task')),
                ['controller' => 'Tasks', 'action' => 'delete', $task->id],
                [
                    'class' => 'task-form__delete',
                    'escape' => false,
                    'confirm' => __('Are you sure you want to delete this task?'),
                    'block' => true,
                ]
            ) ?>

            <div class="task-form__buttons">
                <?= $this->Html->link(
                    __('Cancel'),
                    ['controller' => 'Tasks', 'action' => 'view', $task->id],
                    ['class' => 'task-form__cancel']
                ) ?>

                <?= $this->Form->button(
                    '<i class="bi bi-check-lg" aria-hidden="true"></i>' . h(__('Save changes')),
                    ['class' => 'task-form__submit', 'escapeTitle' => false]
                ) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    <?= $this->fetch('postLink') ?>
</div>
