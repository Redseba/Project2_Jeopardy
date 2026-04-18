<!-- Retrieving Session Variables -->
<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

// Reads through all the registered users in users.txt
$users = file('users.txt', FILE_IGNORE_NEW_LINES);
$all_players = [];
foreach ($users as $user) {
    $parts = explode(',', $user);
    $all_players[] = $parts[0];
}

// Removes the current logged in user from the registered users pool
$logged_in = $_SESSION['username'];
$other_players = array_diff($all_players, [$logged_in]);

// Has 3 random registered users selected to play with logged in
if (count($other_players) <= 3) {
    // If there is less than 3 other registered users, all available are selected
    $selected = $other_players;
} else {
    // If there are more than 3 random users, select 3 at random from the pool
    $random_keys = array_rand($other_players, 3);
    $selected = array_intersect_key($other_players, array_flip($random_keys));
}

// Add logged in user to final players list
$players = array_merge([$logged_in], array_values($selected));
$num = count($players);

$_SESSION['players'] = $players;
$_SESSION['num'] = $num;
$_SESSION['scores'] = array_fill(0, $num, 0);
$_SESSION['current_player'] = 0;
$_SESSION['claimed'] = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    $player_num = 1;
    foreach($players as $player) {
        echo "Player $player_num: $player<br>";
        $player_num++;
    }
    ?>

    <a href="board.php">Start Game</a>

</body>
</html>