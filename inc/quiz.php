<?php
session_start();
// Include questions
include('generate_questions.php');
$maxQuestions = 10; // set max number of questions
// Get the last question and answer
$lastQuestionNumber = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$lastAnswer = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);


// Keep track of which answeres by setting session variable
if(!empty($_POST)) {
    if ($_POST['id']) {
        $_SESSION['answer'][$lastQuestionNumber] = $lastAnswer;
    }
}

/**
 * This functions outputs the html for our selected question and stores the current question inside the session variable 'question' array
 * @param $lastQuestionNumber
 */
function showQuestion($lastQuestionNumber){
    $lastQuestionType = ""; // forces first type to always + or -
    // Get the last questions type
    if(isset($_SESSION['question'][$lastQuestionNumber]['equationType'])) {
        $lastQuestionType = $_SESSION['question'][$lastQuestionNumber]['equationType'];
    }
    // Generate question
    $questionData = generateRandomQuestion($lastQuestionNumber, $lastQuestionType);
    // Store question data in session variable for use later and to create an array which can be counted to test against maxQuestions variable in index.php
    $_SESSION['question'][$questionData['questionNumber']] = $questionData;
    
    $html =  "<div id='quiz-box'><!-- ends in index.php -->
              <p class='breadcrumbs'>Question {$questionData['questionNumber']} of 10</p>
             <p class='quiz'>What is {$questionData['leftAdder']} {$questionData['equationType']} {$questionData['rightAdder']}?</p>
             <form action='index.php' method='post'>
            <input type='hidden' id='correct' value='{$questionData['correctAnswer']}' />
            <input type='hidden' name='id' value='{$questionData['questionNumber']}' />";
    echo $html;
    showAnswers($questionData);
}

/**
 * Show answers
 * @param $questionData
 */
function showAnswers($questionData){
    $answers[] = "<input type='submit' class='btn' name='answer' value='{$questionData['correctAnswer']}' />";
    $answers[] = "<input type='submit' class='btn' name='answer' value='{$questionData['firstIncorrectAnswer']}' />";
    $answers[] = "<input type='submit' class='btn' name='answer' value='{$questionData['secondIncorrectAnswer']}' />";
    shuffle($answers);
    echo implode(" ", $answers);
}

/**
 * Calculates and shows the final results and score page
 * @param $lastQuestionNumber
 * @param $maxQuestions
 */
function showFinalResultsAndScore($lastQuestionNumber, $maxQuestions){
    $finalScore = 0;
    $html = "<div id='quiz-box' style='top: 0;'><!-- ends in index.php -->
                <h1>Your Score Card</h1>
                <div id='final_results'>";
    for( $i=1; $i<=$lastQuestionNumber; $i++ ){
        $questionData = $_SESSION['question'][$i];
        $userAnswer = $_SESSION['answer'][$i];

        $html .= "<p>";
        // Check userAnswer vs correctAnswer and add to html
        if($questionData['correctAnswer'] == $userAnswer){
            $finalScore++;
            $html .= "Question #$i: <br/> Your answer of {$questionData['correctAnswer']} was correct to the question 
            {$questionData['leftAdder']} {$questionData['equationType']} {$questionData['rightAdder']}!<br/> <span class='correct'>Great Job!</span>";
        }else{
            $html .= "Question #$i: <br/> Your answer of $userAnswer was incorrect to the question 
            {$questionData['leftAdder']} {$questionData['equationType']} {$questionData['rightAdder']}!<br/>
            The correct answer was <span class='incorrect'>{$questionData['correctAnswer']}</span>!";
        }
        $html .= "</p>";
    }
    // Calculate letter grade
    $letterGrade = "F";
    if($finalScore > 9.3){
        $letterGrade = "A";
    }
    elseif($finalScore > 8.2){
        $letterGrade = "B";
    }
    elseif($finalScore > 7){
        $letterGrade = "C";
    }
    elseif($finalScore > 6){
        $letterGrade = "D";
    }


    // Multiple by 10 for a percentage value
    $finalScore = $finalScore*$maxQuestions;
    $html .= "<h2>Your final score is $finalScore% ($letterGrade)</h2>";
    $html .= "</div>";
    /* @todo change - NOTE that this is the path I must use on my localhost - I hope it is ok for submission */
    $html .= "<a href='/php-tech-degree-unit02-create_a_php_quiz_app/index.php' id='reset_btn' class='btn'>Take Another Quiz</a>";

    // Display, destroy session
    echo $html;
    session_destroy();
}

























// Shuffle answer buttons


// Toast correct and incorrect answers

// If all questions have been asked, give option to show score

// else give option to move to next question


// Show score