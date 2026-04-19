<?php
session_start();
$players = $_SESSION['players'];
$scores = $_SESSION['scores'];

// Sorts the scores for use highest to lowest
arsort($scores);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1 class="leaderboard_title">Final Results</h1>
    <div class="podium">
        <?php
        // Creates the podiums and assigns the rankings 
        $position = 1;
        foreach ($scores as $index => $score) {
            $height = max(80, $score / 4);
            echo "<div class='podium_column'>";
            echo "<p class='podium_position'>#$position</p>";
            echo "<p class='podium_name'>" . $players[$index] . "</p>";
            echo "<p class='podium_score'>$score pts</p>";
            echo "<div class='podium_bar' style='height: {$height}px;'>$position</div>";
            echo "</div>";
            $position++;
        }
        ?>
    </div>
    <div class="podium_base"></div>
    <a href="login.php" class="play_again">Play Again</a>
</body>
</html>