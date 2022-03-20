<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_name' => [
                'type' => 'VARCHAR',
                'constraint' => '70',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '70',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);

        $this->forge->addPrimaryKey('user_id');
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
