<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Avatar Entity
 *
 * @property int $id
 * @property string $storage_key
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class Avatar extends Entity
{
    /**
     * @var array<string, bool>
     */
    protected array $_accessible = [];
}
