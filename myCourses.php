<?php
    // Include the file for checking login status
    include 'check_login.php';

    // Include the Order class file
    include_once 'classes/orders.php';
?>

<!-- Container for the page content -->
<div class="container-fluid">
    <!-- Row with flexible width to accommodate header and main content -->
    <div class="row flex-nowrap">
        <!-- Include the header file for the student panel -->
        <?php include 'stuInclude/stuHeader.php';?>

        <!-- Main content container with specified width -->
        <div class="container mt-5 ml-4" style="width: 83%;">
            <!-- Row with specified width for course display -->
            <div class="row" style="width: 71%;">
                <!-- Jumbotron for displaying the heading -->
                <div class="jumbotron" style="margin: 15px;">
                    <h4 class="text-center">All Courses</h4>
                    
                    <?php
                        // Check if the user is logged in
                        if (isset($user_email)) {
                            // Create an instance of the Order class
                            $getPurchasedCourse = new Order();
                            
                            // Get the list of purchased courses for the user
                            $result = $getPurchasedCourse->getPurchasedCourse($user_email);

                            // Check if there are purchased courses
                            if ($result !== null && $result->num_rows > 0) {
                                // Loop through each purchased course and display information
                                while ($row = $result->fetch_assoc()) {
                                    // Encode and format course ID for URLs
                                    $courseId = base64_encode($row['course_id']);
                                    $course_id = urlencode($courseId);
                                    ?>

                                    <!-- Card container for displaying each purchased course -->
                                    <div class="bg-light mb-3" style="box-shadow: 10px 10px lightblue;">
                                        <h2 class="card-header"><?php echo $row['c_name']; ?></h2>
                                        <div class="row" style="padding: 21px;">
                                            <!-- Column for course image -->
                                            <div class="col-sm-3">
                                                <img src="admin/img/<?php echo $row['image_url']; ?>" width="270" height="230" alt="">
                                            </div>
                                            <!-- Placeholder column for spacing -->
                                            <div class="col-sm-6 mb-3"></div>
                                            <!-- Card body containing course details -->
                                            <div class="card-body">
                                                <p class="card-title"><?php echo $row['c_desc']; ?></p>
                                                <p class="card-text d-inline"><b>Instructor:</b> <?= $row['instructor_name']; ?></p>
                                                <br />
                                                <p class="card-text d-inline"><b>Duration:</b> NA</p><br />
                                                <p class="card-text d-inline"><b>Price:</b> 5500 INR</p>
                                                
                                                <!-- Container for watch course button -->
                                                <div class="container my-4" style="padding-left: 0px;">
                                                    <a href="watchCourse.php?course_id=<?php echo $course_id; ?>"
                                                        class="btn btn-primary">Watch Course</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                            } else {
                                // Display a message when the user hasn't purchased any courses
                                echo "<h4 class='text-center'>You haven't purchased any courses.</h4>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of main content container -->
