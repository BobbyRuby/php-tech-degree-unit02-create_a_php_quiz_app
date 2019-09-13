/**
 * Created by Bobby on 9/8/2019.
 */
// Ensure document has been loaded
$(document).ready(function () {
    // Set event on form
    $('form').submit( function(event) {
        // Get form
        var form = this;
        // Prevent default action
        // event.preventDefault();
        // Get the users answer and pass to checker function
        var userAnswer =  $("input[type=submit][clicked=true]").val();
        toastAnswerFeedback(userAnswer);
        // Wait 300 milliseconds before moving to next question
        setTimeout( function () {
            form.submit();
        }, 300);
    });
    // Set Click action on form and buttons - Modified from https://stackoverflow.com/questions/5721724/jquery-how-to-get-which-button-was-clicked-upon-form-submission
    $("form input[type=submit]").click(function() {
        $(this).attr("clicked", "true");
    });
});
/**
 * Check userAnswer vs correctAnswer and toast user
 * @param userAnswer
 */
function toastAnswerFeedback(userAnswer) {
    var correctAnswer = $('#correct').val();
    if(correctAnswer == userAnswer){
        alert("Ah SNAP " + userAnswer + " is correct! Happy face :)");
    }else{
        alert("Ah cheese " + userAnswer + " is not correct! Sad face :(");
    }
}