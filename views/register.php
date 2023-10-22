<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<body>
<h1>Register Page</h1>
<form action="/register" method="post">
    <div>
        <label for="email">
            Email
            <input type="text" name="email" value="">
        </label>
        <?php if ($this->session->has('email')) ?>
        <div style="color:crimson">
            <?php echo ($this->session->getFlash('email')) ?>
        </div>
    </div>
    <div>
        <label for="password">
            Password
            <input type="password" name="password" value="">
        </label>
        <?php if ($this->session->has('password')) ?>
        <div style="color:crimson">
            <?php echo ($this->session->getFlash('password')) ?>
        </div>
    </div>
    <input type="submit" value="Sign up">
</form>
</body>
</html>
