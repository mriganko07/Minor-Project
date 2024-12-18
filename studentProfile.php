<?php
// Include the 'check_login.php' file for login checks
include 'check_login.php';

// Include the 'user.php' class file
include_once "classes/user.php";

// Create a new instance of the 'user' class
$user = new user();
?>

<!-- Student Header -->
<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include 'stuInclude/stuHeader.php'; ?>
        <div class="col-sm-6 mt-5 w-75">

            <?php
            // Check if the 'update' form is submitted
            if (isset($_POST['update'])) {
                // Retrieve form data
                $user_name = $_POST['user_name'];
                $user_email = $_POST['user_email'];
                $user_ph = $_POST['user_ph'];
                $user_occupation = $_POST['user_occupation'];
                // $newImageName="";

                // Image update
                if (isset($_FILES["image"]) && $_FILES["image"]["error"] !== 4) {
                    $fileName = $_FILES["image"]["name"];
                    $fileSize = $_FILES["image"]["size"];
                    $tmpName = $_FILES["image"]["tmp_name"];

                    $validImageExtension = ['jpg', 'jpeg', 'png'];
                    $imageExtension = explode('.', $fileName);
                    $imageExtension = strtolower(end($imageExtension));

                    // Validate image extension
                    if (!in_array($imageExtension, $validImageExtension)) {
                        echo "<script> alert('Invalid Image Extension'); </script>";
                    } else if ($fileSize > 1000000) {
                        echo "<script> alert('Image Size Is Too Large'); </script>";
                    } else {
                        // Set the new image name and destination directory
                        $newImageName = $user_email . '.' . 'png';
                        $destinationDirectory = 'assets/img/user_image/' . $newImageName;

                        // Move the uploaded image to the destination directory
                        if (move_uploaded_file($tmpName, $destinationDirectory)) {
                            // Image uploaded successfully, update the user's profile image
                            $user->updateUserImage($user_id, $newImageName);
                        }
                    }
                }

                // Update user information and image
                if ($user->editUser($user_id, $user_name, $user_email, strval($user_ph), $user_occupation)) {
                    header("location:studentProfile.php");
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_email'] = $user_email;
                } else {
                    // Display an error message if the update fails
                    echo "<div class='text-danger'>
                    <span><h5>Incorrect Password !!</h5></span>
                    </div>";
                }
            }
            ?>

            <?php
            // Retrieve user information and loop through the data
            if ($user_info = $user->getUser($user_id, "getUserById")) {
                foreach ($user_info as $user_data) {
                    $user_name = $user_data['user_name'];
                    $user_email = $user_data['user_email'];
                    $user_ph = $user_data['user_ph'];
                    $user_occupation = $user_data['user_occupation'];
                    $user_img = $user_data['img_url'];
            ?>

                    <!-- Display the user profile update form -->
                    <form class="mx-5 shadow-lg rounded px-3 py-3" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>" readonly>
                        </div>
                        <div class="">
                            <!-- Display the current user image and provide an option to upload a new one -->
                            <img src="assets/img/user_image/<?= $user_img; ?>" alt="" class="border border-1 border-dark rounded-circle" width="150px" height="150px">
                            <input type="file" name="image" id="">
                        </div>
                        <div class="form-group">
                            <label for="student_name">Name</label>
                            <input class="form-control" type="text" name="user_name" id="student_name" value="<?= $user_name;  ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="student_id">Email</label>
                            <input class="form-control" type="text" name="user_email" id="student_email" value="<?= $user_email; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="user_ph">Phone Number</label>
                            <input class="form-control" type="number" name="user_ph" id="user_ph" value="<?= $user_ph; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="student_occupation">Occupation</label>
                            <input class="form-control" type="text" name="user_occupation" id="student_occupation" value="<?= $user_occupation; ?>" required>
                        </div>
                        <div class="d-flex flex-row justify-content-start my-2">
                            <!-- Submit and Reset buttons for the form -->
                            <input type="submit" class="btn btn-primary mx-1" name="update" value="Update">
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