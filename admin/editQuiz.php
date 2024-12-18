<?php
// Start the session
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] != true) {
  header("location: adminLogin.php");
  exit;
}
?>
<?php

include_once "../classes/quiz.php";
include_once "../classes/courses.php";


$quiz = new quiz();
$course = new course();

$quiz_id = $_GET['quiz_id'];


?>


<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>

    <link
    href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css"
    rel="stylesheet"
    type="text/css" />
</head>
<body>
    <div class="rounded-2xl shadow-md mx-auto w-9/12 mt-10 py-5 border">

    <?php
    if(isset($_POST['edit_quiz'])){

      $quiz_id = $_POST['quiz_id'];
      $course_id = $_POST['course_id'];
      $question = $_POST['question'];
      $option_a = $_POST['option_a'];
      $option_b = $_POST['option_b'];
      $option_c = $_POST['option_c'];
      $option_d = $_POST['option_d'];
      $answer = $_POST['answer'];

      if($quiz->editQuiz($quiz_id , $course_id , $question , $option_a , $option_b , $option_c , $option_d , $answer)){
        header("location:AdminQuiz.php");
      }
      else{
              echo "<div class='alert alert-error'>
      <span>Error! Task failed successfully.</span>
      </div>";
      }

    }

    ?>
<?php
if($quiz_info = $quiz->getQuiz(null , $quiz_id , "getQuizById")){
                  foreach ($quiz_info as $quiz_data) {
                    $course_id = $quiz_data['course_id'];
                    $question = $quiz_data['question'];
                    $option_a = $quiz_data['first_ans'];
                    $option_b = $quiz_data['second_ans'];
                    $option_c = $quiz_data['third_ans'];
                    $option_d = $quiz_data['fourth_ans'];
                    $answer = $quiz_data['orginal_ans'];
?>

    <form action="#" method="post">
    <div class="relative flex flex-col  gap-3 p-5">
        
        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Quiz Id
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="quiz_id" readonly value="<?= $quiz_id; ?>" />
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Course Id
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="course_id" readonly value="<?= $course_id; ?>" />
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter Question
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="question" value="<?= $question; ?>" />
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter Option A
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="option_a" value="<?= $option_a; ?>" />
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter Option B
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="option_b" value="<?= $option_b; ?>" />
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter Option C
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="option_c" value="<?= $option_c; ?>" />
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter Option D
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="option_d" value="<?= $option_d; ?>" />
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter Answer
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="answer" value="<?= $answer; ?>" />
        </div>

        
          
        
      </div>
      <div class="flex flex-row justify-between">
      <input type="submit" class="mx-5 bg-blue-500 hover:bg-blue-600 text-white font-semibold  btn btn-primary mt-3 w-1/5" name="edit_quiz" value="Edit Quiz">
      <div class="flex flex-row gap-3">
      <button
            id="open-add-quiz-modal"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md btn">

            <a href="AdminQuiz.php">Back</a>
          </button> 
          <input type="reset" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md  btn bg-red-600 hover:bg-red-700 mx-2" value="Cancel">
     
                  </div>
  </div>    
    </form>

        <?php
                  }
                }
                  ?>
    </div>



    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>