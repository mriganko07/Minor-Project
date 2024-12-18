<?php
// Start a new or resume an existing session
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
    <title>Login</title>

    <!-- Include the login.css stylesheet for styling -->
    <link rel="stylesheet" href="userPanelCss/login.css">

    <!-- Include Bootstrap CSS from CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body style="background-color: #CAEDFF;">
    <!-- Main container with flex properties for centering content -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <!-- Login form -->
        <form id="loginform" class="form vw-100" action="" method="POST">
            <!-- Title and message -->
            <p class="title">Login</p>
            <p class="message">Login now and get full access to our app.</p>

            <!-- Input fields for username and password -->
            <label>
                <input required="" placeholder="" type="text" name="user_name" class="input">
                <span>Email</span>
            </label>

            <label>
                <input required="" placeholder="" type="password" name="password" class="input">
                <span>Password</span>
            </label>

            <!-- Submit button for form submission -->
            <input type="submit" class="btn btn-primary btn-md" value="Login" name="login">

            <!-- Signup link -->
            <p class="signin">Don't have an account? <a href="studentSignup.php">Signup</a></p>

            <?php
            // Check if the login form is submitted
            if (isset($_POST['login'])) {
                // Retrieve form data
                $user_name = $_POST['user_name'];
                $user_pass = $_POST['password'];

                // Attempt to log in the user
                if ($user->userLogin($user_name, $user_pass)) {
                    // Redirect to the index.php page upon successful login
                    header('Location: index.php');
                } else {
                    // Display an error message if login fails
                    echo "<h5 class='text-danger'>Incorrect Username or Password</h5>";
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
