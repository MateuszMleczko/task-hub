<?php
    $this->Html->css('usersStyle', ['block' => true]);
?>

<div class="auth">
    <div class="auth__card">
        <div class="auth__header">
            <span class="auth__eyebrow">
                <i class="bi bi-envelope-check" aria-hidden="true"></i><?= __('Email') ?>
            </span>
            <h1 class="auth__title"><?= __('Confirm your email') ?></h1>
            <p class="auth__subtitle">
                <?= __('Enter your email and we will send you a new link to confirm your account.') ?>
            </p>
        </div>

        <?= $this->Form->create(null, [
            'url' => ['controller' => 'Users', 'action' => 'resendConfirmation'],
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
                <i class="bi bi-send" aria-hidden="true"></i><?= __('Send confirmation link') ?>
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
