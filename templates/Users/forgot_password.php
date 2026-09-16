<?php
    $this->Html->css('usersStyle', ['block' => true]);
?>

<div class="auth">
    <div class="auth__card">
        <div class="auth__header">
            <span class="auth__eyebrow">
                <i class="bi bi-key" aria-hidden="true"></i><?= __('Password') ?>
            </span>
            <h1 class="auth__title"><?= __('Reset your password') ?></h1>
            <p class="auth__subtitle">
                <?= __('Enter your email and we will send you a link to set a new password.') ?>
            </p>
        </div>

        <?= $this->Form->create(null, [
            'url' => ['controller' => 'Users', 'action' => 'forgotPassword'],
            'class' => 'auth__form',
        ]) ?>
            <div class="auth__field">
                <label class="auth__label" for="email"><?= __('Email') ?></label>
                <?= $this->Form->email('email', [
                    'id' => 'email',
                    'class' => 'auth__input',
                    'placeholder' => 'you@example.com',
                    'autocomplete' => 'email',
                    'required' => true,
                    'autofocus' => true,
                ]) ?>
            </div>

            <button type="submit" class="auth__submit">
                <i class="bi bi-send" aria-hidden="true"></i><?= __('Send reset link') ?>
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
