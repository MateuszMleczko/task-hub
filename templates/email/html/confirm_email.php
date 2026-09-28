<p><?= __d('email', 'Hello') . ',' ?></p>

<p><?= __d('email', 'Thank you for registering at TaskHub. Click the link below to confirm your email address and activate your account:') ?></p>

<p><a href="<?= h($url) ?>" style="font-size: 16px;"><?= __d('email', 'Confirm your email') ?></a></p>

<p><?= __d('email', 'If the button above does not work, copy and paste this link into your browser:') ?><br>
    <a href="<?= h($url) ?>"><?= h($url) ?></a></p>

<p><strong><?= __d('email', 'This link is valid for {0} hours', $hours) ?></strong></p>

<p style="color: #888; font-size: 13px;"><?= __d('email', 'If you did not create a TaskHub account, please ignore this message.') ?></p>

<p>TaskHub ©</p>
