<?php
// Generate random questions
/**
 * @param $lastQuestionNumber
 * @param $lastQuestionType
 * @return array
 */
function generateRandomQuestion($lastQuestionNumber, $lastQuestionType){
    // Calculate question number
    $questionData = [
        "questionNumber" => $lastQuestionNumber+1
    ];
    // Get random adders
    $adderOne = rand(1,20);
    $adderTwo = rand(1,20);
    
    // Decide if addition / multiplication or subtraction / division
    if($adderOne > $adderTwo){        
        // See what the last type was
        if($lastQuestionType == "-" || $lastQuestionType == "*"){
            // Create a division problem
            $correctAnswer = $adderOne / $adderTwo;
            $correctAnswer =  round($correctAnswer, 2);
            $questionData["leftAdder"] = $adderOne;
            $questionData["rightAdder"] = $adderTwo;
            $questionData["equationType"] = "/";
        } elseif($lastQuestionType == "-" || $lastQuestionType == "/") {
            // Create multiplication problem
            $correctAnswer = $adderOne * $adderTwo;
            $questionData["leftAdder"] = $adderOne;
            $questionData["rightAdder"] = $adderTwo;
            $questionData["equationType"] = "*";
        } else {
            // Create subtraction problem
            $correctAnswer = $adderOne - $adderTwo;
            $questionData["leftAdder"] = $adderOne;
            $questionData["rightAdder"] = $adderTwo;
            $questionData["equationType"] = "-";
        }
    }else{
        if($lastQuestionType == "+" || $lastQuestionType == "*"){
            // Create a division problem
            $correctAnswer = $adderTwo / $adderOne;
            $correctAnswer =  round($correctAnswer, 2);
            $questionData["leftAdder"] = $adderTwo;
            $questionData["rightAdder"] = $adderOne;
            $questionData["equationType"] = "/";
        } elseif($lastQuestionType == "+" || $lastQuestionType == "/") {
            // Create multiplication problem
            $correctAnswer = $adderOne * $adderTwo;
            $questionData["leftAdder"] = $adderOne;
            $questionData["rightAdder"] = $adderTwo;
            $questionData["equationType"] = "*";
        } else {
            // Create addition problem
            $correctAnswer = $adderOne + $adderTwo;
            $questionData["leftAdder"] = $adderOne;
            $questionData["rightAdder"] = $adderTwo;
            $questionData["equationType"] = "+";
        }
    }
    
    // Set / calculate answer options
    $questionData["correctAnswer"] = $correctAnswer;

    if($questionData["equationType"] == "+" || $questionData["equationType"] == "-" || $questionData["equationType"] == "*") {
        $firstIncorrectAnswer = $correctAnswer + rand(1, 10);
        $secondIncorrectAnswer = $correctAnswer - rand(1, 10);
        // Make sure never negative or the same as the firstIncorrectAnswer
        if($secondIncorrectAnswer < 0){
            $secondIncorrectAnswer = $correctAnswer + rand(1, 10);
            if($secondIncorrectAnswer == $firstIncorrectAnswer){
                $secondIncorrectAnswer++;
            }
        }
    }else{
        // Division
        $firstIncorrectAnswer = $correctAnswer + (float) rand(1, 2) + .5;
        $secondIncorrectAnswer = $correctAnswer - (float) rand(1, 2) + .5;
        // Make sure never negative or the same as the firstIncorrectAnswer
        if($secondIncorrectAnswer < 0){
            $secondIncorrectAnswer = $correctAnswer + (float) rand(1, 10);
            if($secondIncorrectAnswer == $firstIncorrectAnswer){
                $secondIncorrectAnswer++;
            }
        }
    }
    
    $questionData["firstIncorrectAnswer"] = $firstIncorrectAnswer;
    $questionData["secondIncorrectAnswer"] = $secondIncorrectAnswer;
    
    return $questionData;
}