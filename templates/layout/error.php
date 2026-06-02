<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?> | TaskHub</title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<main class="py-5">
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <a href="javascript:history.back()" class="btn btn-outline-primary mt-3">
            <i class="bi bi-arrow-left me-1"></i>Wróć
        </a>
    </div>
</main>
<script src="/js/bootstrap.js"></script>
</body>
</html>
