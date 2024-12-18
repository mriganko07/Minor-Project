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
// Include necessary class files
include_once '../classes/courses.php';
include_once '../classes/lessons.php'; 
?>

<?php
// Create Lesson and Course objects
$courseLesson = new Lesson();
$getCourseById = new Course();

// Get the value of 'checkid' from the request, if set; otherwise, set it to null
$checkId = isset($_REQUEST['checkid']) ? $_REQUEST['checkid'] : null;

// Get the value of 'lesson_id' from the GET parameters, if set; otherwise, set it to null
$lessonId = isset($_GET['lesson_id']) ? $_GET['lesson_id'] : null;

// Check if the form is submitted and the 'delete' button is clicked
if (isset($_POST['delete'])) {
    $lessonId = $_POST['lesson_id'];
    // Call the deleteLesson method to delete the lesson
    $deleteLessonCheck = $courseLesson->deleteLesson($lessonId); 
    header("location:lessons.php");
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <!-- Include the DaisyUI CSS library -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Set the title of the page -->
    <title>Lessons</title>
</head>

<body>
    <!-- Include the header -->
    <?php include 'header.php'; ?>

    <!-- Main content -->
    <div class="flex flex-col gap-6 p-10">
        <div class="p-5 bg-white rounded-2xl">
            <h1 class="text-3xl font-bold text-left mb-5 text-black">Lessons</h1>
            <div class="relative flex flex-col gap-5">
                <form action="">
                    <label for "searchLesson" class="font-semibold text-black">
                        Enter a Course Id
                    </label>
                    <!-- Input field for searching lessons by course ID -->
                    <input type="text" name="checkid"
                        class="w-full rounded-md min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" />
                    <!-- Button to submit the search form -->
                    <button class="btn btn-primary w-1/5">Search for Lessons</button>
                </form>
            </div>
        </div>
        <!-- Lesson information starts -->
        <label>
            <h1 class="font-bold text-2xl text-white">Lesson Info</h1>
        </label>

        <div id="table" class="flex justify-center items-center rounded-md">
            <div class="container p-2 mx-auto sm:px-4 rounded-2xl">
                <div class="overflow-x-auto" style="font-size: 26px;">
                    <?php
                    // Get the course ID from the database
                    $checkCourseId = $courseLesson->getCourseId();

                    if ($checkCourseId !== null && $checkCourseId->num_rows > 0) {
                        while ($row = $checkCourseId->fetch_assoc()) {
                            if (isset($_REQUEST['checkid']) and $_REQUEST['checkid'] == $row['course_id']) {
                                // Get course details by course ID from courses table
                                $checkCourseIDByBtn = $getCourseById->getCourseById($checkId);
                                $row = $checkCourseIDByBtn->fetch_assoc();

                                if (($row['course_id']) == $_REQUEST['checkid']) {
                                    $_SESSION['c_id'] = $row['course_id'];
                                    $_SESSION['c_name'] = $row['c_name'];
                                    ?>
                                    <?php
                                    // Get lessons by the checked course ID
                                    $checkLessonByCheckId = $courseLesson->getLessonByCheckId($checkId);

                                    if ($checkLessonByCheckId !== null && $checkLessonByCheckId->num_rows > 0) {
                                        // Display a table of lessons
                                        echo '<table class="w-full p-6 text-xs text-left whitespace-nowrap">
                                        <thead>
                                            <tr class="bg-gray-300">
                                                <th class="p-3 text-black font-semibold text-base">
                                                    Lesson Id
                                                </th>
                                                <th class="p-3 text-black font-semibold text-base">
                                                    Lesson Name
                                                </th>
                                                <th class="p-3 text-black font-semibold text-base">
                                                    Lesson Link
                                                </th>
                                                <th class="p-3 text-black font-semibold text-base">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-b bg-blue-900">';

                                        while ($row = $checkLessonByCheckId->fetch_assoc()) {
                                            // Display each lesson in a table row
                                            echo '<tr>
                                                <td class="px-3 py-2 text-white text-base">
                                                    <p>' . $row['lesson_id'] . '</p>
                                                </td>
                                                <td class="px-3 py-2 text-white text-base">
                                                    <p>' . $row['lesson_name'] . '</p>
                                                </td>
                                                <td class="px-3 py-2 text-white text-base">
                                                    <p>' . $row['lesson_link'] . '</p>
                                                </td>

                                                <td class="px-3 py-2 text-white">
                                                    <form action="lessons.php" method="post">
                                                        <!-- Hidden input for lesson_id -->
                                                        <input type="hidden" name="lesson_id" value='.$row['lesson_id'].'>
                                                        <!-- Edit and Delete buttons -->
                                                        <div class="flex flex-row gap-4">
                                                            <button
                                                                type="button"
                                                                data-te-ripple-init
                                                                data-te-ripple-color="light"
                                                                class="mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                                                style="background-color: #1da1f2"
                                                                onclick="window.location.href=\'EditLesson.php?lesson_id=' . $row['lesson_id'] . '\'">
                                                                Edit
                                                            </button>
                                                            
                                                            <input type="submit" onclick="return checkDelete(' . $row['lesson_id'] . ')" class="mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                                            style="background-color: red" value="Delete" name="delete">
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>';
                                        }
                                    } else {
                                        // Display a message if no lessons found for the given course ID
                                        echo '<div class="flex justify-center items-center text-red-500">No lessons found for the given course ID.</div>';
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Button to add lessons -->
        <button class="btn btn-outline h-5 w-32 mx-10 my-5" onclick="window.location.href='AddLessons.php'">Add Lessons</button>
    </div>

    <!-- Modal for confirmation -->
    <div id="modal" class="fixed top-0 left-0 right-0 bottom-0  bg-black bg-opacity-50 hidden"></div>

    <!-- Include the Tailwind CSS library -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        // Function to confirm lesson deletion
        function checkDelete(lesson_id) {
            if (confirm("Are you sure about that?")) {
                // If the user confirms, proceed with deleting the lesson.
                window.location.href = 'lessons.php';
                return true;
            } else {
                // If the user cancels, do not delete the lesson.
                return false;
            }
        }
    </script>
</body>

</html>
