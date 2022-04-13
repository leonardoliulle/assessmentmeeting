<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssessmentPeople extends Migration
{
    public function up()
    {
        //
            $this->forge->addField([
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
            $this->forge->createTable('AssessmentPeople');
    }

    public function down()
    {
        $this->forge->dropTable('AssessmentPeople');
        
    }
}
