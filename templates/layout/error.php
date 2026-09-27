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
</head>
<body>
<main class="py-5">
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <a href="javascript:history.back()" class="btn btn-outline-primary mt-3">
            <i class="bi bi-arrow-left me-1"></i><?= __('Back') ?>
        </a>
    </div>
</main>
<script src="/js/bootstrap.js"></script>
</body>
</html>
