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
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?= $this->Url->build('/') ?>">
            <i class="bi bi-check2-square me-2"></i>TaskHub
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto">
                <?php if ($this->request->getAttribute('identity')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Tasks', 'action' => 'index']) ?>">
                            <i class="bi bi-list-task me-1"></i>Moje taski
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">
                            <i class="bi bi-box-arrow-right me-1"></i>Wyloguj
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Zaloguj
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

<footer class="py-3 mt-auto">
    <div class="container text-center">
        <small style="color: rgba(253, 235, 158, 0.4);">TaskHub &copy; <?= date('Y') ?></small>
    </div>
</footer>

<?= $this->Html->script(['bootstrap'], ['block' => false]) ?>
<?= $this->fetch('script') ?>
</body>
</html>
