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

$user_id = $_GET['user_id'];


?>


<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="rounded-2xl shadow-md mx-auto w-9/12 mt-10 py-5 border">

        <?php
    if(isset($_POST['edit_user'])){

      $user_name = $_POST['user_name'];
      $user_email = $_POST['user_email'];
      $user_ph = $_POST['user_ph'];
      $user_occupation = $_POST['user_occupation'];

      if($user->editUser($user_id , $user_name , $user_email , strval($user_ph) , $user_occupation)){
        header("location:ViewStudents.php");
      }
      else{
              echo "<div class='alert alert-error'>
      <span>Error! Task failed successfully.</span>
      </div>";
      }

    }

    ?>
        <?php
if($user_info = $user->getUser($user_id , "getUserById")){
                  foreach ($user_info as $user_data) {
                    $user_name = $user_data['user_name'];
                    $user_email = $user_data['user_email'];
                    $user_ph = $user_data['user_ph'];
                    $user_occupation = $user_data['user_occupation'];
    
?>

        <form action="#" method="post">
            <div class="relative flex flex-col  gap-3 p-5">

                <div class="">
                    <label for="searchLesson" class="font-semibold text-black">
                        User Id
                    </label>
                    <input type="text"
                        class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="user_id"
                        readonly value="<?= $user_id; ?>" />
                </div>

                <div class="">
                    <label for="searchLesson" class="font-semibold text-black">
                        User Name
                    </label>
                    <input type="text"
                        class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required name="user_name"
                        value="<?= $user_name; ?>" />
                </div>

                <div class="">
                    <label for="searchLesson" class="font-semibold text-black">
                        User Email
                    </label>
                    <input type="email"
                        class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required name="user_email"
                        value="<?= $user_email; ?>" />
                </div>

                <div class="">
                    <label for="searchLesson" class="font-semibold text-black">
                        User Phone Number
                    </label>
                    <input type="number"
                        class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required name="user_ph"
                        value="<?= $user_ph; ?>" />
                </div>

                <div class="">
                    <label for="searchLesson" class="font-semibold text-black">
                        User Occupation
                    </label>
                    <input type="text"
                        class="w-9/12 rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required name="user_occupation"
                        value="<?= $user_occupation; ?>" />
                </div>

            </div>
            <div class="flex flex-row justify-between">
                <input type="submit"
                    class="mx-5 bg-blue-500 hover:bg-blue-600 text-white font-semibold  btn btn-primary mt-3 w-1/5"
                    name="edit_user" value="Edit User">
                <div class="flex flex-row gap-3">
                    <button id="open-add-quiz-modal"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md btn">

                        <a href="ViewStudents.php">Back</a>
                    </button>
                    <input type="reset"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md  btn bg-red-600 hover:bg-red-700 mx-2"
                        value="Cancel">

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