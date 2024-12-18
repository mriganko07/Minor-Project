<?php
// Include the 'check_login.php' file to ensure user authentication
include 'check_login.php';

// Include the 'Lesson' class
include_once 'classes/lessons.php';

// Create an instance of the 'Lesson' class
$lesson = new Lesson();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Watch Course</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
        crossorigin="anonymous">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: aliceblue;
        }

        .video {
            width: 70%;
        }

        @media (max-width: 800px) {
            .lesson {
                display: flex;
                flex-direction: column-reverse;
            }

            .video {
                width: 100%;
            }

            .lesson_name {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="container-fluid p-2" style="background-color: #337CCF;">
        <h3>Welcome to CodexLearns</h3>
        <a href="myCourses.php" class="btn btn-danger">My Courses</a>
    </div>

    <!-- Main Content Section -->
    <div class="container-fluid">
        <div class="row lesson">
            <!-- Lessons Sidebar -->
            <div class="col-sm-3 shadow-lg border rounded lesson_name h-100 px-1 py-3">
                <h4 class="text-center">Lessons</h4>
                <ul id="playlist" class="nav flex-column">
                    <?php
                        // Check if 'course_id' is set in the URL
                        if (isset($_GET['course_id'])) {
                            // Decode and retrieve the course ID from the URL
                            $courseId = base64_decode($_GET['course_id']);
                            $course_id = urldecode($courseId);
                            $encryptedCourseId = base64_encode($course_id);

                            // Get lessons for the specified course
                            $result = $lesson->getLessonByCheckId($course_id);

                            // Check if lessons are available
                            if ($result === null) {
                                echo "No lessons available for this course.";
                            } elseif ($result->num_rows > 0) {
                                // Display the list of lessons
                                while ($row = $result->fetch_assoc()) {
                                    $videoURL = "http://localhost/CodexLearns/" . $row['lesson_link'];
                                    echo '<li class="nav-item border-bottom py-2" data-movieurl="'. $videoURL .'" style="cursor:pointer;">'. $row['lesson_name'] .'</li>';
                                }
                            } else {
                                echo "No lessons available for this course.";
                            }
                        }
                    ?>
                    <!-- Link to start the quiz for the course -->
                    <a href="course_quiz.php?course_id=<?= urlencode($encryptedCourseId); ?>"
                        class="btn btn-success">Start Quiz</a>
                </ul>
            </div>

            <!-- Video Player Section -->
            <div class="col-sm-8 d-flex flex-row justify-content-center align-items-center video">
                <video id="videoarea" src="" class="mt-5 w-75 mx-auto mb-4" controls></video>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

    <!-- Include jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Custom JavaScript for Video Player -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Handle click events on lesson items in the playlist
        var playlistItems = document.querySelectorAll("#playlist li");

        playlistItems.forEach(function (item) {
            item.addEventListener("click", function () {
                var videoPath = this.getAttribute("data-movieurl");
                document.getElementById("videoarea").src = videoPath;
                document.getElementById("videoarea").load();
                document.getElementById("videoarea").play();
            });
        });

        // Load and play the first video by default
        var firstVideoPath = playlistItems[0].getAttribute("data-movieurl");
        document.getElementById("videoarea").src = firstVideoPath;
        document.getElementById("videoarea").load();
        document.getElementById("videoarea").play();
    });
</script>

</body>

</html>
