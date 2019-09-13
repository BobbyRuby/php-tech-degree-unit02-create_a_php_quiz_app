<?php 
include('inc/quiz.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition / Subtraction / Multiplication / Division</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/toast.js"></script>
</head>
<body>
    <div class="container">        
            <?php
            // Ensure were are under the max question count
            if($lastQuestionNumber < $maxQuestions) {
                showQuestion($lastQuestionNumber);
                echo '</form>';
            }
            // If not show the list of questions with answers given, if they were correct or incorrect and the final score
            else if($lastQuestionNumber == $maxQuestions){
                showFinalResultsAndScore($lastQuestionNumber, $maxQuestions);
            }
            ?>

        </div>
    </div>
</body>
</html>