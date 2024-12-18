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




$quiz = new quiz();



if(isset($_POST['delete'])){

  $quizId = $_POST['quizId'];
  $deleteQuiz = $quiz->deleteQuiz($quizId , "delete" , null);

}


?>




<!DOCTYPE html>
<html lang="en" data-theme="light">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.3/dist/full.css" rel="stylesheet" type="text/css" />

      <style>
        @media (max-width: 768px) {
         .table-wrapper {
           overflow-x: auto;
         }
       }
      </style>
  </head>
  <body class="bg-whitepy-8">

  <?php include "header.php"; ?>
    <div class="flex flex-col gap-6">
      <div class="p-5 bg-white rounded-2xl">
        <div class="relative flex flex-col gap-5">
          <form action="" method="post">
          <label for="searchLesson" class="font-semibold text-black">
            Enter a Course Id
          </label>
          <input
            type="number" min="1" step="1" placeholder="Enter Course Id"
            class="w-full rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
            aria-label="Sizing example input"
            aria-describedby="inputGroup-sizing-lg" name="course_id" />
                    </form>
        </div>
      </div>

      
      <div
        class="mx-auto shadow rounded-lg bg-white pb-5 p-5 text-black h-full w-screen">
        <h1 class="text-2xl font-semibold mb-4">Quiz Questions</h1>
        <form action="" method="post">
        <input type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold  btn btn-primary mt-3 w-1/5" name="all_quiz" value="Show All Quizzes">
      </form>

        <!-- Question 1 -->
        <div
        id="table"
        class="flex justify-center items-center rounded-md overflow-x-auto">
        <div class="container p-2 mx-auto sm:px-4 rounded-2xl">
          <div class="overflow-x-auto">
            <table class="w-full p-6 text-xs text-left whitespace-nowrap">
              <thead>
                <tr class="bg-gray-300">
                  <th class="p-3 text-black font-semibold text-base">
                    Id
                  </th>
                  <th class="p-3 text-black font-semibold text-base">
                    Course Id
                  </th>
                  <th class="p-3 text-black font-semibold text-base">
                    Question
                  </th>
                  <th class="p-3 text-black font-semibold text-base">
                    Option A
                  </th>
                  <th class="p-3 text-black font-semibold text-base">
                    Option B
                  </th>
                  <th class="p-3 text-black font-semibold text-base">
                    Option C
                  </th>
                  <th class="p-3 text-black font-semibold text-base">
                    Option D
                  </th>
                  <th class="p-3 text-black font-semibold text-base">
                    Answer
                  </th>
                  <th class="p-3 text-black font-semibold text-base">Action</th>
                </tr>
              </thead>
              
              <tbody class="border-b bg-blue-900">
              <?php


              if(isset($_POST['course_id'])){
                
                $courseId = $_POST['course_id'];
                $quiz_info = $quiz->getQuiz($courseId , null , "getQuizByCourse");
                  if($quiz_info == true){

                    foreach ($quiz_info as $quiz_data) {
                      $quiz_id = $quiz_data['id'];
                      $course_id = $quiz_data['course_id'];
                      $question = $quiz_data['question'];
                      $option_a = $quiz_data['first_ans'];
                      $option_b = $quiz_data['second_ans'];
                      $option_c = $quiz_data['third_ans'];
                      $option_d = $quiz_data['fourth_ans'];
                      $answer = $quiz_data['orginal_ans'];
  
                      echo "  <tr>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$quiz_id."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$course_id."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$question."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$option_a."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$option_b."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$option_c."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$option_d."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$answer ."                     
                        </p>
                      </td>
    
                      <td class='px-3 py-2 text-white'>
                    <form action='AdminQuiz.php' method='post'>
                          <input type='hidden' name='quizId' value=".$quiz_id.">
                          <input type='hidden' name='courseId' value=".$course_id.">
                          <input type='hidden' name='question' value=".$question.">
                          <input type='hidden' name='option_a' value=".$option_a.">
                          <input type='hidden' name='option_b' value=".$option_b.">
                          <input type='hidden' name='option_c' value=".$option_c.">
                          <input type='hidden' name='option_d' value=".$option_d.">
                          <input type='hidden' name='answer' value=".$answer.">
                          <div class='flex flex-row gap-4'>
                            <button
                              type='button'
                              data-te-ripple-init
                              data-te-ripple-color='light'
                              class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
                              style='background-color: #1da1f2'>
                              <a href='editQuiz.php?quiz_id=".$quiz_id."'>Edit</a>
                            </button>
    
                            <input type='submit' onclick='return checkDelete(" . $quiz_id . ")' class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
                            style='background-color: red' value='Delete' name='delete'>
                          </div>
                        </form>
                      </td>
                    </tr> "; 
                  }}
                  else{
                    echo "<h1 class='text-red-500 text-4xl text-center font-semibold'>No Data Found !</h1>";
                  }
                
              }
              else{
                if(isset($_POST['all_quiz'])){
                  if($quiz_info = $quiz->getQuiz(null , null , "getQuiz")){

                    foreach ($quiz_info as $quiz_data) {
                      $quiz_id = $quiz_data['id'];
                      $course_id = $quiz_data['course_id'];
                      $question = $quiz_data['question'];
                      $option_a = $quiz_data['first_ans'];
                      $option_b = $quiz_data['second_ans'];
                      $option_c = $quiz_data['third_ans'];
                      $option_d = $quiz_data['fourth_ans'];
                      $answer = $quiz_data['orginal_ans'];
  
                      echo "  <tr>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$quiz_id."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$course_id."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$question."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$option_a."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$option_b."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$option_c."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$option_d."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$answer ."                     
                        </p>
                      </td>
    
                      <td class='px-3 py-2 text-white'>
                    <form action='AdminQuiz.php' method='post'>
                          <input type='hidden' name='quizId' value=".$quiz_id.">
                          <input type='hidden' name='courseId' value=".$course_id.">
                          <input type='hidden' name='question' value=".$question.">
                          <input type='hidden' name='option_a' value=".$option_a.">
                          <input type='hidden' name='option_b' value=".$option_b.">
                          <input type='hidden' name='option_c' value=".$option_c.">
                          <input type='hidden' name='option_d' value=".$option_d.">
                          <input type='hidden' name='answer' value=".$answer.">
                          <div class='flex flex-row gap-4'>
                            <button
                              type='button'
                              data-te-ripple-init
                              data-te-ripple-color='light'
                              class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
                              style='background-color: #1da1f2'>
                              <a href='editQuiz.php?quiz_id=".$quiz_id."'>Edit</a>
                            </button>
    
                            <input type='submit' onclick='return checkDelete(" . $quiz_id . ")' class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
                            style='background-color: red' value='Delete' name='delete'>
                          </div>
                        </form>
                      </td>
                    </tr> "; 
                  }}
                  else{
                    echo "<h1 class='text-red-500 text-4xl text-center font-semibold'>No Data Found !</h1>";
                  }

              }
              else{
                if($quiz_info = $quiz->getQuiz(null , null , "getQuiz")){
                  foreach ($quiz_info as $quiz_data) {
                    $quiz_id = $quiz_data['id'];
                    $course_id = $quiz_data['course_id'];
                    $question = $quiz_data['question'];
                    $option_a = $quiz_data['first_ans'];
                    $option_b = $quiz_data['second_ans'];
                    $option_c = $quiz_data['third_ans'];
                    $option_d = $quiz_data['fourth_ans'];
                    $answer = $quiz_data['orginal_ans'];

                    echo "  <tr>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$quiz_id."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$course_id."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$question."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$option_a."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$option_b."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$option_c."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$option_d."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$answer ."                     
                      </p>
                    </td>
  
                    <td class='px-3 py-2 text-white'>
                  <form action='AdminQuiz.php' method='post'>
                        <input type='hidden' name='quizId' value=".$quiz_id.">
                        <input type='hidden' name='courseId' value=".$course_id.">
                        <input type='hidden' name='question' value=".$question.">
                        <input type='hidden' name='option_a' value=".$option_a.">
                        <input type='hidden' name='option_b' value=".$option_b.">
                        <input type='hidden' name='option_c' value=".$option_c.">
                        <input type='hidden' name='option_d' value=".$option_d.">
                        <input type='hidden' name='answer' value=".$answer.">
                        <div class='flex flex-row gap-4'>
                          <button
                            type='button'
                            data-te-ripple-init
                            data-te-ripple-color='light'
                            class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
                            style='background-color: #1da1f2' onclick='window.location.href='editQuiz.php?quiz_id=".$quiz_id."''>
                            <a href='editQuiz.php?quiz_id=".$quiz_id."'>Edit</a>
                          </button>
  
                          <input type='submit' onclick='return checkDelete(" . $quiz_id . ")' class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
                            style='background-color: red' value='Delete' name='delete'>
                        </div>
                      </form>
                    </td>
                  </tr> "; 
                }}
                else{
                  echo "<h1 class='text-red-500 text-4xl text-center font-semibold'>No Data Found !</h1>";
                }
               

                }
              }
              

              ?>
                
                <!-- Add more rows as needed -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

        

        <!-- Add more questions here -->

        <div class="mt-5">
          <button
            id="open-add-quiz-modal"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md flex flex-row gap-3"
            onclick="window.location.href='addQuiz.php'">
            Add more Quizzes
          </button>
        </div>
      </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
    function checkDelete(quiz_id) {
        if (confirm("Are you sure about that?")) {
            // If the user confirms, proceed with deleting the course.
            window.location.href = 'AdminQuiz.php';
            return true;
        } else {
            // If the user cancels, do not delete the course.
            return false;
        }
    }
    </script>
  </body>
</html>
