<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System - About</title>
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
        .about-content {
            margin-top: 20px;
        }
        .developer-card {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 30px;
            margin-top: 20px;
            text-align: center;
        }
        .developer-avatar {
            width: 100px;
            height: 100px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: bold;
            margin: 0 auto 20px auto;
        }
        .developer-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .developer-role {
            color: #666;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .developer-info {
            text-align: left;
            background-color: white;
            padding: 20px;
            border-radius: 3px;
            border-left: 3px solid #007bff;
        }
        .developer-info h3 {
            color: #333;
            margin-top: 0;
        }
        .developer-info p {
            color: #666;
            line-height: 1.6;
        }
        .tech-stack {
            margin-top: 20px;
        }
        .tech-stack h3 {
            color: #333;
            margin-bottom: 15px;
        }
        .tech-item {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            margin: 5px;
            font-size: 14px;
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

        <h1>About This Application</h1>

        <div class="about-content">
            <p>This is a Task Management System built with CodeIgniter 4 and MySQL. It provides a simple interface for managing daily tasks and user profiles.</p>

            <div class="developer-card">
                <div class="developer-avatar">V</div>
                <div class="developer-name">Ann Valerie L. Camacho</div>
                <div class="developer-role">UI/UX Designer</div>

                <div class="developer-info">
                    <h3>About the Developer</h3>
                    <p>
                        I am a dedicated UI/UX Designer passionate about creating intuitive, engaging, and user-friendly
                        digital experiences. I focus on designing clean and accessible interfaces that enhance usability, simplify
                        navigation, and provide users with an efficient and seamless experience.
                    </p>
                    <p>
                       This Task Management System was developed as a demonstration of 
                       UI/UX design and technical skills, showcasing a clean interface, 
                       responsive design, organized information, and user-centered functionality.
                    </p>
                </div>

                <div class="tech-stack">
                    <h3>Technologies Used</h3>
                    <span class="tech-item">PHP 8.1+</span>
                    <span class="tech-item">CodeIgniter 4</span>
                    <span class="tech-item">MySQL</span>
                    <span class="tech-item">HTML5</span>
                    <span class="tech-item">CSS3</span>
                    <span class="tech-item">XAMPP</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
