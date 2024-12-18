<?php
// Include the file for checking user login status
include 'check_login.php';

// Include necessary classes for handling courses and orders
include_once 'classes/courses.php';
include_once 'classes/orders.php';

// Create an instance of the Course class
$course = new Course();

// Retrieve the list of courses
$result = $course->getCourse();

// Create an instance of the Order class
$order = new Order();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Include custom styles for courses page -->
    <link rel="stylesheet" href="userPanelCss/courses.css">
    <!-- Include Font Awesome icons from CDN -->
    <script src="https://kit.fontawesome.com/2f671c2a32.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Include the header -->
    <?php include '_header.php' ?>

    <!-- Top Content Section -->
    <section class="top-content  d-flex justify-content-center align-items-center">
        <div class="container top-content-info">
            <h1 class="text-center text-white">All Courses</h1>
        </div>
    </section>

    <!-- Main Content Section -->
    <div class="container my-5">
        <div class="row course-row">
            <?php
                // Check if courses are available
                if (isset($result)) {
                    // Loop through each course in the result set
                    while ($row = $result->fetch_assoc()) {
                        $course_id = $row['course_id'];
                        $course_name = $row['c_name'];
                        $course_desc = $row['c_desc'];
                        $purchased = false; // Assume the user has not purchased the course by default

                        // Check if the user has purchased this course by querying the 'orders' table
                        $user_email = $_SESSION['user_email'];
                        $orderResult = $order->isEnrolled($course_id, $user_email);

                        // Update the 'purchased' status based on the query result
                        if ($orderResult && $orderResult->num_rows > 0) {
                            $purchased = true; // User has purchased the course
                        }

                        // Display course information in a card format
                        echo '<div class="card mx-4 my-4" style="width: 299px;">
                        <img src="admin/img/'. $row['image_url'] .'" width="270" height="230" alt="">
                        <div class="card-body">
                            <h5 class="card-title">' . $course_name . '</h5>
                            <p class="card-text">' . substr($course_desc, 0, 40) . '...</p>';

                        // Check if the user has purchased the course and display the button or label accordingly
                        if ($purchased) {
                            echo '<span class="btn btn-success">Enrolled</span>';
                        } else {
                            echo '<a href="courseCheckout.php?course_id=' . $course_id . '" class="btn btn-primary">Buy Now</a>';
                        }

                        echo '</div></div>';
                    }
                }
            ?>
        </div>
    </div>

    <!-- Include the footer -->
    <?php include '_footer.php';?>

    <!-- Include Bootstrap JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
