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
include_once '../classes/courses.php'; // Include Course class
?>

<?php
// Get course information
$getCourse = new Course();  // Create Course object
$result = $getCourse->getCourse();  // Fetch course data
?>

<?php
// Delete course and associated data
$deleteCourse = new Course(); // Create Course object for deletion

if (isset($_POST['delete'])) {

    // Get the course ID to be deleted
    $sno = $_POST['c_id'];

    // Delete course and related data
    $delCheck = $deleteCourse->deleteCourse($sno);  // Delete course

    // Redirect back to the courses page
    header("location:courses.php");
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <!-- Include the DaisyUI CSS library -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courses</title>
    <!-- Add custom styling for smaller screens -->
    <style>
        @media (max-width: 768px) {
            .table-wrapper {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?> <!-- Include header file -->

    <!-- Main content container -->
    <div class="flex flex-col p-5 gap-5">
        <label>
            <!-- Display the title for Courses Info -->
            <h1 class="font-bold text-2xl text-white">Courses Info</h1>
        </label>

        <!-- Courses table container with styling -->
        <div id="table" class="flex justify-center items-center rounded-md overflow-x-auto">
            <div class="container p-2 mx-auto sm:px-4 rounded-2xl">
                <div class="overflow-x-auto">
                    <!-- Courses information table -->
                    <table class="w-full p-6 text-xs text-left whitespace-nowrap">
                        <thead>
                            <!-- Table header row -->
                            <tr class="bg-gray-300">
                                <th class="p-3 text-black font-semibold text-base">
                                    Course Id
                                </th>
                                <th class="p-3 text-black font-semibold text-base">
                                    Course Name
                                </th>
                                <th class="p-3 text-black font-semibold text-base">
                                    Course Description
                                </th>
                                <th class="p-3 text-black font-semibold text-base">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-b bg-blue-900">
                            <?php
                            // Display course information in table rows
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                            <td class="px-3 py-2 text-white text-base">
                                                <p>' . $row['course_id'] . '</p>
                                            </td>
                                            <td class="px-3 py-2 text-white text-base">
                                                <p>' . $row['c_name'] . '</p>
                                            </td>
                                            <td class="px-3 py-2 text-white text-base">
                                                <p>' . substr($row['c_desc'], 0, 40) . '...</p>
                                            </td>
                                            <td class="px-3 py-2 text-white">
                                                <form action="courses.php" method="post">
                                                    <input type="hidden" name="c_id" value=' . $row['course_id'] . '>
                                                    <div class="flex flex-row gap-4">
                                                        <!-- Edit button -->
                                                        <button type="button" data-te-ripple-init data-te-ripple-color="light"
                                                            class="mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                                            style="background-color: #1da1f2"
                                                            onclick="window.location.href=\'EditCourse.php?c_id=' . $row['course_id'] . '\'">
                                                            Edit
                                                        </button>
                                                        <!-- Delete button -->
                                                        <input type="submit" onclick="return checkDelete(' . $row['course_id'] . ')"
                                                            class="mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                                            style="background-color: red" value="Delete" name="delete">
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                // If no courses are available
                                echo 'No Course available';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Button to add new courses -->
        <button class="btn btn-outline h-5 w-32 cursor-pointer" onclick="window.location.href='AddCourseModal.php'">
            Add Courses
        </button>
    </div>

    <!-- Container for course modal -->
    <div id="course-modal" class="flex items-center justify-center"></div>

    <!-- Include the Tailwind CSS library -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- JavaScript function to confirm course deletion -->
    <script>
        function checkDelete(courseId) {
            if (confirm("Are you sure about that?")) {
                // If the user confirms, proceed with deleting the course.
                window.location.href = 'courses.php';
                return true;
            } else {
                // If the user cancels, do not delete the course.
                return false;
            }
        }
    </script>
</body>

</html>
