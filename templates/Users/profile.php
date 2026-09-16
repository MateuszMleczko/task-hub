<?php
    $this->Html->css('usersStyle', ['block' => true]);
    $this->Html->script('users', ['block' => true]);
?>

<div class="profile">
    <?= $this->Html->link(
        '<i class="bi bi-arrow-left" aria-hidden="true"></i>' . h(__('Back to tasks')),
        ['controller' => 'Tasks', 'action' => 'index'],
        ['class' => 'profile__back', 'escape' => false]
    ) ?>

    <section class="profile__header">
        <button type="button" class="profile__avatar" data-avatar-popup-open aria-label="<?= __('Change avatar') ?>">
            <?= $this->Profile->avatar($userAvatar) ?>
            <span class="profile__avatar-edit" aria-hidden="true">
                <i class="bi bi-pencil-fill"></i>
            </span>
        </button>

        <div class="profile__identity">
            <span class="profile__eyebrow"><?= __('Profile') ?></span>
            <h1 class="profile__name"><?= h($userName) ?></h1>
            <span class="profile__email"><?= h($userEmail) ?></span>
            <div class="profile__meta">
                <span class="profile__meta-item">
                    <i class="bi bi-calendar3" aria-hidden="true"></i>
                    <?= h(__('In TaskHub since {0}', $memberSince)) ?>
                </span>
            </div>
        </div>

        <div class="profile__actions">
            <?= $this->Html->link(
                '<i class="bi bi-key" aria-hidden="true"></i>' . h(__('Change password')),
                ['controller' => 'Users', 'action' => 'changePassword'],
                ['class' => 'profile__btn profile__btn--primary', 'escape' => false]
            ) ?>
            <?php if ($doneTasks): ?>
                <?= $this->Form->postLink(
                    '<i class="bi bi-trash3" aria-hidden="true"></i>' . h(__('Delete completed'))
                        . '<span class="profile__btn-count">' . (int)$doneTasks . '</span>',
                    ['controller' => 'Tasks', 'action' => 'deleteDone'],
                    [
                        'class' => 'profile__btn profile__btn--danger',
                        'escape' => false,
                        'confirm' => __('Are you sure you want to delete all completed tasks?'),
                    ]
                ) ?>
            <?php endif; ?>
        </div>
    </section>

    <section class="profile__stats">
        <div class="profile-stat">
            <div class="profile-stat__label">
                <?= __('All tasks') ?>
                <i class="bi bi-kanban profile-stat__icon" aria-hidden="true"></i>
            </div>
            <div class="profile-stat__value"><?= (int)$totalTasks ?></div>
            <p class="profile-stat__hint"><?= h(__('{0} active', $activeTasks)) ?></p>
        </div>

        <div class="profile-stat profile-stat--done">
            <div class="profile-stat__label">
                <?= __('Completed') ?>
                <i class="bi bi-check-circle-fill profile-stat__icon" aria-hidden="true"></i>
            </div>
            <div class="profile-stat__value"><?= (int)$doneTasks ?></div>
            <p class="profile-stat__hint"><?= h(__('{0} left to finish', $activeTasks)) ?></p>
        </div>

        <div class="profile-stat profile-stat--ratio">
            <div class="profile-stat__label">
                <?= __('Completion rate') ?>
                <i class="bi bi-bullseye profile-stat__icon" aria-hidden="true"></i>
            </div>
            <div class="profile-stat__body">
                <?= $this->Profile->ring($donePercent) ?>
                <div>
                    <div class="profile-stat__value"><?= (int)$donePercent ?><span class="profile-stat__unit">%</span></div>
                    <p class="profile-stat__hint"><?= __('of all your tasks') ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="profile-breakdown">
        <h2 class="profile-breakdown__title"><?= __('Tasks by status') ?></h2>

        <div class="profile-breakdown__bar">
            <?php foreach ($breakdown as $row): ?>
                <div class="profile-breakdown__segment profile-breakdown__segment--<?= h($row['accent']) ?>" style="flex: <?= (int)$row['count'] ?>"></div>
            <?php endforeach; ?>
        </div>

        <ul class="profile-breakdown__legend">
            <?php foreach ($breakdown as $row): ?>
                <li class="profile-breakdown__item profile-breakdown__item--<?= h($row['accent']) ?>">
                    <span class="profile-breakdown__dot"></span>
                    <span class="profile-breakdown__name"><?= h($row['label']) ?></span>
                    <span class="profile-breakdown__count"><?= (int)$row['count'] ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</div>

<?= $this->element('avatar_change_popup') ?>
