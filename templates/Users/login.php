<?php
    $this->Html->css('usersStyle', ['block' => true]);
?>

<div class="auth">
    <div class="auth__card">
        <div class="auth__header">
            <span class="auth__eyebrow">
                <i class="bi bi-check2-square" aria-hidden="true"></i>TaskHub
            </span>
            <h1 class="auth__title"><?= __('Welcome back') ?></h1>
            <p class="auth__subtitle"><?= __('Log in to get back to your tasks.') ?></p>
        </div>

        <?= $this->Form->create(null, [
            'url' => ['controller' => 'Users', 'action' => 'login'],
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

            <div class="auth__field">
                <div class="auth__label-row">
                    <label class="auth__label" for="password"><?= __('Password') ?></label>
                    <?= $this->Html->link(
                        __('Forgot your password?'),
                        ['action' => 'forgotPassword'],
                        ['class' => 'auth__link'],
                    ) ?>
                </div>
                <?= $this->Form->password('password', [
                    'id' => 'password',
                    'class' => 'auth__input',
                    'autocomplete' => 'current-password',
                    'required' => true,
                ]) ?>
            </div>

            <button type="submit" class="auth__submit">
                <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i><?= __('Login') ?>
            </button>
        <?= $this->Form->end() ?>

        <div class="auth__footer">
            <?= __("Don't have an account?") ?>
            <?= $this->Html->link(__('Sign up'), ['action' => 'register'], ['class' => 'auth__footer-link']) ?>
        </div>
    </div>
</div>
