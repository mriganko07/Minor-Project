<?php
// Include the 'check_login.php' file to perform login checks
include 'check_login.php';

// Include the 'user.php' class file
include_once "classes/user.php";

// Create a new instance of the 'user' class
$user = new user();
?>

<!-- HTML section begins -->
<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include 'stuInclude/stuHeader.php'; ?>
        <div class="col-sm-9 col-md-10">
            <div class="row">
                <div class="col-sm-6 w-75">

                    <?php
                        // Check if the 'update_pass' form is submitted
                        if(isset($_POST['update_pass'])){
                            // Retrieve form data
                            $user_email = $_POST['user_email'];
                            $old_pass = $_POST['old_pass'];
                            $new_pass = $_POST['new_pass'];

                            // Attempt to change the user's password
                            if($user->changePassword($user_id, $old_pass, $new_pass)){
                                // Redirect to 'studentChangePass.php' upon successful password change
                                header("location:studentChangePass.php");
                            }
                            else{
                                // Display an error message if the password change fails
                                echo"<div class='text-danger'>
                                <span><h5>Incorrect Password !!</h5></span>
                                </div>";
                            }
                        }
                    ?>

                    <?php
                        // Retrieve user information and loop through the data
                        if($user_info = $user->getUser($user_id , "getUserById")){
                            foreach ($user_info as $user_data) {
                                $user_email = $user_data['user_email'];
                    ?>

                    <!-- Display the password change form -->
                    <form action="" class="mt-5 mx-5 shadow-lg rounded px-3 py-3" method="post">
                        <div class="form-group my-3">
                            <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?= $user_id; ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputemail">Email</label>
                            <input class="form-control" type="email" name="user_email" id="student_email"
                                value="<?= $user_email; ?>" readonly required>
                        </div>
                        <div class="form-group my-3">
                            <label for="studentNewPass">Old Password</label>
                            <input type="password" name="old_pass" id="studentNewPass" class="form-control" required>
                        </div>
                        <div class="form-group my-3">
                            <label for="studentNewPass">New Password</label>
                            <input type="password" name="new_pass" id="new_pass" class="form-control" required>
                        </div>
                        <div class="d-flex flex-row justify-content-start my-2">
                            <input type="submit" class="btn btn-primary mx-1" name="update_pass" value="Update">
                            <input type="reset" class="btn btn-danger mx-1" name="reset" value="Cancel">
                        </div>
                    </form>

                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
