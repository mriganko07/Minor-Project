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
// Include the Course class file
include_once '../classes/courses.php';
?>

<?php
// Check if 'c_id' is not set or is null; if true, redirect to 'courses.php'
if (!isset($_GET['c_id']) or $_GET['c_id'] == null) {
    echo "<script>window.location = 'courses.php';</script>";
} else {
    $id = $_GET['c_id']; // Set the course ID from the query parameter
}

// Create a new Course object
$course = new Course();

// Check if the form is submitted and 'update' button is clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['update'])) {
    // Get values from the form
    $courseName = $_POST['courseName'];
    $courseDesc = $_POST['courseDesc'];
    $courseCategory = $_POST['courseCategory'];
    $instructorName = $_POST['instructorName'];

    // Update the course using the Course class method
    $updateCourseCheck = $course->updateCourse($id, $courseName, $courseDesc, $courseCategory, $instructorName);
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Set the title of the page -->
    <title>Edit Course</title>
    <!-- Include the DaisyUI CSS library -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Main content container -->
    <div class="min-h-screen flex justify-center items-start">
        <label>
            <!-- Display the title for Edit Course -->
            <h1 class="font-bold text-2xl text-white">Edit Course</h1>
        </label>
    </div>

    <!-- The Modal -->
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-700 bg-opacity-50 text-black">
        <?php
        // Get course information by ID
        $getCourse = $course->getCourseById($id);
        if ($getCourse) {
            while ($row = $getCourse->fetch_assoc()) {
                $courseName = $row['c_name'];
                $courseDesc = $row['c_desc'];
                $courseCategory = $row['c_category'];
                $instructorName = $row['instructor_name'];
            }
        }
        ?>

        <!-- Course update form -->
        <form novalidate class="container w-full sm:w-1/2 flex flex-col mx-auto space-y-12" action="" method="POST">
            <!-- Fieldset containing course details -->
            <fieldset class="sm:grid grid-cols-5 gap-6 p-6 rounded-xl shadow-sm bg-gray-900 text-white">
                <!-- Image container -->
                <div class="w-full sm:w-[1/3] flex items-center justify-center flex-col">
                    <!-- Display course thumbnail image -->
                    <img name="thumbnail" src="https://source.unsplash.com/300x300/?random" alt="null"
                        class="w-full h-auto mb-5 rounded-sm sm:w-32 sm:h-32 bg-gray-700" />
                </div>

                <!-- Form input fields for course details -->
                <div class="col-span-full sm:col-span-3 grid grid-cols-6 gap-4">
                    <!-- Course Name input field -->
                    <div class="col-span-full sm:col-span-3">
                        <label for="title" class="text-sm">Title</label>
                        <input id="title" name="courseName" type="text" placeholder="Title"
                            class="p-2 w-full rounded-md focus:ring focus:ri focus:ri border-gray-700 text-gray-900"
                            value="<?php echo $courseName; ?>" />
                    </div>

                    <!-- Course Category input field -->
                    <div class="col-span-full sm:col-span-3">
                        <label for="category" class="text-sm">Category</label>
                        <input id="category" name="courseCategory" type="text" placeholder="category"
                            class="w-full rounded-md p-2 focus:ring focus:ri focus:ri border-gray-700 text-gray-900"
                            value="<?php echo $courseCategory; ?>" />
                    </div>

                    <!-- Instructor Name input field -->
                    <div class="col-span-full sm:col-span-3">
                        <label for="instructor" class="text-sm">Instructor Name</label>
                        <input id="instructor" name="instructorName" type="text" placeholder="Instructor"
                            class="w-full rounded-md p-2 focus:ring focus:ri focus:ri border-gray-700 text-gray-900"
                            value="<?php echo $instructorName; ?>" />
                    </div>

                    <!-- Course Description textarea -->
                    <div class="col-span-full">
                        <label for="description" class="text-sm">Course description</label>
                        <textarea style="resize: none" id="description" name="courseDesc" type="text"
                            placeholder="Description"
                            class="w-full rounded-md p-5 focus:ring focus:ri focus:ri border-gray-700 text-gray-900"><?php echo $courseDesc ?></textarea>
                        <br />

                        <!-- Action buttons -->
                        <div class="flex justify-between w-full gap-16 items-end">
                            <!-- Update button -->
                            <button class="col-span-full sm:col-start-4 p-3 rounded-md"
                                style="background-color: blue; color: white" type="submit" name="update">
                                Update
                            </button>

                            <!-- Close button -->
                            <button id="closeModal" type="button"
                                class="col-span-full p-3 rounded-md cursor-pointer"
                                style="background-color: blue; color: white"
                                onclick="window.location.href='courses.php'">
                                Close
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Display update message -->
                <?php
                if (isset($updateCourseCheck)) {
                    echo $updateCourseCheck;
                }
                ?>
            </fieldset>
        </form>
    </div>

    <!-- Include the Tailwind CSS library -->
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
