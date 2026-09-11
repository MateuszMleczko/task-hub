<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class SeedDefaultAvatarsToAvatarsTable extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/guides/writing-migrations/migration-methods.html#the-change-method
     *
     * @return void
     */
    public function up(): void
    {
        $this->table('avatars')->insert([
            [
                'user_id' => null,
                'is_default' => true,
                'storage_key' => 'avatar-bear.svg',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => null,
                'is_default' => true,
                'storage_key' => 'avatar-bee.svg',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => null,
                'is_default' => true,
                'storage_key' => 'avatar-eagle.svg',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => null,
                'is_default' => true,
                'storage_key' => 'avatar-fox.svg',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => null,
                'is_default' => true,
                'storage_key' => 'avatar-frog.svg',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => null,
                'is_default' => true,
                'storage_key' => 'avatar-owl.svg',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => null,
                'is_default' => true,
                'storage_key' => 'avatar-penguin.svg',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => null,
                'is_default' => true,
                'storage_key' => 'avatar-whale.svg',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ])->saveData();
    }

    public function down(): void
    {
        $this->execute('DELETE FROM avatars WHERE is_default = 1');
    }
}
