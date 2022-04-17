<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssessmentPeopleAtributes extends Migration
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
                'user_id'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    // 'unsigned'       => true,
                ],
                'assessment_id'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    // 'unsigned'       => true,
                ],
                'positives'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 100,
                    // 'unsigned'       => true,
                ],
                'negative'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 100,
                    // 'unsigned'       => true,
                ],
                'description'          => [
                    'type'           => 'TEXT',
                    // 'unsigned'       => true,
                ],
                'stars'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    // 'unsigned'       => true,
                ],

            ]);

            $this->forge->addKey('id', true);
            // $this->forge->addForeignKey('assessment_id', 'assessment', 'id');
            // $this->forge->addForeignKey('user_id', 'users', 'id');
            $this->forge->createTable('assessmentPeopleAtributes');
    }

    public function down()
    {
        //
        $this->forge->dropTable('assessmentPeopleAtributes');
        
    }
}
