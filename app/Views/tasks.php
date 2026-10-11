<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System - All Tasks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .nav {
            margin-bottom: 20px;
        }
        .nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .nav a:hover { text-decoration: underline; }
        .task-list { margin-top: 20px; }
        .task-item {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 3px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .task-info { flex: 1; }
        .task-item h3 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .task-item p { margin: 5px 0; color: #666; }
        .task-meta { font-size: 0.9em; color: #888; }
        .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 0.85em;
            font-weight: bold;
        }
        .status.pending     { background-color: #ffc107; color: #333; }
        .status.in_progress { background-color: #17a2b8; color: white; }
        .status.completed   { background-color: #28a745; color: white; }
        .no-tasks {
            text-align: center;
            padding: 20px;
            color: #888;
            font-style: italic;
        }
        .task-actions { display: flex; gap: 8px; margin-left: 15px; }
        .btn-sm {
            padding: 5px 12px;
            border: none;
            border-radius: 3px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: opacity 0.2s;
        }
        .btn-sm:hover { opacity: 0.85; }
        .btn-edit   { background-color: #ffc107; color: #333; }
        .btn-delete { background-color: #dc3545; color: white; }
        .btn-new {
            display: inline-block;
            padding: 8px 18px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
            margin-bottom: 15px;
            transition: background-color 0.3s;
        }
        .btn-new:hover { background-color: #1e7e34; }
        .alert {
            padding: 10px 15px;
            border-radius: 3px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .alert-success { background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .alert-danger  { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="<?= base_url('home') ?>">Home</a>
            <a href="<?= base_url('tasks') ?>">All Tasks</a>
            <a href="<?= base_url('profile') ?>">Profile</a>
            <a href="<?= base_url('about') ?>">About</a>
            <?php if ($logged_in): ?>
                <form action="<?= base_url('logout') ?>" method="post" style="display:inline;">
                    <?= csrf_field() ?>
                    <button type="submit" style="background:none;border:none;color:#dc3545;font-weight:bold;cursor:pointer;font-size:inherit;padding:0;">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?= base_url('login') ?>">Login</a>
            <?php endif; ?>
        </div>

        <h1>All Tasks</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <?php if ($logged_in): ?>
            <a href="<?= base_url('tasks/new') ?>" class="btn-new">+ New Task</a>
        <?php endif; ?>

        <p>Here are all your tasks, ordered by due date:</p>

        <div class="task-list">
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <div class="task-item">
                        <div class="task-info">
                            <h3><?= esc($task['title']) ?></h3>
                            <div class="task-meta">
                                <span class="status <?= $task['status'] ?>"><?= ucfirst(str_replace('_', ' ', $task['status'])) ?></span>
                                <span> | Due: <?= date('F j, Y', strtotime($task['task_date'])) ?></span>
                                <span> | Created: <?= date('F j, Y g:i A', strtotime($task['created_at'])) ?></span>
                            </div>
                        </div>
                        <?php if ($logged_in): ?>
                            <div class="task-actions">
                                <a href="<?= base_url('tasks/edit/' . $task['id']) ?>" class="btn-sm btn-edit">Edit</a>
                                <form action="<?= base_url('tasks/delete/' . $task['id']) ?>" method="post"
                                      onsubmit="return confirm('Archive this task?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn-sm btn-delete">Delete</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-tasks">
                    <p>No tasks found!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
