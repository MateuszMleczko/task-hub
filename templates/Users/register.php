<?php
    $this->Html->css('usersStyle', ['block' => true]);
?>

<div class="auth">
    <div class="auth__card auth__card--wide">
        <div class="auth__header">
            <span class="auth__eyebrow">
                <i class="bi bi-check2-square" aria-hidden="true"></i>TaskHub
            </span>
            <h1 class="auth__title"><?= __('Create your account') ?></h1>
            <p class="auth__subtitle"><?= __('A few details and you are ready to plan.') ?></p>
        </div>

        <?= $this->Form->create($user, ['class' => 'auth__form']) ?>
            <div class="auth__field">
                <label class="auth__label" for="name"><?= __('Name') ?></label>
                <?= $this->Form->text('name', [
                    'id' => 'name',
                    'class' => 'auth__input',
                    'autocomplete' => 'name',
                    'required' => true,
                    'autofocus' => true,
                ]) ?>
                <?= $this->Form->error('name') ?>
            </div>

            <div class="auth__field">
                <label class="auth__label" for="email"><?= __('Email') ?></label>
                <?= $this->Form->email('email', [
                    'id' => 'email',
                    'class' => 'auth__input',
                    'placeholder' => 'you@example.com',
                    'autocomplete' => 'email',
                    'required' => true,
                ]) ?>
                <?= $this->Form->error('email') ?>
            </div>

            <div class="auth__field">
                <span class="auth__label"><?= __('Avatar') ?></span>
                <div class="avatar-picker">
                    <?php foreach ($avatars as $avatar): ?>
                        <label class="avatar-picker__option">
                            <input class="avatar-picker__input"
                                   type="radio"
                                   name="avatar_id"
                                   value="<?= (int)$avatar->id ?>"
                                   <?= $avatar->id === $selectedAvatarId ? 'checked' : '' ?>
                            >
                            <?= $this->Html->image($avatar->storage_key, [
                                'alt' => __('Avatar'),
                                'class' => 'avatar-picker__img',
                            ]) ?>
                            <span class="avatar-picker__check" aria-hidden="true">
                                <i class="bi bi-check-lg"></i>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?= $this->Form->error('avatar_id') ?>
            </div>

            <div class="auth__field">
                <label class="auth__label" for="password"><?= __('Password') ?></label>
                <?= $this->Form->password('password', [
                    'id' => 'password',
                    'class' => 'auth__input',
                    'autocomplete' => 'new-password',
                    'required' => true,
                ]) ?>
                <p class="auth__help"><?= __('At least 8 characters, one uppercase letter and one number.') ?></p>
                <?= $this->Form->error('password') ?>
            </div>

            <div class="auth__field">
                <label class="auth__label" for="confirm_password"><?= __('Confirm password') ?></label>
                <?= $this->Form->password('confirm_password', [
                    'id' => 'confirm_password',
                    'class' => 'auth__input',
                    'autocomplete' => 'new-password',
                    'required' => true,
                ]) ?>
                <?= $this->Form->error('confirm_password') ?>
            </div>

            <button type="submit" class="auth__submit">
                <i class="bi bi-person-plus" aria-hidden="true"></i><?= __('Sign up') ?>
            </button>
        <?= $this->Form->end() ?>

        <div class="auth__footer">
            <?= __('Already have an account?') ?>
            <?= $this->Html->link(__('Login'), ['action' => 'login'], ['class' => 'auth__footer-link']) ?>
        </div>
    </div>
</div>
