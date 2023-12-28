<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Job extends Migration
{
    public function up()
    {
        // Job Table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'posisi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_perusahaan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'locasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'gaji' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'syarat' => [
                'type' => 'TEXT',
            ],
            'tentang_perusahaan' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('job');
    }

    public function down()
    {
    
    }
}
