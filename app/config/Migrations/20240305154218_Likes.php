<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Likes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('likes');
        $table->addColumn('article_id', 'integer')
              ->addColumn('user_id', 'integer')
              ->addIndex(['article_id', 'user_id'], ['unique' => true])
              ->addForeignKey('article_id', 'articles', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
              ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
              ->create();
    }
}
