<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Registrasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => FALSE,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => FALSE,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => FALSE,
            ],
            'tgl' => [
                'type' => 'TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('registrasi');
    }

    public function down()
    {
        //
    }
}
