<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLamaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'surat_lamaran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'cv' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'ijasah' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'berkas_tambahan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => date('Y-m-d H:i:s'), // Set default to current timestamp
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => date('Y-m-d H:i:s'), // Set default to current timestamp
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('lamaran');
    }

    public function down()
    {
        $this->forge->dropTable('lamaran');
    }
}
