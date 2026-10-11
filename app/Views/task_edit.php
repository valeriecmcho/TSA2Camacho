<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System - Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
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
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        }
        .btn {
            padding: 10px 25px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover { background-color: #0056b3; }
        .btn-cancel {
            padding: 10px 25px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 3px;
            font-size: 15px;
            text-decoration: none;
            margin-left: 10px;
            display: inline-block;
        }
        .btn-cancel:hover { background-color: #545b62; }
        .alert {
            padding: 10px 15px;
            border-radius: 3px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        .required { color: #dc3545; }
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

        <h1>✏️ Edit Task</h1>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul style="margin:0;padding-left:18px;">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <li><?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('tasks/update/' . $task['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="title">Title <span class="required">*</span></label>
                <input type="text" id="title" name="title"
                       value="<?= esc(old('title', $task['title'])) ?>"
                       placeholder="Enter task title" required>
            </div>

            <div class="form-group">
                <label for="task_date">Due Date <span class="required">*</span></label>
                <input type="date" id="task_date" name="task_date"
                       value="<?= esc(old('task_date', $task['task_date'])) ?>" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="pending"     <?= (old('status', $task['status'])) === 'pending'     ? 'selected' : '' ?>>Pending</option>
                    <option value="in_progress" <?= (old('status', $task['status'])) === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="completed"   <?= (old('status', $task['status'])) === 'completed'   ? 'selected' : '' ?>>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn">Update Task</button>
            <a href="<?= base_url('tasks') ?>" class="btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>
