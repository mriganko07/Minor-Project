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
include_once "../classes/orders.php";
include_once "../classes/certificate.php";




$user = new user();
$order = new Order();
$certificate = new certificate();



if(isset($_POST['delete'])){

  $userId = $_POST['userId'];
  $user_email = $_POST['user_email'];
  $deleteUser = $user->deleteUser($userId);
  $deleteOrder = $order->deleteOrders(null , $user_email , "deleteByUser");
  $deleteCertificate = $certificate->deleteCertificate(null, null, $user_id, 'deleteByUser');
  header("location:ViewStudents.php");

}
?>




<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Students</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />

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
                        Enter User Id
                    </label>
                    <input type="number"
                        class="w-full rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="user_id" />
                </form>
            </div>
        </div>


        <div class="mx-auto shadow rounded-lg bg-white pb-5 p-5 text-black h-full w-screen">
            <h1 class="text-2xl font-semibold mb-4">User Information</h1>
            <form action="" method="post">
                <input type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold  btn btn-primary mt-3 w-1/5"
                    name="all_user" value="Show All Users">
            </form>

            <!-- Question 1 -->
            <div id="table" class="flex justify-center items-center rounded-md overflow-x-auto">
                <div class="container p-2 mx-auto sm:px-4 rounded-2xl">
                    <div class="overflow-x-auto">
                        <table class="w-full p-6 text-xs text-left whitespace-nowrap">
                            <thead>
                                <tr class="bg-gray-300">
                                    <th class="p-3 text-black font-semibold text-base">
                                        Id
                                    </th>
                                    <th class="p-3 text-black font-semibold text-base">
                                        User Name
                                    </th>
                                    <th class="p-3 text-black font-semibold text-base">
                                        User Email
                                    </th>
                                    <th class="p-3 text-black font-semibold text-base">
                                        User Phone Number
                                    </th>
                                    <th class="p-3 text-black font-semibold text-base">
                                        User Occupation
                                    </th>
                                    <th class="p-3 text-black font-semibold text-base">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="border-b bg-blue-900">
                                <?php


              if(isset($_POST['user_id'])){
                
                $userId = $_POST['user_id'];
                $user_info = $user->getUser($userId , "getUserById");
                  if($user_info == true){

                    foreach ($user_info as $user_data) {
                      $user_id = $user_data['user_id'];
                      $user_name = $user_data['user_name'];
                      $user_email = $user_data['user_email'];
                      $user_ph = $user_data['user_ph'];
                      $user_occupation = $user_data['user_occupation'];
  
                      echo "  <tr>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_id."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_name."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_email."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_ph."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_occupation."
                        </p>
                      </td>
                          
                      <td class='px-3 py-2 text-white'>
                    <form action='ViewStudents.php' method='post'>
                          <input type='hidden' name='userId' value=".$user_id.">
                          <input type='hidden' name='user_name' value=".$user_name.">
                          <input type='hidden' name='user_email' value=".$user_email.">
                          <input type='hidden' name='user_ph' value=".$user_ph.">
                          <input type='hidden' name='user_occupation' value=".$user_occupation.">
                          <div class='flex flex-row gap-4'>
                            <button
                              type='button'
                              data-te-ripple-init
                              data-te-ripple-color='light'
                              class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
                              style='background-color: #1da1f2'>
                              <a href='editUser.php?user_id=".$user_id."'>Edit</a>
                            </button>
    
                            <input type='submit' onclick='return checkDelete(" . $user_id . ")' class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
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
                if(isset($_POST['all_user'])){
                  if($user_info = $user->getUser(null , "getUser")){

                    foreach ($user_info as $user_data) {
                      $user_id = $user_data['user_id'];
                      $user_name = $user_data['user_name'];
                      $user_email = $user_data['user_email'];
                      $user_ph = $user_data['user_ph'];
                      $user_occupation = $user_data['user_occupation'];
  
                      echo "  <tr>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_id."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_name."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_email."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_ph."
                        </p>
                      </td>
                      <td class='px-3 py-2 text-white text-base'>
                        <p>
                        ".$user_occupation."
                        </p>
                      </td>
                          
                      <td class='px-3 py-2 text-white'>
                    <form action='ViewStudents.php' method='post'>
                          <input type='hidden' name='userId' value=".$user_id.">
                          <input type='hidden' name='user_name' value=".$user_name.">
                          <input type='hidden' name='user_email' value=".$user_email.">
                          <input type='hidden' name='user_ph' value=".$user_ph.">
                          <input type='hidden' name='user_occupation' value=".$user_occupation.">
                          <div class='flex flex-row gap-4'>
                            <button
                              type='button'
                              data-te-ripple-init
                              data-te-ripple-color='light'
                              class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
                              style='background-color: #1da1f2'>
                              <a href='editUser.php?user_id=".$user_id."'>Edit</a>
                            </button>
    
                            <input type='submit' onclick='return checkDelete(" . $user_id . ")' class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
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
                if($user_info = $user->getUser(null , "getUser")){
                  foreach ($user_info as $user_data) {
                    $user_id = $user_data['user_id'];
                    $user_name = $user_data['user_name'];
                    $user_email = $user_data['user_email'];
                    $user_ph = $user_data['user_ph'];
                    $user_occupation = $user_data['user_occupation'];

                    echo "  <tr>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$user_id."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$user_name."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$user_email."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$user_ph."
                      </p>
                    </td>
                    <td class='px-3 py-2 text-white text-base'>
                      <p>
                      ".$user_occupation."
                      </p>
                    </td>
                        
                    <td class='px-3 py-2 text-white'>
                  <form action='ViewStudents.php' method='post'>
                        <input type='hidden' name='userId' value=".$user_id.">
                        <input type='hidden' name='user_name' value=".$user_name.">
                        <input type='hidden' name='user_email' value=".$user_email.">
                        <input type='hidden' name='user_ph' value=".$user_ph.">
                        <input type='hidden' name='user_occupation' value=".$user_occupation.">
                        <div class='flex flex-row gap-4'>
                          <button
                            type='button'
                            data-te-ripple-init
                            data-te-ripple-color='light'
                            class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
                            style='background-color: #1da1f2'>
                            <a href='editUser.php?user_id=".$user_id."'>Edit</a>
                          </button>
  
                          <input type='submit' onclick='return checkDelete(" . $user_id . ")' class='mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg'
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <button id="open-add-quiz-modal"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md flex flex-row gap-3">
                    <a href="addUser.php"> Add more User </a>
                </button>
            </div>
        </div>
    </div>
    <div id="modal"></div>

    <script src="ModalScript.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
    function checkDelete(user_id) {
        if (confirm("Are you sure about that?")) {
            // If the user confirms, proceed with deleting the course.
            window.location.href = 'ViewStudents.php';
            return true;
        } else {
            // If the user cancels, do not delete the course.
            return false;
        }
    }
    </script>
</body>

</html>