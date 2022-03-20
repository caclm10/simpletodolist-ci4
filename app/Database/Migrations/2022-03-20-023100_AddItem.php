<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddItem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'item_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'todo_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'item_content' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'is_done' => [
                'type' => 'TINYINT',
                'default' => 0
            ]
        ]);

        $this->forge->addPrimaryKey('item_id');
        $this->forge->addForeignKey('todo_id', 'todos', 'todo_id', 'cascade', 'cascade');
        $this->forge->createTable('items');
    }

    public function down()
    {
        $this->forge->dropTable('items');
    }
}
