<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddTasksTable extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/guides/writing-migrations/migration-methods.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        if (!$this->hasTable('tasks')) {
            $this->table('tasks')
                ->addColumn('user_id', 'integer', [
                    'null' => false
                ])
                ->addColumn('title', 'string', [
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('description', 'text', [
                    'null' => true
                ])
                ->addColumn('status', 'integer', [
                    'null' => false,
                    'default' => 0
                ])
                ->addColumn('priority', 'integer', [
                    'null' => false,
                    'default' => 0
                ])
                ->addColumn('deadline', 'datetime', [
                    'null' => true,
                    'default' => null,
                ])
                ->addColumn('created', 'datetime', [
                    'null' => true,
                    'default' => null,
                ])
                ->addColumn('modified', 'datetime', [
                    'null' => true,
                    'default' => null,
                ])
                ->create();
        }
    }
}
