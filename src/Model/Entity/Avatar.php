<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Avatar Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property bool $is_default
 * @property string $storage_key
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class Avatar extends Entity
{
    /**
     * Pola ustawiane wylacznie przez serwer (wlasciciel, zrodlo pliku, rodzaj)
     * NIE moga byc masowo przypisywalne - inaczej formularz moglby podmienic
     * czyj awatar jest czyj. Stad pusta lista.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [];
}
