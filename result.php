<?php
include "check_login.php";
include_once 'classes/certificate.php';
include_once 'classes/courses.php';



$certificate = new certificate();
$course = new Course();


$encryptedCourseId = urldecode($_GET['course_id']);
$course_id = base64_decode($encryptedCourseId);

$encryptedCorrect = urldecode($_GET['correct']);
$correct = base64_decode($encryptedCorrect);

$encryptedWrong = urldecode($_GET['wrong']);
$wrong = base64_decode($encryptedWrong);

$encryptedTotalQuestion = urldecode($_GET['totalQuestion']);
$totalQuestion = base64_decode($encryptedTotalQuestion);

$encryptedAttempted = urldecode($_GET['attempted']);
$attempted = base64_decode($encryptedAttempted);

$encryptedNotAttempted = urldecode($_GET['notAttempted']);
$notAttempted = base64_decode($encryptedNotAttempted);

$encryptedPercentage = urldecode($_GET['percentage']);
$percentage = base64_decode($encryptedPercentage);


/*
$correct = $_GET['correct'];
$wrong = $_GET['wrong'];
$totalQuestion = $_GET['totalQuestion'];
$attempted = $_GET['attempted'];
$notAttempted = $_GET['notAttempted'];
$percentage = $_GET['percentage'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$course_id = $_GET['course_id'];
*/

$course_info = $course->getCourseById($course_id);

$course_data = $course_info->fetch_assoc();
        

$certificate_info = $certificate->getCertificateInfo($user_id , $course_id);



if(isset($_POST['try_again'])){
  header('location: course_quiz.php?course_id='.$_GET['course_id']);
  
  unset($_SESSION['correct']);
  unset($_SESSION['wrong']);
  unset($_SESSION['totalQuestion']);
  unset($_SESSION['attempted']);
  unset($_SESSION['notAttempted']);
  unset($_SESSION['percentage']);

}

if(isset($_POST['back'])){
  header('location: myCourses.php');
  
  unset($_SESSION['correct']);
  unset($_SESSION['wrong']);
  unset($_SESSION['totalQuestion']);
  unset($_SESSION['attempted']);
  unset($_SESSION['notAttempted']);
  unset($_SESSION['percentage']);
  
}


if(isset($_POST['download'])){

  if($certificate->generateCertificate($user_name , $course_data['c_name'] , $certificate_info['create_time'] , $user_email)){
    header("Content-Type: application/octet-stream");
  
    $file = "certificate/".str_replace(' ', '_', $user_email).".pdf";
    $user_file = str_replace(' ', '_', $user_name).".pdf";
    header("Content-Disposition: attachment; filename=" . urlencode($user_file));   
    header("Content-Type: application/download"); 
    header("Content-Description: File Transfer");            
    header("Content-Length: " . filesize($file));
  
    flush();
  
    $fp = fopen($file, "r");
    while (!feof($fp)) {
    echo fread($fp, 65536);
    flush();
    }
    fclose($fp);
} 
  
 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
        <style>
            body{
                background: rgb(207,238,242);
                background: linear-gradient(0deg, rgb(196, 226, 244) 40%, rgba(165,203,248,0.10136554621848737) 60%);
                height: 100vh;
                font-family: 'Poppins', sans-serif;
            }
            .result{
                background-color: transparent;
                background-color: rgb(246, 251, 255);
            }
        </style>
</head>
<body>
    <secction class="container-fluid d-flex flex-column justify-content-center align-items-center py-3">
        <div class="result d-flex flex-column justify-content-center align-items-center w-50 shadow border rounded-4 mt-5 py-4">
            <h2 class="pb-3">Quiz Result</h2>
            <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th scope="row">User Name</th>

                    <td><?= $user_name; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Total Questions</th>

                    <td><?= $totalQuestion; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Attempted Questions</th>

                    <td><?= $attempted; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Not Attempted Questions</th>

                    <td><?= $notAttempted; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Correct</th>

                    <td><?= $correct; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Wrong</th>

                    <td><?= $wrong; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Percentage</th>

                    <td><?= $percentage.'%'; ?></td>
                  </tr>
                </tbody>
              </table>
              <?php
              
                    if($percentage >= 70){
                      if($certificate->addCertificate($user_id , $user_name , $course_id , $course_data['c_name'])){;
                      
                        echo "<h4 class='pb-3'>Congratulation, You have earned the Certificate .!!!</h4>" ;

              ?>
              
              <form method="post">
              <div class="button d-flex flex-row">

              <?php

                echo "<input type='submit' class='btn btn-md btn-success rounded mx-2' name='download' value='Download Certificate'>";
            }}
            else{
                echo "<h4 class='pb-3'>Better Luck Next Time .!!!</h4>" ;
                echo "<form action='#' method='post'>";
                echo "<div class='button d-flex flex-row'>";
                echo "<input type='submit' class='btn btn-md btn-danger rounded mx-2' name='try_again' value='Try again'>";
            }
            ?>
                <input type="submit" class="btn btn-md btn-primary rounded mx-2" name="back" value="Back to Home">
              </div>
              </form>
        </div>
    </secction>
</body>
</html>
