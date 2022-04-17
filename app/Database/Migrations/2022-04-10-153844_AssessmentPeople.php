<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
$forge = \Config\Database::forge();

class AssessmentPeople extends Migration
{
    public function up()
    {
        //
            $this->forge->addField([
                'id'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                ],

                'user_id'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                ],
                'assessment_id'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                ],
                'madecount'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                ],

            ]);
            
            $this->forge->addKey('id', true);
            $this->forge->addForeignKey('assessment_id', 'assessment', 'id');
            $this->forge->addForeignKey('user_id', 'users', 'id');
            $this->forge->createTable('assessmentPeople');
    }

    public function down()
    {
        $this->forge->dropTable('AssessmentPeople');
        
    }
}
