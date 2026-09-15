<?php
declare(strict_types=1);

namespace App\View\Helper;

use App\Model\Entity\Avatar;
use Cake\View\Helper;

/**
 * Profile helper
 *
 * Small render helpers for the user profile page (avatar and completion ring).
 *
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class ProfileHelper extends Helper
{
    /**
     * Radius of the completion ring circle (matches the viewBox in `ring()`).
     */
    private const RING_RADIUS = 30;

    /**
     * @var array<string>
     */
    protected array $helpers = ['Html'];

    /**
     * Renders the user's avatar image as a `.avatar` block with the given size modifier.
     *
     * @param \App\Model\Entity\Avatar $avatar Avatar entity.
     * @param string $size Size modifier (`small` for the navbar, `large` for the profile header).
     * @return string
     */
    public function avatar(Avatar $avatar, string $size = 'large'): string
    {
        return $this->Html->image($avatar->storage_key, [
            'alt' => __('Avatar'),
            'class' => 'avatar avatar--' . $size,
        ]);
    }

    /**
     * Renders the svg completion ring filled to the given percentage.
     *
     * @param int $percent Value between 0 and 100.
     * @return string
     */
    public function ring(int $percent): string
    {
        $circumference = 2 * M_PI * self::RING_RADIUS;
        $filled = $circumference * max(0, min(100, $percent)) / 100;

        return sprintf(
            '<svg class="profile-stat__ring" viewBox="0 0 72 72" aria-hidden="true">'
            . '<circle class="profile-stat__ring-track" cx="36" cy="36" r="%1$d"/>'
            . '<circle class="profile-stat__ring-fill" cx="36" cy="36" r="%1$d" stroke-dasharray="%2$.1f %3$.1f"/>'
            . '</svg>',
            self::RING_RADIUS,
            $filled,
            $circumference,
        );
    }
}
