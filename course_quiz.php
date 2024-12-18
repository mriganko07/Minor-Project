<?php
include "check_login.php";
include 'classes/quiz.php';


 $quiz = new quiz();
 
$encryptedCourseId = urldecode($_GET['course_id']);
$course_id = base64_decode($encryptedCourseId);

if (isset($_POST['submit'])) {
    $results = $quiz->checkQuiz($course_id, $_POST['question']);


    $_SESSION['correct'] = $results['correct'];
    $_SESSION['wrong'] = $results['wrong'];
    $_SESSION['totalQuestion'] = $results['totalQuestion'];
    $_SESSION['attempted'] = $results['attempted'];
    $_SESSION['notAttempted'] = $results['notAttempted'];
    $_SESSION['percentage'] = $results['percentage'];

    $encryptedCourseId = base64_encode($course_id);
    $encryptedCorrect = base64_encode($_SESSION['correct']);
    $encryptedWrong = base64_encode($_SESSION['wrong']);
    $encryptedTotalQuestion = base64_encode($_SESSION['totalQuestion']);
    $encryptedAttempted = base64_encode($_SESSION['attempted']);
    $encryptedNotAttempted = base64_encode($_SESSION['notAttempted']);
    $encryptedPercentage = base64_encode($_SESSION['percentage']);


    header('Location: result.php?' . 
    'course_id=' . urlencode($encryptedCourseId) . '&' . 
    'correct=' . urlencode($encryptedCorrect) . '&' . 
    'wrong=' . urlencode($encryptedWrong) . '&' . 
    'totalQuestion=' . urlencode($encryptedTotalQuestion) . '&' . 
    'attempted=' . urlencode($encryptedAttempted) . '&' . 
    'notAttempted=' . urlencode($encryptedNotAttempted) . '&' . 
    'percentage=' . urlencode($encryptedPercentage) );

}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

        <style>
            body{
                background: rgb(193,238,250);
                background: linear-gradient(90deg, rgba(193,238,250,1) 5%, rgba(250,255,255,1) 50%, rgba(164,232,247,1) 88%);
                height: 100vh;
            }
            .quiz{
                background: aliceblue ;
            }
            .option{
                background: rgb(246, 251, 255);
            }
            .option:hover{
                background: rgb(111, 163, 247);
                color : #ffff;
            }
        </style>
</head>

<body>
<div class="bg-primary container-fluid ps-3 d-flex flex-row py-2 ">
    <h5 class="text-light">Welcome to CodexLearn</h5>
    <a href="watchCourse.php?course_id=<?= $_GET['course_id']; ?>" class="btn btn-danger btn-md ms-3">Back</a>
  </div>
    <?php
    $quiz_info = $quiz->getQuiz($course_id , null , "getQuizByCourse");
    ?>

    <section class="container">

        <div class="row">

            <div class="col-lg-12 col-md-12 d-flex flex-direction-column justify-content-center mt-5">
                
            <?php
            if($quiz_info == true){
                foreach ($quiz_info as $quiz_data) {
                    $question_id = $quiz_data['id'];
                    $question = $quiz_data['question'];
                    $first_ans = $quiz_data['first_ans'];
                    $second_ans = $quiz_data['second_ans'];
                    $third_ans = $quiz_data['third_ans'];
                    $fourth_ans = $quiz_data['fourth_ans'];
                    $org_ans = $quiz_data['orginal_ans'];


                echo"    <form action='#' method='post'
                    class='w-50 p-3 shadow rounded-4 quiz'>
                    
                    <div class='py-3'>
                        <h5>
                            ".$question."
                        </h5>
                    </div>
                    <div class='pb-3 pt-3 mb-3 shadow-sm rounded form-check option'>
                    <input class='form-check-input ms-1' type='radio' name='question[".$question_id."]' id='exampleRadios2'
                            value='".$first_ans."'>

                        <label class='form-check-label ms-2' for='exampleRadios2'>
                            ".$first_ans."
                        </label>

                    </div>
                    <div class='pb-3 pt-3 mb-3 shadow-sm rounded form-check option'>
                        <input class='form-check-input ms-1' type='radio' name='question[".$question_id."]' id='exampleRadios2'
                            value='".$second_ans."'>
                        <label class='form-check-label ms-2' for='exampleRadios2'>
                            ".$second_ans."
                        </label>

                    </div>
                    <div class='pb-3 pt-3 mb-3 shadow-sm rounded form-check option'>
                        <input class='form-check-input ms-1' type='radio' name='question[".$question_id."]' id='exampleRadios2'
                            value='".$third_ans."'>
                        <label class='form-check-label ms-2' for='exampleRadios2'>
                            ".$third_ans."
                        </label>

                    </div>
                    <div class='pb-3 pt-3 mb-3 shadow-sm rounded form-check option'>
                        <input class='form-check-input ms-1' type='radio' name='question[".$question_id."]' id='exampleRadios2'
                            value='".$fourth_ans."'>
                        <label class='form-check-label ms-2' for='exampleRadios2'>
                            ". $fourth_ans."
                        </label>

                    </div>
                    <div class='d-flex flex-row justify-content-center'>
                        <input type='hidden' class=' btn btn-primary btn-lg' name='org' id='add' value='".$org_ans."'>
                    </div>";
                }
                    echo "<div class='d-flex flex-row justify-content-center'>
                        <input type='submit' class=' btn btn-primary btn-lg' name='submit' id='add' value='Submit'>
                    </div>

                    

                </form>";

                }
                else{
                    echo "<h1 class='text-red-500 text-4xl text-center font-semibold'>No Quiz Available !</h1>";
                  }
                ?>
                
            </div>
        </div>
    </section>

    

</body>

</html>