<?php
require 'config.php';
require 'auth.php';

$error = '';

    /*
    * TASK 3a-3: password_verify() compares the submitted password
    * against the stored HASH — we never store or compare plaintext.
    * session_regenerate_id(true) issues a fresh session ID on login
    * to prevent session fixation attacks.
    */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (isset($USERS[$username]) && password_verify($password, $USERS[$username]['hash'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = $username;
        $_SESSION['name'] = $USERS[$username]['name'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Wrong username or password.';
    }
}

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in — Club Members Manager</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="login-shell">

    <h1>Club Members Manager</h1>
    <p class="sub">Sign in to manage the member list.</p>

    <?php if ($error !== ''): ?>
        <p class="flash warn"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form class="card" method="post" action="login.php">
        <div class="field">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" autofocus>
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        <button type="submit" class="btn">Sign in</button>
    </form>

    <p class="hint">Classroom account: admin / admin123</p>

</div>
</body>
</html>
