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
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="<?= $this->Url->build('/') ?>">
            <?= $this->Html->image('/favicon.svg', ['alt' => '', 'class' => 'navbar-brand__logo']) ?>TaskHub
        </a>
    </div>
</nav>

<main class="error-page">
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <a href="<?= $this->Url->build('/') ?>" class="btn btn-outline-primary mt-3">
            <i class="bi bi-arrow-left me-1" aria-hidden="true"></i><?= __('Back to the home page') ?>
        </a>
    </div>
</main>

<?= $this->element('site_footer') ?>

<script src="/js/bootstrap.js"></script>
</body>
</html>
