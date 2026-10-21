<?php
    $this->assign('title', __('Your tasks on one clear board'));
    $this->Html->meta('description', __('TaskHub is a simple kanban board for your own tasks: four columns, priorities, deadlines and drag and drop.'), ['block' => true]);
    $this->Html->css('homeStyle', ['block' => true]);
?>

<div class="home">
    <section class="home__hero">
        <div class="home__intro">
            <span class="home__badge">
                <i class="bi bi-kanban" aria-hidden="true"></i><?= __('Kanban task board') ?>
            </span>
            <h1 class="home__title">
                <span class="home__title-line"><?= __('Your tasks.') ?></span>
                <span class="home__title-line home__title-line--accent"><?= __('One clear board.') ?></span>
            </h1>
            <p class="home__lead">
                <?= __('TaskHub keeps all your work in four columns, from to do to done. Add a task, set its priority and deadline, then drag it along as the work moves forward.') ?>
            </p>
            <div class="home__actions">
                <a class="home__btn home__btn--primary" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>">
                    <i class="bi bi-person-plus" aria-hidden="true"></i><?= __('Create an account') ?>
                </a>
                <a class="home__btn home__btn--ghost" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">
                    <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i><?= __('Login') ?>
                </a>
            </div>
            <ul class="home__facts">
                <li class="home__fact"><i class="bi bi-code-slash" aria-hidden="true"></i><?= __('Open source, MIT License') ?></li>
                <li class="home__fact"><i class="bi bi-translate" aria-hidden="true"></i><?= __('Polish and English') ?></li>
                <li class="home__fact"><i class="bi bi-eye-slash" aria-hidden="true"></i><?= __('No ads or trackers') ?></li>
            </ul>
        </div>

        <?= $this->element('board_preview', ['statuses' => $statuses, 'priorities' => $priorities]) ?>
    </section>

    <section class="home__section" aria-labelledby="home-features">
        <div class="home__section-header">
            <span class="home__eyebrow"><?= __('Features') ?></span>
            <h2 class="home__heading" id="home-features"><?= __('Simple on purpose') ?></h2>
            <p class="home__text"><?= __('No sprints, no story points, no setup. Just what you need to keep track of your own work.') ?></p>
        </div>

        <div class="home__features">
            <article class="feature-card feature-card--board">
                <span class="feature-card__icon"><i class="bi bi-kanban" aria-hidden="true"></i></span>
                <h3 class="feature-card__title"><?= __('Drag and drop board') ?></h3>
                <p class="feature-card__text"><?= __('Four columns: to do, in progress, blocked and done. Drop a card into another column and its status is saved right away.') ?></p>
            </article>
            <article class="feature-card feature-card--deadlines">
                <span class="feature-card__icon"><i class="bi bi-flag" aria-hidden="true"></i></span>
                <h3 class="feature-card__title"><?= __('Priorities and deadlines') ?></h3>
                <p class="feature-card__text"><?= __('Mark each task as low, medium or high priority. Overdue tasks are highlighted, so nothing slips through.') ?></p>
            </article>
            <article class="feature-card feature-card--progress">
                <span class="feature-card__icon"><i class="bi bi-pie-chart" aria-hidden="true"></i></span>
                <h3 class="feature-card__title"><?= __('Progress at a glance') ?></h3>
                <p class="feature-card__text"><?= __('Your profile counts open and finished tasks and shows how much of the work is already done.') ?></p>
            </article>
            <article class="feature-card feature-card--account">
                <span class="feature-card__icon"><i class="bi bi-person-gear" aria-hidden="true"></i></span>
                <h3 class="feature-card__title"><?= __('Your account, your data') ?></h3>
                <p class="feature-card__text"><?= __('Pick an avatar, change your password or delete the account together with all its tasks at any time.') ?></p>
            </article>
        </div>
    </section>

    <section class="home__section home__split" aria-labelledby="home-security">
        <div class="home__split-text">
            <span class="home__eyebrow"><?= __('Under the hood') ?></span>
            <h2 class="home__heading" id="home-security"><?= __('Small app, solid foundations') ?></h2>
            <p class="home__text"><?= __('TaskHub is a portfolio project, but it is built the way a production service should be: secure by default and easy to maintain.') ?></p>
            <ul class="home__stack">
                <li class="home__stack-item">PHP 8.2</li>
                <li class="home__stack-item">CakePHP 5</li>
                <li class="home__stack-item">MySQL</li>
                <li class="home__stack-item">Bootstrap 5</li>
                <li class="home__stack-item">SCSS</li>
                <li class="home__stack-item">Vite</li>
            </ul>
            <a class="home__btn home__btn--ghost" href="https://github.com/MateuszMleczko/task-hub" target="_blank" rel="noopener">
                <i class="bi bi-github" aria-hidden="true"></i><?= __('View the source code') ?>
            </a>
        </div>

        <ul class="home__checklist">
            <li class="home__check"><i class="bi bi-check2 home__check-icon" aria-hidden="true"></i><?= __('Passwords stored only as secure hashes') ?></li>
            <li class="home__check"><i class="bi bi-check2 home__check-icon" aria-hidden="true"></i><?= __('Email confirmation before the first login') ?></li>
            <li class="home__check"><i class="bi bi-check2 home__check-icon" aria-hidden="true"></i><?= __('Single-use password reset links valid for one hour') ?></li>
            <li class="home__check"><i class="bi bi-check2 home__check-icon" aria-hidden="true"></i><?= __('Rate limiting on login and password reset') ?></li>
            <li class="home__check"><i class="bi bi-check2 home__check-icon" aria-hidden="true"></i><?= __('Every session signed out after a password change') ?></li>
            <li class="home__check"><i class="bi bi-check2 home__check-icon" aria-hidden="true"></i><?= __('CSRF protection on every form') ?></li>
        </ul>
    </section>

    <section class="home__cta" aria-labelledby="home-cta">
        <h2 class="home__heading" id="home-cta"><?= __('Start with an empty board') ?></h2>
        <p class="home__text"><?= __('Create an account, confirm your email address and add your first task. It takes about a minute.') ?></p>
        <div class="home__actions">
            <a class="home__btn home__btn--primary" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>">
                <i class="bi bi-person-plus" aria-hidden="true"></i><?= __('Create an account') ?>
            </a>
            <a class="home__btn home__btn--ghost" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">
                <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i><?= __('Login') ?>
            </a>
        </div>
        <p class="home__notice">
            <i class="bi bi-info-circle home__notice-icon" aria-hidden="true"></i>
            <span>
                <?= __('TaskHub is a portfolio demo project. Feel free to use it, but it is not a commercial service - please do not keep important data here.') ?>
                <?= __('The source code is open source:') ?>
                <a class="home__link" href="https://github.com/MateuszMleczko" target="_blank" rel="noopener">github.com/MateuszMleczko</a>
            </span>
        </p>
    </section>
</div>
