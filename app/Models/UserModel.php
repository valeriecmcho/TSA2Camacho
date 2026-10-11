<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'full_name',
        'email',
        'password',
        'created_at',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation (skip for login; only used on insert)
    protected $validationRules = [
        'username'  => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
        'full_name' => 'required|min_length[3]|max_length[100]',
        'email'     => 'required|valid_email|max_length[100]',
    ];
    protected $validationMessages = [
        'username' => [
            'required'   => 'Username is required',
            'min_length' => 'Username must be at least 3 characters',
            'max_length' => 'Username cannot exceed 50 characters',
            'is_unique'  => 'Username already exists',
        ],
        'full_name' => [
            'required'   => 'Full name is required',
            'min_length' => 'Full name must be at least 3 characters',
            'max_length' => 'Full name cannot exceed 100 characters',
        ],
        'email' => [
            'required'   => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'max_length' => 'Email cannot exceed 100 characters',
        ],
    ];
    protected $skipValidation = false;

    // Get demo user
    public function getDemoUser()
    {
        return $this->where('username', 'valerie_camacho')->first();
    }
}
