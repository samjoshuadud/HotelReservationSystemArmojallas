<?php
session_start();

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

require_once '../includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Please enter username and password.";
    } else {
        try {
            $pdo  = getDB();
            $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :u LIMIT 1");
            $stmt->execute([':u' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username']  = $user['username'];
                header('Location: index.php');
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Darrel & Ayien's Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { display:flex; justify-content:center; align-items:center; min-height:100vh; background:var(--dark); }
        .login-box { width:100%; max-width:400px; padding:20px; }
        .login-card { background:var(--cream); border-top:3px solid var(--gold); padding:40px; box-shadow:0 8px 40px rgba(0,0,0,0.4); }
        .login-header { text-align:center; margin-bottom:28px; }
        .login-header h1 { font-family:var(--font-display); font-size:1.5rem; font-weight:300; letter-spacing:2px; color:var(--dark); }
        .login-header p { font-size:0.68rem; letter-spacing:2.5px; text-transform:uppercase; color:var(--text-light); margin-top:4px; }
        .form-group { margin-bottom:16px; }
    </style>
</head>
<body>
<div class="login-box">
    <div class="login-card">
        <div class="login-header">
            <p style="color:var(--gold); letter-spacing:4px; font-size:0.65rem; margin-bottom:8px;">★ ★ ★ ★ ★</p>
            <h1>Admin Panel</h1>
            <p>Darrel &amp; Ayien's Five Star Hotel</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required
                       value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:8px;">Login</button>
        </form>

        <p style="text-align:center; margin-top:16px; font-size:0.75rem; color:var(--text-light);">
            <a href="../index.php" style="color:var(--gold-dark);">← Back to Hotel Site</a>
        </p>
    </div>
</div>
</body>
</html>
