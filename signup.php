<!-- Session Start -->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- Checks if player names are actually there -->
    <?php if(isset($_POST['player_name'])): ?>
        <?php $_SESSION['players'] = $_POST['player_name'];
        $_SESSION['scores'] = array_fill(0, $_SESSION['num'], 0);
        $_SESSION['current_player'] = 0;
        $_SESSION['claimed'] = [];
        header('Location: lobby.php');
        exit();
        ?>

    <?php elseif(isset($_POST['num_players'])):
        $_SESSION['num'] = $_POST['num_players'];
        $player_names = array(); ?>

        <!-- 2nd Form, Gets Player Names Based On Count -->
        <form method="post" action="signup.php">
            <?php for ($i = 1; $i <= $_SESSION["num"]; $i++) { ?>
                Player Name: <input type="text" name="player_name[]"><br>
            <?php } ?>
            <input type="submit">
        </form>

    <?php else: ?> 
        <!-- 1st Form, Gets Player Count -->
        <form method="post" action="signup.php">
            <select name="num_players">
                <option value="2">2 Players</option>
                <option value="3">3 Players</option>
                <option value="4">4 Players</option>
            </select>
            <button type="submit">Continue</button>
        </form>
    <?php endif ?>
</body>
</html>