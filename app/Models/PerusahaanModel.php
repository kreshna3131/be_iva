<?php

namespace App\Models;

use CodeIgniter\Model;

class PerusahaanModel extends Model
{
    protected $table = 'perusahaan';
    protected $primaryKey = 'id';
    protected $returnType = PerusahaanModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'url',
        'tgl'
    ];
}
