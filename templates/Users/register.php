<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title mb-4"><?= __('Sign up') ?></h3>
                <?= $this->Form->create($user) ?>
                <div class="mb-3">
                    <?= $this->Form->control('name', [
                        'label' => __('Name'),
                        'class' => 'form-control',
                        'required' => true,
                    ]) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('email', [
                        'label' => __('Email'),
                        'class' => 'form-control',
                        'required' => true,
                    ]) ?>
                </div>
                <div class="mb-3">
                    <span class="form-label d-block"><?= __('Avatar') ?></span>

                    <div class="row row-cols-4 g-2">
                        <?php foreach ($avatars as $avatar): ?>
                            <div class="col">
                                <input class="btn-check"
                                       type="radio"
                                       name="avatar_id"
                                       id="<?= $avatar->id ?>"
                                       value="<?= $avatar->id ?>"
                                >

                                <label class="btn btn-outline-primary w-100 p-1"
                                       for="<?= $avatar->id ?>">
                                    <?= $this->Html->image($avatar->storage_key, [
                                        'alt' => __('Avatar'),
                                        'width' => 48,
                                        'height' => 48,
                                        'class' => 'img-fluid',
                                    ]) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('password', [
                        'label' => __('Password'),
                        'type' => 'password',
                        'class' => 'form-control',
                        'required' => true,
                    ]) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('confirm_password', [
                        'label' => __('Confirm password'),
                        'type' => 'password',
                        'class' => 'form-control',
                        'required' => true,
                    ]) ?>
                </div>
                <?= $this->Form->button(__('Sign up'), ['class' => 'btn btn-primary w-100']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
