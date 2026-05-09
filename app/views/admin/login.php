<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — D&A Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETROOT ?>/css/style.css">
    <style>
        body { background: var(--burgundy); display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .login-card { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); width: 100%; max-width: 400px; }
        .login-title { font-family: var(--font-heading); color: var(--burgundy); text-align: center; margin-bottom: 30px; font-size: 2rem; }
    </style>
</head>
<body>

<div class="login-card">
    <h1 class="login-title">Admin Login</h1>

    <?php if ($data['error']): ?>
        <div class="alert alert-error" style="margin-bottom:20px;">
            <?= htmlspecialchars($data['error']) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= URLROOT ?>/admin/login">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required placeholder="Enter username">
        </div>
        <div class="form-group" style="margin-top:16px;">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Enter password">
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%; margin-top:24px; padding:12px;">Login</button>
    </form>
    
    <div style="text-align:center; margin-top:20px;">
        <a href="<?= URLROOT ?>/home" style="color:var(--text-light); text-decoration:none; font-size:0.9rem;">&larr; Back to Site</a>
    </div>
</div>

</body>
</html>
