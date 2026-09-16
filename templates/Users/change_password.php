<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title mb-4"><?= __('Change password') ?></h3>
                <?= $this->Form->create() ?>
                <div class="mb-3">
                    <?= $this->Form->control('current_password', [
                        'label' => __('Current password'),
                        'type' => 'password',
                        'class' => 'form-control',
                        'required' => true,
                        'autocomplete' => 'current-password',
                    ]) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('new_password', [
                        'label' => __('New password'),
                        'type' => 'password',
                        'class' => 'form-control',
                        'required' => true,
                        'autocomplete' => 'new-password',
                    ]) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('confirm_password', [
                        'label' => __('Confirm new password'),
                        'type' => 'password',
                        'class' => 'form-control',
                        'required' => true,
                        'autocomplete' => 'new-password',
                    ]) ?>
                </div>
                <?= $this->Form->button(__('Change password'), ['class' => 'btn btn-primary w-100']) ?>
                <?= $this->Form->end() ?>
                <hr>
                <?= $this->Html->link(__('Back to profile'), $this->Url->build(['action' => 'profile']), ['class' => 'btn btn-outline-primary w-100']) ?>
            </div>
        </div>
    </div>
</div>
