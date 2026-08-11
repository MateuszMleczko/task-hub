<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title mb-4"><?= __('Sign up') ?></h3>
                <?= $this->Form->create() ?>
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
