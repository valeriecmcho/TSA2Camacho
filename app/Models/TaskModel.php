<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'status',
        'task_date',
        'created_at',
        'is_archived',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules = [
        'title'     => 'required|min_length[3]|max_length[255]',
        'status'    => 'permit_empty|in_list[pending,in_progress,completed]',
        'task_date' => 'required|valid_date',
    ];
    protected $validationMessages = [
        'title' => [
            'required'   => 'Title is required',
            'min_length' => 'Title must be at least 3 characters',
            'max_length' => 'Title cannot exceed 255 characters',
        ],
        'task_date' => [
            'required'   => 'Task date is required',
            'valid_date' => 'Please enter a valid date',
        ],
        'status' => [
            'in_list' => 'Status must be one of: pending, in_progress, completed',
        ],
    ];
    protected $skipValidation = false;

    // Get non-archived tasks for today
    public function getTodayTasks()
    {
        $today = date('Y-m-d');
        return $this->where('task_date', $today)
                    ->where('is_archived', 0)
                    ->orderBy('task_date', 'ASC')
                    ->findAll();
    }

    // Get all non-archived tasks ordered by date
    public function getAllTasksOrderedByDate()
    {
        return $this->where('is_archived', 0)
                    ->orderBy('task_date', 'ASC')
                    ->findAll();
    }
}
