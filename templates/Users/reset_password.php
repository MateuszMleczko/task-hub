<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title mb-4"><?= __('Set a new password') ?></h3>
                <?= $this->Form->create() ?>
                <div class="mb-3">
                    <?= $this->Form->control('password', [
                        'label' => __('New password'),
                        'type' => 'password',
                        'class' => 'form-control',
                        'required' => true,
                    ]) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('confirm_password', [
                        'label' => __('Confirm new password'),
                        'type' => 'password',
                        'class' => 'form-control',
                        'required' => true,
                    ]) ?>
                </div>
                <?= $this->Form->button(__('Save new password'), ['class' => 'btn btn-primary w-100']) ?>
                <?= $this->Form->end() ?>
                <hr>
                <?= $this->Html->link(__('Back to login'), $this->Url->build(['action' => 'login']), ['class' => 'btn btn-outline-primary w-100']) ?>
            </div>
        </div>
    </div>
</div>
