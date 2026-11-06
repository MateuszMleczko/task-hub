<footer class="site-footer">
    <div class="container site-footer__inner">
        <ul class="site-footer__list">
            <li>TaskHub &copy; <?= date('Y') ?></li>
            <li><?= __('Portfolio demo project') ?></li>
            <li>
                <a class="site-footer__link" href="https://github.com/MateuszMleczko/task-hub" target="_blank" rel="noopener"><?= __('Open source on GitHub') ?></a>
            </li>
            <li>
                <?= $this->Html->link(__('Privacy policy'), ['controller' => 'Legal', 'action' => 'privacy'], [
                    'class' => 'site-footer__link',
                ]) ?>
            </li>
        </ul>

        <?= $this->element('contact_buttons') ?>
    </div>
</footer>
