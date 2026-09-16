<?php
    $this->Html->css('usersStyle', ['block' => true]);
?>

<div class="auth">
    <div class="auth__card">
        <?= $this->Html->link(
            '<i class="bi bi-arrow-left" aria-hidden="true"></i>' . h(__('Back to profile')),
            ['action' => 'profile'],
            ['class' => 'auth__back', 'escape' => false],
        ) ?>

        <div class="auth__header">
            <span class="auth__eyebrow">
                <i class="bi bi-key" aria-hidden="true"></i><?= __('Profile') ?>
            </span>
            <h1 class="auth__title"><?= __('Change password') ?></h1>
            <p class="auth__subtitle"><?= __('Confirm your current password, then choose a new one.') ?></p>
        </div>

        <?= $this->Form->create(null, ['class' => 'auth__form']) ?>
            <div class="auth__field">
                <label class="auth__label" for="current_password"><?= __('Current password') ?></label>
                <?= $this->Form->password('current_password', [
                    'id' => 'current_password',
                    'class' => 'auth__input',
                    'autocomplete' => 'current-password',
                    'required' => true,
                    'autofocus' => true,
                ]) ?>
            </div>

            <div class="auth__field">
                <label class="auth__label" for="new_password"><?= __('New password') ?></label>
                <?= $this->Form->password('new_password', [
                    'id' => 'new_password',
                    'class' => 'auth__input',
                    'autocomplete' => 'new-password',
                    'required' => true,
                ]) ?>
                <p class="auth__help"><?= __('At least 8 characters, one uppercase letter and one number.') ?></p>
            </div>

            <div class="auth__field">
                <label class="auth__label" for="confirm_password"><?= __('Confirm new password') ?></label>
                <?= $this->Form->password('confirm_password', [
                    'id' => 'confirm_password',
                    'class' => 'auth__input',
                    'autocomplete' => 'new-password',
                    'required' => true,
                ]) ?>
            </div>

            <button type="submit" class="auth__submit">
                <i class="bi bi-check2" aria-hidden="true"></i><?= __('Change password') ?>
            </button>
        <?= $this->Form->end() ?>
    </div>
</div>
