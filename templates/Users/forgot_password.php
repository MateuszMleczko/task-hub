<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title mb-4"><?= __('Reset your password') ?></h3>
                <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'forgotPassword']]) ?>
                <div class="mb-3">
                    <?= $this->Form->control('email', [
                        'label' => __('Email'),
                        'type' => 'email',
                        'class' => 'form-control',
                        'required' => true,
                    ]) ?>
                </div>
                <?= $this->Form->button(__('Send reset link'), ['class' => 'btn btn-primary w-100']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
