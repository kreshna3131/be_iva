<?php

namespace App\Models;

use CodeIgniter\Model;

class LowkerModel extends Model
{
    protected $table = 'job';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'logo',
        'posisi',
        'nama_perusahaan',
        'locasi',
        'date',
        'email',
        'gaji',
        'deskripsi',
        'syarat',
        'tentang_perusahaan',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
