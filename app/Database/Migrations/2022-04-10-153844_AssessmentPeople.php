<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssessmentPeople extends Migration
{
    public function up()
    {
        //
    }

    public function down()
    {
        $this->forge->dropTable('AssessmentPeople');
        
    }
}
