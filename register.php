<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $users = [];

    if (file_exists('users.json')) {
        $users = json_decode(file_get_contents('users.json'), true);
    }

    $users[$username] = $password;
    file_put_contents('users.json', json_encode($users));

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <h1>Register</h1>
    <div class="form">
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
        <a class="BTN" href="login.php">have email? click here to Login</a>
    </div>
    <br>
</body>

</html>