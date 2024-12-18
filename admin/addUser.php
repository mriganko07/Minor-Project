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

include_once "../classes/user.php";


$user = new user();


?>


<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>

    <link
    href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css"
    rel="stylesheet"
    type="text/css" />
</head>
<body class="">
    <div class="rounded-2xl shadow-md mx-auto w-9/12 mt-10 py-5 border">

    <?php
    if(isset($_POST['add_user'])){

      $user_name = $_POST['user_name'];
      $user_email = $_POST['user_email'];
      $user_ph = $_POST['user_ph'];
      $user_pass = $_POST['user_pass'];
      $user_cpass = $_POST['user_cpass'];
      $user_occupation = $_POST['user_occupation'];

      if($user->addUser($user_name , $user_email , $user_pass  , $user_cpass , strval($user_ph) , $user_occupation)){
        header("location:ViewStudents.php");
      }
      else{
              echo "<div class='alert alert-error'>
      <span>Error! Task failed successfully.</span>
      </div>";
      }
    }
      

    ?>

    <form action="addUser.php" method="post">
    <div class="relative flex flex-col  gap-3 p-5">
        

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter User Name
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="user_name" required/>
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter User Email
            </label>
            <input
              type="email"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="user_email" required/>
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter User Phone Number
            </label>
            <input
              type="number"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="user_ph" required/>
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter User Password
            </label>
            <input
              type="password"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="user_pass" required/>
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Confirm Password
            </label>
            <input
              type="password"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="user_cpass" required/>
        </div>

        <div class="">
            <label for="searchLesson" class="font-semibold text-black">
              Enter User Occupation
            </label>
            <input
              type="text"
              class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" name="user_occupation" required/>
        </div>

        
          
        
      </div>
      <div class="flex flex-row justify-between">
      <input type="submit" class="mx-5 bg-blue-500 hover:bg-blue-600 text-white font-semibold  btn btn-primary mt-3 w-1/5" name="add_user" value="Add User">
      <div class="flex flex-row gap-3">
      <button
            id="open-add-quiz-modal"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md btn">

            <a href="ViewStudents.php">Back</a>
          </button> 
          <input type="reset" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md  btn bg-red-600 hover:bg-red-700 mx-2" value="Cancel">
     

  </div>
  </div>   
    
    </form>
    </div>



    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>