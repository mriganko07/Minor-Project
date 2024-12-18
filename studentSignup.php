<?php
// Start or resume an existing session
session_start();

// Include the 'user.php' class file
include "classes/user.php";

// Create a new instance of the 'user' class
$user = new user();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the title of the page -->
    <title>Signup</title>
    <!-- Include the index.css and signup.css stylesheets for styling -->
    <link rel="stylesheet" href="userPanelCss/index.css">
    <link rel="stylesheet" href="userPanelCss/signup.css">
    <!-- Include Bootstrap CSS from CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body style="background-color: #CAEDFF;">
    <!-- Main container with flex properties for centering content -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <!-- Signup form -->
        <form id="signupForm" class="form" action="" method="POST">
            <!-- Title and message -->
            <p class="title">Register </p>
            <p class="message">Signup now and get full access to our app. </p>
            <!-- Input fields for user registration information -->
            <label>
                <input required="" placeholder="" type="text" name="user_name" class="input" >
                <span>Name</span>
            </label>

            <label>
                <input required="" placeholder="" type="email" name="user_email" class="input" >
                <span>Email</span>
            </label>

            <label>
                <input required="" placeholder="" type="number" name="user_ph" class="input" >
                <span>Phone Number</span>
            </label>

            <label>
                <input required="" placeholder="" type="password" name="user_pass" class="input" >
                <span>Password</span>
            </label>
            <label>
                <input required="" placeholder="" type="password" name="user_cpass" class="input" >
                <span>Confirm password</span>
            </label>
            <label>
                <input required="" placeholder="" type="text" name="user_occupation" class="input" >
                <span>Occupation</span>
            </label>
            <!-- Submit button for form submission -->
            <input type="submit" class="submit" value="Sign Up" name="sign_up">
            <!-- Login link -->
            <p class="signin">Already have an account? <a href="studentLogin.php">Login</a> </p>

            <?php
            // Check if the signup form is submitted
            if(isset($_POST['sign_up'])){
                // Retrieve form data
                $user_name = $_POST['user_name'];
                $user_email = $_POST['user_email'];
                $user_ph = $_POST['user_ph'];
                $user_pass = $_POST['user_pass'];
                $user_cpass = $_POST['user_cpass'];
                $user_occupation = $_POST['user_occupation'];

                // Attempt to add a new user
                if($user->addUser($user_name , $user_email , $user_pass  , $user_cpass , strval($user_ph) , $user_occupation)){
                    // Redirect to the login page upon successful signup
                    header('Location: studentLogin.php');
                }
                else{
                    // Display an error message if signup fails
                    echo "<h5 class='text-danger'>Sign Up failed !!!</h5>";
                }
            }
            ?>
        </form>
    </div>
</body>

<!-- Include Bootstrap JS from CDN for additional functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

</html>
