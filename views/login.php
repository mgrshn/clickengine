<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<h1>Login page</h1>
<body>
    <form action="/login" method="post">
        <div>
                Email
                <input type="email" name="email" value="">
        </div>
        <div>
                Password
                <input type="password" name="password" value="">
        </div>
        <?php if ($this->session->has('errors')) ?>
            <div style="color:crimson">
            <?php echo ($this->session->getFlash('errors')) ?>
            </div>
        <input type="submit" value="Login">
    </form>
<br>
<div>
    <a href="/register">Create Account</a>
</div>
</body>
</html>