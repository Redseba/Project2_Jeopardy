<!-- Retrieving Session Variables -->
<?php
session_start();
$players = $_SESSION['players'];
$num = $_SESSION['num'];
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