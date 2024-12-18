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
include_once '../classes/lessons.php';
?>

<?php
// Check if the 'lesson_id' is not set or is null; if true, redirect to lessons.php
if (!isset($_GET['lesson_id']) or $_GET['lesson_id'] == null) {
    echo "<script>window.location = 'lessons.php';</script>";
} else {
    // Assign the 'lesson_id' from the URL to a variable
    $lessonId = $_GET['lesson_id'];
}

// Create a new Lesson object
$lesson = new Lesson();

// Check if the form is submitted and the 'update' button is clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['update'])) {
    // Retrieve values from the form
    $lessonName = $_POST['lessonName'];
    $lessonDesc = $_POST['lessondesc'];
    $lessonLink = $_POST['lessonlink'];
    $lessonId = $_POST['lessonid'];

    // Call the editLesson method to update the lesson
    $editLessonCheck = $lesson->editLesson($lessonId, $lessonName, $lessonDesc, $lessonLink);
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
    <title>Edit Lesson</title>
</head>

<body>
    <!-- Main content container -->
    <div class="min-h-screen flex justify-center items-start">
        <label>
            <!-- Display the title for Edit Lesson -->
            <h1 class="font-bold text-2xl text-white">Edit Lesson</h1>
        </label>
    </div>

    <!-- The Modal -->
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-700 bg-opacity-50 text-black">
        <?php
        // Get lesson details by lesson ID
        $getLesson = $lesson->getLessonById($lessonId);
        if ($getLesson) {
            while ($row = $getLesson->fetch_assoc()) {
                $lesson_id = $row['lesson_id'];
                $lesson_name = $row['lesson_name'];
                $lesson_desc = $row['lesson_desc'];
                $lesson_link = $row['lesson_link'];
            }
        }
        ?>
        <!-- Lesson edit form -->
        <form novalidate class="container w-full sm:w-1/2 flex flex-col mx-auto space-y-12" action="" method="POST">
            <!-- Fieldset containing lesson details -->
            <fieldset class="sm:grid grid-cols-5 gap-6 p-6 rounded-xl shadow-sm bg-gray-900 text-white">
                <!-- Larger image with button at the bottom -->
                <div class="w-full sm:w-[1/3] flex items-center justify-center flex-col">
                    <img name="thumbnail" src="https://source.unsplash.com/300x300/?random" alt="null"
                        class="w-full h-auto mb-5 rounded-sm sm:w-32 sm:h-32 bg-gray-700" />
                </div>
                <div class="col-span-full sm:col-span-3 grid grid-cols-6 gap-4">
                    <!-- Course create form starts -->
                    <div class="col-span-full sm:col-span-3">
                        <!-- Display the Lesson ID -->
                        <label for="title" class="text-sm">Lesson ID</label>
                        <input id="title" name="lessonid" type="text" placeholder="Title"
                            class="p-2 w-full rounded-md focus:ring focus:ri focus:ri border-gray-700 text-gray-900" value="<?php echo $lesson_id; ?>" readonly />
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <!-- Input field for Lesson Name -->
                        <label for="category" class="text-sm">Lesson Name</label>
                        <input id="category" name="lessonName" type="text" placeholder="category"
                            class="w-full rounded-md p-2 focus:ring focus:ri focus:ri border-gray-700 text-gray-900" value="<?php echo $lesson_name; ?>" required />
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <!-- Input field for Lesson Link -->
                        <label for="instructor" class="text-sm">Lesson Link</label>
                        <input id="instructor" name="lessonlink" type="text" placeholder="Instructor"
                            class="w-full rounded-md p-2 focus:ring focus:ri focus:ri border-gray-700 text-gray-900" value="<?php echo $lesson_link; ?>" required />
                    </div>
                    <div class="col-span-full">
                        <!-- Textarea for Lesson Description -->
                        <label for="description" class="text-sm">Lesson description</label>
                        <textarea style="resize: none" id="description" name="lessondesc" type="text"
                            placeholder="Description"
                            class="w-full rounded-md p-5 focus:ring focus:ri focus:ri border-gray-700 text-gray-900"><?php echo $lesson_desc; ?></textarea>
                        <br />
                        <!-- Action buttons -->
                        <div class="flex justify-between w-full gap-16 items-end">
                            <!-- Update Lesson button -->
                            <button class="col-span-full sm:col-start-4 p-3 rounded-md"
                                style="background-color: blue; color: white" type="submit" name="update">
                                Update
                            </button>
                            <!-- Close button -->
                            <button id="closeModal" type="button"
                                class="col-span-full p-3 rounded-md cursor-pointer"
                                style="background-color: blue; color: white"
                                onclick="window.location.href='lessons.php'">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <!-- Include the Tailwind CSS library -->
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
