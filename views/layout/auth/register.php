<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Register</title>
    <link rel="stylesheet" href="./assets/auth.css">
</head>
<body>

<div class="auth-card">
    <h2>Create Admin Account</h2>

    <form method="POST" action="index.php?page=auth&action=store">
        <input type="name" name="name" placeholder="name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Register</button>
    </form>

    <p>
        Already have an account ?
        <a href="index.php?page=login">Login</a>
    </p>
</div>

</body>
</html>
