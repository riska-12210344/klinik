<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id_users";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'email', 'password', 'created_at', 'updated_at'];
}
