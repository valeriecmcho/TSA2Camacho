<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Home extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $taskModel = new TaskModel();
        $data['todayTasks'] = $taskModel->getTodayTasks();
        $data['today'] = date('Y-m-d');

        return view('home', $data);
    }
}
