<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="<?= str_replace('_', '-', \Cake\I18n\I18n::getLocale()) ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?> | TaskHub</title>
    <?= $this->Html->meta('icon', '/favicon.svg', ['type' => 'image/svg+xml']) ?>
    <link rel="stylesheet" href="/css/app.css">
    <?= $this->Html->css('mainStyle') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?= $this->Url->build('/') ?>">
            <?= $this->Html->image('/favicon.svg', ['alt' => '', 'class' => 'navbar-brand__logo']) ?>TaskHub
        </a>
        <?php if ($this->request->getAttribute('identity')): ?>
            <a class="nav-link nav-link-avatar ms-auto me-2 d-lg-none" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>" aria-label="<?= h(__('Profile')) ?>">
                <?= $this->Profile->avatar($userAvatar, 'small') ?>
            </a>
        <?php endif; ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="<?= h(__('Toggle navigation')) ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <?php if ($this->request->getAttribute('identity')): ?>
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-avatar" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>" aria-label="<?= h(__('Profile')) ?>">
                            <?= $this->Profile->avatar($userAvatar, 'small') ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">
                            <i class="bi bi-box-arrow-right me-1"></i><?= __('Logout') ?>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">
                            <i class="bi bi-box-arrow-in-right me-1"></i><?= __('Login') ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link--cta" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>">
                            <?= __('Sign up') ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</main>

<?= $this->element('site_footer') ?>

<?= $this->Html->script(['bootstrap'], ['block' => false, 'type' => 'module']) ?>
<?= $this->fetch('script') ?>
</body>
</html>
