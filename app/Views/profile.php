<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System - Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
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
        .profile-card {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 30px;
            margin-top: 20px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .avatar {
            width: 80px;
            height: 80px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            margin-right: 20px;
        }
        .profile-info h2 {
            margin: 0 0 5px 0;
            color: #333;
        }
        .profile-info .username {
            color: #666;
            font-size: 0.9em;
        }
        .profile-details {
            margin-top: 20px;
        }
        .detail-row {
            margin-bottom: 15px;
        }
        .detail-label {
            font-weight: bold;
            color: #333;
            display: inline-block;
            width: 100px;
        }
        .detail-value {
            color: #666;
        }
        .no-user {
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

        <h1>User Profile</h1>

        <?php if (!empty($user)): ?>
            <div class="profile-card">
                <div class="profile-header">
                    <div class="avatar">
                        <?= strtoupper(substr($user['full_name'], 0, 1)) ?>
                    </div>
                    <div class="profile-info">
                        <h2><?= esc($user['full_name']) ?></h2>
                        <div class="username">@<?= esc($user['username']) ?></div>
                    </div>
                </div>

                <div class="profile-details">
                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value"><?= esc($user['email']) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">User ID:</span>
                        <span class="detail-value"><?= $user['id'] ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Member Since:</span>
                        <span class="detail-value"><?= date('F j, Y', strtotime($user['created_at'])) ?></span>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="no-user">
                <p>User profile not found!</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
