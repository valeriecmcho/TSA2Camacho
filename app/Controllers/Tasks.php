<?php

namespace App\Controllers;

use App\Models\TaskModel;

/**
 * Tasks controller – public index, and auth-gated create/edit/delete.
 */
class Tasks extends BaseController
{
    // GET /tasks  – public
    public function index()
    {
        $taskModel = new TaskModel();
        $data['tasks']      = $taskModel->getAllTasksOrderedByDate();
        $data['logged_in']  = session()->get('logged_in');

        return view('tasks', $data);
    }

    // GET /tasks/new  – protected by AuthFilter
    public function newForm()
    {
        return view('task_new', [
            'logged_in' => session()->get('logged_in'),
        ]);
    }

    // POST /tasks/create  – protected by AuthFilter
    public function create()
    {
        $taskModel = new TaskModel();

        $data = [
            'title'      => $this->request->getPost('title'),
            'status'     => $this->request->getPost('status') ?: 'pending',
            'task_date'  => $this->request->getPost('task_date'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if (! $taskModel->save($data)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $taskModel->errors());
        }

        return redirect()->to(base_url('tasks'))->with('success', 'Task created successfully!');
    }

    // GET /tasks/edit/(:num)  – protected by AuthFilter
    public function editForm($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (! $task) {
            return redirect()->to(base_url('tasks'))->with('error', 'Task not found.');
        }

        return view('task_edit', [
            'task'      => $task,
            'logged_in' => session()->get('logged_in'),
        ]);
    }

    // POST /tasks/update/(:num)  – protected by AuthFilter
    public function update($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (! $task) {
            return redirect()->to(base_url('tasks'))->with('error', 'Task not found.');
        }

        $data = [
            'title'     => $this->request->getPost('title'),
            'status'    => $this->request->getPost('status') ?: 'pending',
            'task_date' => $this->request->getPost('task_date'),
        ];

        if (! $taskModel->update($id, $data)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $taskModel->errors());
        }

        return redirect()->to(base_url('tasks'))->with('success', 'Task updated successfully!');
    }

    // POST /tasks/delete/(:num)  – protected by AuthFilter – soft-deletes via is_archived
    public function delete($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (! $task) {
            return redirect()->to(base_url('tasks'))->with('error', 'Task not found.');
        }

        $taskModel->update($id, ['is_archived' => 1]);

        return redirect()->to(base_url('tasks'))->with('success', 'Task archived successfully!');
    }
}
