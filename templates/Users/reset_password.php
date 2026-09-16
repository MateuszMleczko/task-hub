<?php
    $this->Html->css('usersStyle', ['block' => true]);
?>

<div class="auth">
    <div class="auth__card">
        <div class="auth__header">
            <span class="auth__eyebrow">
                <i class="bi bi-key" aria-hidden="true"></i><?= __('Password') ?>
            </span>
            <h1 class="auth__title"><?= __('Set a new password') ?></h1>
            <p class="auth__subtitle"><?= __('Pick something strong you have not used before.') ?></p>
        </div>

        <?= $this->Form->create(null, ['class' => 'auth__form']) ?>
            <div class="auth__field">
                <label class="auth__label" for="password"><?= __('New password') ?></label>
                <?= $this->Form->password('password', [
                    'id' => 'password',
                    'class' => 'auth__input',
                    'autocomplete' => 'new-password',
                    'required' => true,
                    'autofocus' => true,
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
                <i class="bi bi-check2" aria-hidden="true"></i><?= __('Save new password') ?>
            </button>
        <?= $this->Form->end() ?>

        <div class="auth__footer">
            <?= $this->Html->link(
                '<i class="bi bi-arrow-left" aria-hidden="true"></i>' . h(__('Back to login')),
                ['action' => 'login'],
                ['class' => 'auth__footer-link', 'escape' => false],
            ) ?>
        </div>
    </div>
</div>
