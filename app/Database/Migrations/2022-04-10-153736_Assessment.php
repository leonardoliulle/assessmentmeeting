<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;


class Assessment extends Migration
{
    public function up()
    {
        //
            $this->forge->addField([
                'id'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'name'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'description'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255'
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('assessment');
    }

    public function down()
    {
        $this->forge->dropTable('assessment');
    }
}
