<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrasiModel extends Model
{
    protected $table = 'registrasi';
    protected $primaryKey = 'id';
    protected $returnType = RegistrasiModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'tgl'
    ];
}
