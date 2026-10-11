<?php
/**
 * Unified Database Setup Script for TSA2Camacho
 *
 * Sets up the `tsa1camacho` database and creates all tables:
 *  - users (with password column and demo credentials)
 *  - tasks (with is_archived column and sample tasks)
 *  - customers (with sample customer records)
 *
 * Usage:
 *  - Web Browser: http://localhost/TSA2Camacho/setup_database.php
 *  - CLI: php setup_database.php
 */

$host     = 'localhost';
$username = 'root';
$password = '';
$database = 'tsa1camacho';

$isCli = (php_sapi_name() === 'cli');

function output($msg, $type = 'info') {
    global $isCli;
    if ($isCli) {
        $prefix = match($type) {
            'success' => '[OK] ',
            'error'   => '[ERROR] ',
            'warning' => '[WARN] ',
            default   => '[INFO] '
        };
        echo $prefix . strip_tags($msg) . "\n";
    } else {
        $color = match($type) {
            'success' => '#10b981',
            'error'   => '#ef4444',
            'warning' => '#f59e0b',
            default   => '#3b82f6'
        };
        echo "<div style='margin: 6px 0; color: {$color}; font-family: monospace;'>● {$msg}</div>";
    }
}

if (! $isCli) {
    echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Database Setup</title>";
    echo "<style>
        body { font-family: system-ui, -apple-system, sans-serif; background: #0f172a; color: #f8fafc; padding: 40px; }
        .card { max-width: 700px; margin: 0 auto; background: #1e293b; border-radius: 12px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,0.4); border: 1px solid #334155; }
        h1 { margin-top: 0; font-size: 22px; color: #38bdf8; border-bottom: 1px solid #334155; padding-bottom: 12px; }
        .summary { margin-top: 20px; padding: 14px; background: #0f172a; border-radius: 8px; border-left: 4px solid #10b981; }
        a { color: #38bdf8; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style></head><body><div class='card'>";
    echo "<h1>TSA2 Database Setup &amp; Migration</h1>";
}

try {
    // 1. Connect to MySQL server
    $mysqli = new mysqli($host, $username, $password);
    if ($mysqli->connect_error) {
        throw new Exception("Connection failed: " . $mysqli->connect_error . " (Make sure XAMPP MySQL is running)");
    }
    output("Connected to MySQL server successfully.", 'success');

    // 2. Create database if it doesn't exist
    if (! $mysqli->query("CREATE DATABASE IF NOT EXISTS `{$database}`")) {
        throw new Exception("Error creating database: " . $mysqli->error);
    }
    output("Database `{$database}` is ready.", 'success');

    // 3. Select database
    $mysqli->select_db($database);

    // 4. Drop old tables for clean rebuild
    $mysqli->query("DROP TABLE IF EXISTS tasks");
    $mysqli->query("DROP TABLE IF EXISTS users");
    $mysqli->query("DROP TABLE IF EXISTS customers");
    output("Old tables cleared for fresh setup.", 'info');

    // 5. Create `users` table
    $createUsersSql = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        full_name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL DEFAULT '',
        created_at DATETIME NOT NULL
    )";
    if (! $mysqli->query($createUsersSql)) {
        throw new Exception("Error creating `users` table: " . $mysqli->error);
    }
    output("Table `users` created.", 'success');

    // 6. Create `tasks` table
    $createTasksSql = "CREATE TABLE tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
        task_date DATE NOT NULL,
        is_archived TINYINT(1) NOT NULL DEFAULT 0,
        created_at DATETIME NOT NULL
    )";
    if (! $mysqli->query($createTasksSql)) {
        throw new Exception("Error creating `tasks` table: " . $mysqli->error);
    }
    output("Table `tasks` created.", 'success');

    // 7. Create `customers` table
    $createCustomersSql = "CREATE TABLE customers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20),
        created_at DATETIME NOT NULL
    )";
    if (! $mysqli->query($createCustomersSql)) {
        throw new Exception("Error creating `customers` table: " . $mysqli->error);
    }
    output("Table `customers` created.", 'success');

    // 8. Seed Users
    $defaultPassHash = password_hash('password123', PASSWORD_DEFAULT);
    $userStmt = $mysqli->prepare("INSERT INTO users (id, username, full_name, email, password, created_at) VALUES (?, ?, ?, ?, ?, NOW())");

    $usersData = [
        [202310616, 'valerie_camacho', 'Ann Valerie L. Camacho', 'valerie.camacho@gmail.com', $defaultPassHash],
        [1, 'admin', 'Administrator', 'admin@example.com', $defaultPassHash],
        [2, 'cashier1', 'John Smith', 'cashier1@example.com', $defaultPassHash],
        [3, 'cashier2', 'Jane Doe', 'cashier2@example.com', $defaultPassHash],
        [4, 'manager', 'Robert Johnson', 'manager@example.com', $defaultPassHash],
        [5, 'supervisor', 'Emily Brown', 'supervisor@example.com', $defaultPassHash],
    ];

    foreach ($usersData as $u) {
        $userStmt->bind_param('issss', $u[0], $u[1], $u[2], $u[3], $u[4]);
        $userStmt->execute();
    }
    $userStmt->close();
    output("Inserted demo & system users (Demo: <strong>valerie_camacho</strong> / password: <strong>password123</strong>).", 'success');

    // 9. Seed Tasks
    $taskStmt = $mysqli->prepare("INSERT INTO tasks (title, status, task_date, is_archived, created_at) VALUES (?, ?, ?, 0, NOW())");
    $today = date('Y-m-d');
    $tasksData = [
        ['Complete project documentation', 'in_progress', $today],
        ['Review code changes', 'pending', $today],
        ['Database optimization', 'pending', date('Y-m-d', strtotime('+1 day'))],
        ['User interface updates', 'pending', date('Y-m-d', strtotime('+2 days'))],
        ['Security audit', 'pending', date('Y-m-d', strtotime('+3 days'))],
        ['Performance testing', 'pending', date('Y-m-d', strtotime('+4 days'))],
        ['API integration', 'pending', date('Y-m-d', strtotime('+5 days'))],
        ['Deployment preparation', 'pending', date('Y-m-d', strtotime('+6 days'))],
    ];

    foreach ($tasksData as $t) {
        $taskStmt->bind_param('sss', $t[0], $t[1], $t[2]);
        $taskStmt->execute();
    }
    $taskStmt->close();
    output("Inserted 8 initial tasks.", 'success');

    // 10. Seed Customers
    $custSql = "INSERT INTO customers (full_name, email, phone, created_at) VALUES
        ('Juan Dela Cruz', 'juan@example.com', '09171234567', NOW()),
        ('Maria Santos', 'maria@example.com', '09181234567', NOW()),
        ('Pedro Reyes', 'pedro@example.com', '09191234567', NOW()),
        ('Ana Garcia', 'ana@example.com', '09201234567', NOW()),
        ('Mark Flores', 'mark@example.com', '09211234567', NOW())";
    $mysqli->query($custSql);
    output("Inserted 5 customer records.", 'success');

    $mysqli->close();

    output("<strong>Database setup completed successfully!</strong>", 'success');

    if (! $isCli) {
        echo "<div class='summary'>";
        echo "<h3 style='margin: 0 0 10px 0; color: #34d399;'>Setup Summary</h3>";
        echo "<div>Database: <code>{$database}</code></div>";
        echo "<div>Tables created: <code>users</code>, <code>tasks</code>, <code>customers</code></div>";
        echo "<div style='margin-top: 10px;'>Demo Login: <strong>username:</strong> <code>valerie_camacho</code> | <strong>password:</strong> <code>password123</code></div>";
        echo "<div style='margin-top: 15px;'><a href='public/'>&rarr; Proceed to Login / Application</a></div>";
        echo "</div>";
    }

} catch (Exception $e) {
    output($e->getMessage(), 'error');
}

if (! $isCli) {
    echo "</div></body></html>";
}
