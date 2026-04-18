<?php
session_start();

if (isset($_POST['username'])) {
    // Declare login variables
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Checks for user in a flat file, and verifys if valid
    $users = file_exists('users.txt') ? file('users.txt', FILE_IGNORE_NEW_LINES) : [];
    foreach ($users as $user) {
        $parts = explode(',', $user);
        if (($parts[0] === $username) && password_verify($password, $parts[1])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header('Location: lobby.php');
            exit();
        }
    }
    $error = "Invalid username or password";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <!-- Check if Invalid Info has been inputted -->
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Input Field -->
    <form method="post">
        Username: <input type='text' name='username'><br>
        Password: <input type='text' name='password'><br>
        <input type='submit' value='Login'>
    </form>
    <a href="registration.php">Register Here!</a>
</body>
</html>