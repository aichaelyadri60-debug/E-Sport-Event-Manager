<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="./assets/auth.css">
</head>
<body>

<div class="auth-card">
    <h2>Admin Login</h2>

    <?php if (!empty($error)) { ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <form method="POST" action="index.php?page=authenticate">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <p>
        No account ?
        <a href="index.php?page=register">Register</a>
    </p>
</div>

</body>
</html>
