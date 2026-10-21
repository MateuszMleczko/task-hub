<?php
    use App\Enum\TaskPriorityEnum;
    use App\Enum\TaskStatusEnum;
?>

<div class="board-preview" aria-hidden="true">
    <div class="board-preview__bar">
        <span class="board-preview__title"><?= __('Tasks') ?></span>
        <span class="board-preview__add">
            <i class="bi bi-plus-lg"></i><?= __('Add Task') ?>
        </span>
    </div>

    <div class="board-preview__columns">
        <div class="board-preview__column board-preview__column--todo">
            <div class="board-preview__column-header">
                <span class="board-preview__column-name"><?= h($statuses[TaskStatusEnum::TO_DO]) ?></span>
                <span class="board-preview__column-count">2</span>
            </div>
            <div class="preview-card">
                <div class="preview-card__header">
                    <span class="preview-card__title"><?= __('Write the project README') ?></span>
                    <span class="preview-card__id">#12</span>
                </div>
                <div class="preview-card__meta">
                    <span class="preview-card__priority preview-card__priority--medium"><?= h($priorities[TaskPriorityEnum::MEDIUM]) ?></span>
                    <span class="preview-card__deadline"><i class="bi bi-calendar3"></i><?= __('Friday') ?></span>
                </div>
            </div>
            <div class="preview-card">
                <div class="preview-card__header">
                    <span class="preview-card__title"><?= __('Add demo screenshots') ?></span>
                    <span class="preview-card__id">#14</span>
                </div>
                <div class="preview-card__meta">
                    <span class="preview-card__priority preview-card__priority--low"><?= h($priorities[TaskPriorityEnum::LOW]) ?></span>
                </div>
            </div>
        </div>

        <div class="board-preview__column board-preview__column--progress">
            <div class="board-preview__column-header">
                <span class="board-preview__column-name"><?= h($statuses[TaskStatusEnum::IN_PROGRESS]) ?></span>
                <span class="board-preview__column-count">2</span>
            </div>
            <div class="preview-card">
                <div class="preview-card__header">
                    <span class="preview-card__title"><?= __('Design the landing page') ?></span>
                    <span class="preview-card__id">#9</span>
                </div>
                <p class="preview-card__text"><?= __('Header, feature list and sign-up section.') ?></p>
                <div class="preview-card__meta">
                    <span class="preview-card__priority preview-card__priority--high"><?= h($priorities[TaskPriorityEnum::HIGH]) ?></span>
                    <span class="preview-card__deadline"><i class="bi bi-calendar3"></i><?= __('Today') ?></span>
                </div>
            </div>
            <div class="preview-card preview-card--dragging">
                <div class="preview-card__header">
                    <span class="preview-card__title"><?= __('Polish the mobile layout') ?></span>
                    <span class="preview-card__id">#11</span>
                </div>
                <div class="preview-card__meta">
                    <span class="preview-card__priority preview-card__priority--medium"><?= h($priorities[TaskPriorityEnum::MEDIUM]) ?></span>
                </div>
            </div>
        </div>

        <div class="board-preview__column board-preview__column--blocked">
            <div class="board-preview__column-header">
                <span class="board-preview__column-name"><?= h($statuses[TaskStatusEnum::BLOCKED]) ?></span>
                <span class="board-preview__column-count">1</span>
            </div>
            <div class="preview-card">
                <div class="preview-card__header">
                    <span class="preview-card__title"><?= __('Set up SMTP on production') ?></span>
                    <span class="preview-card__id">#7</span>
                </div>
                <p class="preview-card__text"><?= __('Waiting for the DNS records.') ?></p>
                <div class="preview-card__meta">
                    <span class="preview-card__priority preview-card__priority--high"><?= h($priorities[TaskPriorityEnum::HIGH]) ?></span>
                    <span class="preview-card__deadline preview-card__deadline--overdue"><i class="bi bi-clock-history"></i><?= __('Yesterday') ?></span>
                </div>
            </div>
        </div>

        <div class="board-preview__column board-preview__column--done">
            <div class="board-preview__column-header">
                <span class="board-preview__column-name"><?= h($statuses[TaskStatusEnum::DONE]) ?></span>
                <span class="board-preview__column-count">2</span>
            </div>
            <div class="preview-card">
                <div class="preview-card__header">
                    <span class="preview-card__title"><?= __('Add email confirmation') ?></span>
                    <span class="preview-card__id">#5</span>
                </div>
                <div class="preview-card__meta">
                    <span class="preview-card__priority preview-card__priority--medium"><?= h($priorities[TaskPriorityEnum::MEDIUM]) ?></span>
                </div>
            </div>
            <div class="preview-card">
                <div class="preview-card__header">
                    <span class="preview-card__title"><?= __('Limit login attempts') ?></span>
                    <span class="preview-card__id">#3</span>
                </div>
                <div class="preview-card__meta">
                    <span class="preview-card__priority preview-card__priority--high"><?= h($priorities[TaskPriorityEnum::HIGH]) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
