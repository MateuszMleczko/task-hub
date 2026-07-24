<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title mb-4"><?= __('Login') ?></h3>
                <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>
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
                <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary w-100']) ?>
                <div class="text-center mt-3">
                    <?= $this->Html->link(__('Forgot your password?'), $this->Url->build(['action' => 'forgotPassword']), ['class' => 'btn btn-link']) ?>
                </div>
                <?= $this->Form->end() ?>
                <hr>
                <?= $this->Html->link(__('Sign up'), $this->Url->build(['action' => 'register']), ['class' => 'btn btn-outline-primary w-100']) ?>
            </div>
        </div>
    </div>
</div>
