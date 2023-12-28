<?php

namespace App\Models;

use CodeIgniter\Model;

class LamaranModel extends Model
{
    protected $table = 'lamaran';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'surat_lamaran',
        'cv',
        'ijasah',
        'berkas_tambahan',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
}
