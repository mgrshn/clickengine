<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<body>
    <h1>Home Page</h1>
    <?php
    echo("You are signed in! Your id is {$this->session->get('user_id')}");
    ?>
    <form action="/logout"  method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
