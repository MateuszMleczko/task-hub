<p><?= __d('email', 'Hello') . ',' ?></p>

<p><?= __d('email', 'We received a request to reset your TaskHub password. Click the link below to set a new password:') ?></p>

<p><a href="<?= h($url) ?>" style="font-size: 16px;"><?= __d('email', 'Reset your password') ?></a></p>

<p><?= __d('email', 'If the button above does not work, copy and paste this link into your browser:') ?><br>
    <a href="<?= h($url) ?>"><?= h($url) ?></a></p>

<p><strong><?= __d('email', 'This link is valid for one hour') ?></strong></p>

<p style="color: #888; font-size: 13px;"><?= __d('email', 'If you did not request password reset, please ignore this message.') ?></p>

<p>TaskHub ©</p>

