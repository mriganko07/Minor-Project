<?php
// Start a new session or resume the existing session.
session_start();
// Regenerate the session ID to enhance session security.
session_regenerate_id(true);

// Check if the user is not logged in; redirect to the login page if not.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: adminLogin.php");
  exit;
}

// Include the 'courses.php' file, which likely contains the Course class.
include_once '../classes/courses.php';

// Create a new instance of the Course class.
$addCourse = new Course();

// Check if the form is submitted (POST request) and the 'create' button is clicked.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
  // Retrieve values from the form.
  $courseName = $_POST['courseName'];
  $courseDesc = $_POST['courseDesc'];
  $courseCategory = $_POST['courseCategory'];
  $instructorName = $_POST['instructorName'];

  // Check if an image file is uploaded.
  if ($_FILES["image"]["error"] === 4) {
    echo "<script> alert('Image Does Not Exist'); </script>";
  } else {
    // Retrieve information about the uploaded image.
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // Define valid image extensions.
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    // Get the actual image extension.
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));

    // Check if the image extension is valid.
    if (!in_array($imageExtension, $validImageExtension)) {
      echo "<script> alert('Invalid Image Extension'); </script>";
    } else if ($fileSize > 1000000) { // Check if the image size is within limits.
      echo "<script> alert('Image Size Is Too Large'); </script>";
    } else {
      // Generate a unique name for the image.
      $newImageName = uniqid() . '.' . $imageExtension;
      // Set the destination directory for the uploaded image.
      $destinationDirectory = '../admin/img/' . $newImageName;

      // Move the uploaded file to the destination directory.
      if (move_uploaded_file($tmpName, $destinationDirectory)) {
        // Call the 'addCourse' method with the form data and the new image name.
        $addCourseCheck = $addCourse->addCourse($courseName, $courseDesc, $courseCategory, $instructorName, $newImageName);
      } else {
        echo "<script> alert('Failed to move the uploaded file to the destination directory.'); </script>";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Course</title>
    <!-- Daisyui Link -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="min-h-screen flex justify-center items-start">
        <label>
            <h1 class="font-bold text-2xl text-white">Create Course</h1>
        </label>
    </div>
    <!-- The Modal starts here -->
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-700 bg-opacity-50 text-black">
        <!-- The Form starts here -->
        <form novalidate class="container w-full sm:w-1/2 flex flex-col mx-auto space-y-12" action="AddCourseModal.php"
            method="POST" enctype="multipart/form-data">
            <!-- Form Container -->
            <fieldset class="sm:grid grid-cols-5 gap-6 p-6 rounded-xl shadow-sm bg-gray-900 text-white">
                <!-- Fieldset for form styling -->
                <div class="w-full sm:w-[1/3] flex items-center justify-center flex-col">''
                    <!-- Image Upload Section -->
                    <input type="file" name="image" id="" accept=".jpg, .jpeg, .png"
                        style="font-size: 11px; margin-left: 45px;">
                </div>
                <div class="col-span-full sm:col-span-3 grid grid-cols-6 gap-4">
                    <!-- Course Information Section -->
                    <div class="col-span-full sm:col-span-3">
                        <!-- Title Input -->
                        <label for="title" class="text-sm">Title</label>
                        <input id="title" name="courseName" type="text" placeholder="Title"
                            class="p-2 w-full rounded-md focus:ring focus:ri focus:ri border-gray-700 text-gray-900" />
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <!-- Category Input -->
                        <label for="category" class="text-sm">Category</label>
                        <input id="category" name="courseCategory" type="text" placeholder="category"
                            class="w-full rounded-md p-2 focus:ring focus:ri focus:ri border-gray-700 text-gray-900" />
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <!-- Instructor Name Input -->
                        <label for="instructor" class="text-sm">Instructor Name</label>
                        <input id="instructor" name="instructorName" type="text" placeholder="Instructor"
                            class="w-full rounded-md p-2 focus:ring focus:ri focus:ri border-gray-700 text-gray-900" />
                    </div>
                    <div class="col-span-full">
                        <!-- Course Description Textarea -->
                        <label for="description" class="text-sm">Course description</label>
                        <textarea style="resize: none" id="description" name="courseDesc" type="text"
                            placeholder="Description"
                            class="w-full rounded-md p-5 focus:ring focus:ri focus:ri border-gray-700 text-gray-900"></textarea>
                        <br />
                        <div class="flex justify-between w-full gap-16 items-end">
                            <!-- Create and Close Buttons -->
                            <button class="col-span-full sm:col-start-4 p-3 rounded-md"
                                style="background-color: blue; color: white" type="submit" name="create">
                                Create
                            </button>
                            <button id="closeModal" type="button" class="col-span-full p-3 rounded-md cursor-pointer"
                                style="background-color: blue; color: white"
                                onclick="window.location.href='courses.php'">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </fieldset>
            <?php
      // Check if the variable $addCourseCheck is set.
      if (isset($addCourseCheck)) {
          // If set, display the content of $addCourseCheck (likely a success or error message).
          echo $addCourseCheck;
      }
    ?>
        </form> <!-- The Form ends here -->

    </div><!-- The Modal ends here -->

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>