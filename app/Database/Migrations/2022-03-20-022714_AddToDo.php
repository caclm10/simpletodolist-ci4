<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddToDo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'todo_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'todo_title' => [
                'type' => 'VARCHAR',
                'constraint' => '70',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);

        $this->forge->addPrimaryKey('todo_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'cascade', 'cascade');
        $this->forge->createTable('todos');
    }

    public function down()
    {
        $this->forge->dropTable('todos');
    }
}
