<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table = 'profile';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'first_name',
        'last_name',
        'org_name',
        'location',
        'email',
        'phone',
        'birthday',
    ];
    protected $useTimestamps = true;
}
