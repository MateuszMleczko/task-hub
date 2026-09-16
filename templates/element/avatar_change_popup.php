<dialog class="avatar-popup" id="avatar-popup" aria-labelledby="avatar-popup-title">
    <?= $this->Form->create(null, [
        'url' => ['controller' => 'Users', 'action' => 'changeAvatar'],
        'class' => 'avatar-popup__form',
    ]) ?>
        <div class="avatar-popup__header">
            <div class="avatar-popup__heading">
                <span class="avatar-popup__eyebrow"><?= __('Profile') ?></span>
                <h2 class="avatar-popup__title" id="avatar-popup-title"><?= __('Choose your avatar') ?></h2>
            </div>
            <button type="button" class="avatar-popup__close" data-avatar-popup-close aria-label="<?= __('Close') ?>">
                <i class="bi bi-x-lg" aria-hidden="true"></i>
            </button>
        </div>

        <div class="avatar-popup__body">
            <div class="avatar-popup__grid">
                <?php foreach ($avatars as $avatar): ?>
                    <label class="avatar-popup__option">
                        <input class="avatar-popup__input"
                               type="radio"
                               name="avatar_id"
                               value="<?= (int)$avatar->id ?>"
                               <?= $avatar->id === $userAvatar?->id ? 'checked' : '' ?>
                        >
                        <?= $this->Html->image($avatar->storage_key, [
                            'alt' => __('Avatar'),
                            'class' => 'avatar-popup__img',
                        ]) ?>
                        <span class="avatar-popup__check" aria-hidden="true">
                            <i class="bi bi-check-lg"></i>
                        </span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="avatar-popup__footer">
            <button type="button" class="avatar-popup__cancel" data-avatar-popup-close><?= __('Cancel') ?></button>
            <button type="submit" class="avatar-popup__submit">
                <i class="bi bi-check2" aria-hidden="true"></i><?= __('Save') ?>
            </button>
        </div>
    <?= $this->Form->end() ?>
</dialog>
