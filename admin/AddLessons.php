<?php
// Start the session
session_start();
// Regenerate the session ID to enhance security
session_regenerate_id(true);

// Check if the user is not logged in; if not, redirect to the login page
if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] != true) {
  header("location: adminLogin.php");
  exit;
}
?>

<?php
// Include the Lessons class file
include '../classes/lessons.php';
?>

<?php
// Create a new Lesson object
$addLesson = new Lesson();

// Check if the form is submitted and the 'addLesson' button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addLesson'])) {
  // Retrieve values from the form
  $lessonName = $_POST['lesson_name'];
  $lessonDesc = $_POST['lesson_desc'];
  $c_id = $_POST['c_id'];
  $c_name = $_POST['c_name'];
  $lesson_link = $_FILES['lesson_link']['name'];
  $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
  $relative_link_directory = 'lessonvid/' . $lesson_link;
  $link_directory = '../' . $relative_link_directory;

  // Move uploaded file to the specified directory
  move_uploaded_file($lesson_link_temp, $link_directory);

  // Add lesson using the Lesson class method
  $addLessonCheck = $addLesson->addLesson($lessonName, $lessonDesc, $relative_link_directory, $c_id, $c_name);
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Include the DaisyUI CSS library -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  <!-- Set the title of the page -->
  <title>Add Lessons</title>
</head>

<body>
  <!-- Main content container -->
  <div class="min-h-screen flex justify-center items-start">
    <label>
      <!-- Display the title for Create Lesson -->
      <h1 class="font-bold text-2xl text-white">Create Lesson</h1>
    </label>
  </div>

  <div>
    <!-- The Modal -->
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-700 bg-opacity-50 text-black">
      <!-- Lesson creation form -->
      <form novalidate class="container w-full sm:w-1/2 flex flex-col mx-auto space-y-12" action="" method="POST" enctype="multipart/form-data">
        <!-- Fieldset containing lesson details -->
        <fieldset class="sm:grid grid-cols-5 gap-6 p-6 rounded-md shadow-sm bg-gray-900">
          <!-- File input for lesson link -->
          <div class="w-full sm:w-[1/3] flex items-center justify-center flex-col">
            <input type="file" class="w-full h-auto mb-5 rounded-sm sm:w-32 sm:dark:bg-gray-700" id="fileInput" name="lesson_link" />
          </div>

          <!-- Form input fields for lesson details -->
          <div class="col-span-full sm:col-span-3 grid grid-cols-6 gap-4">
            <!-- Course ID input field -->
            <div class="col-span-full sm:col-span-3">
              <label for="CourseId" class="text-sm">Course Id</label>
              <input id="title" name="c_id" type="text" placeholder="Course Id" class="p-2 w-full rounded-md focus:ring focus:ri focus:ri border-gray-700 text-gray-900" value="<?php if (isset($_SESSION['c_id'])) {
                    echo $_SESSION['c_id'];
                } ?>" readonly />
            </div>

            <!-- Course Name input field -->
            <div class="col-span-full sm:col-span-3">
              <label for="courseName" class="text-sm">Course Name</label>
              <input id="category" name="c_name" type="text" placeholder="Course name" class="w-full rounded-md p-2 focus:ring focus:ri focus:ri border-gray-700 text-gray-900" value="<?php
                if (isset($_SESSION['c_name'])) {
                    echo $_SESSION['c_name'];
                }
                ?>" readonly />
            </div>

            <!-- Lesson Name input field -->
            <div class="col-span-full sm:col-span-3">
              <label for="LessonName" class="text-sm">Lesson Name</label>
              <input id="instructor" name="lesson_name" type="text" placeholder="Lesson Name" class="w-full rounded-md p-2 focus:ring focus:ri focus:ri border-gray-700 text-gray-900" />
            </div>

            <!-- Lesson Description textarea -->
            <div class="col-span-full">
              <label for="LessonDescription" class="text-sm">Lesson description</label>
              <textarea style="resize: none" id="LessonDescription" name="lesson_desc" type="text" placeholder="Lesson description" class="w-full rounded-md p-5 focus:ring focus:ri focus:ri border-gray-700 text-gray-900"></textarea>
              <br />

              <!-- Action buttons -->
              <div class="flex justify-between w-full gap-16 items-end">
                <!-- Add Lesson button -->
                <button class="col-span-full sm:col-start-4 p-3 rounded-md" style="background-color: blue; color: white" type="submit" name="addLesson">
                  Add Lesson
                </button>

                <!-- Close button -->
                <button id="closeModal" type="button" class="col-span-full p-3 rounded-md cursor-pointer" style="background-color: blue; color: white" onclick="window.location.href='lessons.php'">
                  Close
                </button>
              </div>
            </div>
          </div>
        </fieldset>

        <!-- Display add lesson message -->
        <?php
        if (isset($addLessonCheck)) {
            echo $addLessonCheck;
        }
        ?>
      </form>
    </div>
  </div>

  <!-- Include the Tailwind CSS library -->
  <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
