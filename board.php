<!-- Session Variables -->
 <?php
 session_start();
$players = $_SESSION['players'];
$num = $_SESSION['num'];
$scores = $_SESSION['scores'];
$current_player = $_SESSION['current_player'];
$claimed = $_SESSION['claimed'];
var_dump($claimed);
include 'question.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="board">
        <?php
        foreach($categories as $category => $questions) {
            echo "<div class='category_column'>";
            echo "<div class='header'>$category</div>";
            foreach($questions as $points => $question) {
                if(in_array($category . "_" . $points, $_SESSION['claimed'])) {
                    echo "<div class='question_block'>claimed</div>";
                } else {
                    echo "<div class='question_block'><a href='board.php?category=$category&points=$points'>$points</a></div>";
                }
            }
            echo "</div>";
        }
        ?>
    </div><br>
        <?php if(isset($_GET['category'])): ?>
            <div class="question_box">
                <?php
                $category = $_GET['category'];
                $points = $_GET['points'];
                echo $selected_question = $categories[$category][$points] . "<br>";
                ?>
                <form method="post">
                    Type Answer: <input type="text" name="ans">
                    <input type="hidden" name="category" value="<?php echo $category; ?>">
                    <input type="hidden" name="points" value="<?php echo $points; ?>">
                    <input type="submit">
                </form>
                <?php
                if(isset($_POST['ans'])) {
                    $category = $_POST['category'];
                    $points = $_POST['points'];
                    $ans = $_POST['ans'];
                   if (strtolower($ans) == strtolower($answers[$category][$points])) {
                        echo "Correct";
                        $scores[$current_player] += $points;
                        $claimed[] = $category . "_" . $points;
                        $current_player = ($current_player + 1) % $num;
                        $_SESSION['scores'] = $scores;
                        $_SESSION['current_player'] = $current_player;
                        $_SESSION['claimed'] = $claimed;
                        header('Location: board.php');
                        exit;
                    } else {
                        echo "Wrong";
                        $current_player = ($current_player + 1) % $num;
                        $_SESSION['scores'] = $scores;
                        $_SESSION['current_player'] = $current_player;
                        header('Location: board.php');
                        exit;
                    } 
                }
                ?>
            </div>
        <?php endif; ?>
        <?php
    $player_num = 1;
    $temp_num = 0;
    foreach($players as $player) {
        echo "Player $player_num: $player Player Score: $scores[$temp_num]<br>";
        $player_num++;
        $temp_num++;
    }
    ?>
</body>
</html>