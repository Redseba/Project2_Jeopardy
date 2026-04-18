<?php
session_start();

// Declares variables for registration
if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    // Sets up error incase password and the confirm don't match
    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        // Formats and checks if inputted informatiomn already exists
        $users = file_exists('users.txt') ? file('users.txt', FILE_IGNORE_NEW_LINES) : [];
        foreach ($users as $user) {
            $parts = explode(',', $user);
            if ($parts[0] === $username) {
                $error = "Username already exists!!!";
                break;
            }
        }
        // If no error is declared, then the inputted info is formatted and appened onto users.txt to be stored and user is taken back to login
        if (!isset($error)) {
            file_put_contents('users.txt', $username . ',' . password_hash($password, PASSWORD_DEFAULT) . PHP_EOL, FILE_APPEND);
            header('Location: login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h2>Registration</h2>

    <!-- Checks if passwords match -->
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Input Field -->
    <form method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        Confirm Password: <input type="password" name="confirm"><br>
        <input type="submit" value="Register">
    </form>
    <a href="login.php">Already have an account? Login</a>
</body>
</html>