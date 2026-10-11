<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System - Welcome</title>
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
        .nav a:hover {
            text-decoration: underline;
        }
        .card-container {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }
        .card {
            flex: 1;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            transition: box-shadow 0.3s;
        }
        .card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card h2 {
            color: #007bff;
            margin-top: 0;
        }
        .card a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        .card a:hover {
            background-color: #0056b3;
        }
        .task-list {
            margin-top: 30px;
        }
        .task-item {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 3px;
        }
        .task-item h3 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .task-item p {
            margin: 5px 0;
            color: #666;
        }
        .task-meta {
            font-size: 0.9em;
            color: #888;
        }
        .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 0.85em;
            font-weight: bold;
        }
        .status.pending {
            background-color: #ffc107;
            color: #333;
        }
        .status.in_progress {
            background-color: #17a2b8;
            color: white;
        }
        .status.completed {
            background-color: #28a745;
            color: white;
        }
        .no-tasks {
            text-align: center;
            padding: 20px;
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="<?= base_url('home') ?>">Home</a>
            <a href="<?= base_url('tasks') ?>">All Tasks</a>
            <a href="<?= base_url('profile') ?>">Profile</a>
            <a href="<?= base_url('about') ?>">About</a>
            <?php if (session()->get('logged_in')): ?>
                <form action="<?= base_url('logout') ?>" method="post" style="display:inline;">
                    <?= csrf_field() ?>
                    <button type="submit" style="background:none;border:none;color:#dc3545;font-weight:bold;cursor:pointer;font-size:inherit;padding:0;">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?= base_url('login') ?>">Login</a>
            <?php endif; ?>
        </div>

        <h1>Task Management System</h1>
        <p>Welcome! Here are your tasks scheduled for today (<?= date('F j, Y', strtotime($today)) ?>):</p>

        <div class="task-list">
            <?php if (!empty($todayTasks)): ?>
                <?php foreach ($todayTasks as $task): ?>
                    <div class="task-item">
                        <h3><?= esc($task['title']) ?></h3>
                        <div class="task-meta">
                            <span class="status <?= $task['status'] ?>"><?= ucfirst(str_replace('_', ' ', $task['status'])) ?></span>
                            <span> | Due: <?= date('F j, Y', strtotime($task['task_date'])) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-tasks">
                    <p>No tasks scheduled for today!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
