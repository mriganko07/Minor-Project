<?php
    // Initialize the user_email variable
    $user_email = '';

    // Start the session
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        // If logged in, retrieve the user's email from the session
        $user_email = $_SESSION['user_email'];
    }

    // Include necessary class files
    include_once 'classes/courses.php';
    include_once 'classes/orders.php';
    include_once 'classes/user.php';
    include_once 'classes/feedback.php';
    include_once 'classes/quiz.php';

    // Create instances of classes
    $course = new Course();
    $result = $course->getCourseByLimit();
    $course_count = $course->count();

    $order = new Order();

    $user = new user();
    $user_count = $user->count();

    $feedback = new feedback();
    $feedback_count = $feedback->count();

    $quiz = new quiz();
    $quiz_count = $quiz->count();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Title of the page -->
    <title>codeXLearns</title>
    
    <!-- Bootstrap CSS from a CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <!-- Custom CSS for the user panel -->
    <link rel="stylesheet" href="userPanelCss/home.css">

    <!-- Font Awesome icons from a CDN -->
    <script src="https://kit.fontawesome.com/2f671c2a32.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Include header file -->
    <?php include '_header.php' ?>

    <!-- Heading container with information and a button -->
    <div class="heading-container d-flex justify-content-center align-items-center">
        <div class="container ">
            <h1 class="">Online Learning Platform</h1>
            <p class="">Learning online opens doors to a world of knowledge, connecting students to endless educational possibilities.</p>
            <a href="studentCourses.php" class="button btn text-center">Join Fast</a>
        </div>
    </div>

    <!-- Container for displaying top courses -->
    <div class="container my-5">
        <h1 class="text-center ">Top Courses</h1>
        <div class="row course-row">
            <!-- Display top courses -->
            <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        // Extract course details from the row
                        $course_id = $row['course_id'];
                        $course_name = $row['c_name'];
                        $course_desc = $row['c_desc'];
                        $purchased = false;
                        
                        // Check if the user has purchased the course
                        $orderResult = $order->isEnrolled($course_id, $user_email);

                        if ($orderResult && $orderResult->num_rows > 0) {
                            $purchased = true; // User has purchased the course
                        }

                        // Display course information and enrollment button
                        echo '<div class="card mx-4 my-4" style="width: 18rem;">
                                <img src="admin/img/'. $row['image_url'] .'" width="270" height="230" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">' . $course_name . '</h5>
                                    <p class="card-text">' . substr($course_desc, 0, 40) . '...</p>';

                        if($purchased){
                            echo '<span class="btn btn-success">Enrolled</span>';
                        }else{
                            echo '<a href="courseCheckout.php?course_id=' . $course_id . '" class="btn btn-primary">Buy Now</a>';
                        }

                        echo '</div>
                              </div>';
                    }
                }
            ?>
            
            <!-- View more button -->
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <a href="studentCourses.php" class="button btn text-center">View More</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Static information section -->
    <div class="container mt-5">
        <div class="row">
            <!-- Image column -->
            <div class="col-md-6">
                <div class="container container-image">
                    <img src="userPanelImages/index1.webp" alt="index1" class="img-fluid">
                </div>
            </div>
            <!-- Information column -->
            <div class="col-md-6">
                <div class="container container-info my-5">
                    <h1 class="text-contrast ">Learner outcomes on courses you will take</h1>
                    <!-- List of learner outcomes -->
                    <i class="fa-solid fa-check" style="color: #f2cb07;"></i>
                    <p class="text-contrast font-weight-bold ">Techniques to engage effectively with vulnerable children
                    </p>
                    <i class="fa-solid fa-check" style="color: #f2cb07;"></i>
                    <p class="text-contrast font-weight-bold ">Techniques to engage effectively with vulnerable children
                    </p>
                    <i class="fa-solid fa-check" style="color: #f2cb07;"></i>
                    <p class="text-contrast font-weight-bold ">Techniques to engage effectively with vulnerable children
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Counts Section displaying various statistics -->
    <section id="counts" class="counts section-bg">
        <div class="container">
            <div class="row counters">
                <!-- Display counts with dynamic values -->
                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1"
                        class="purecounter" style="color: #6499E9;"><?= $user_count; ?></span>
                    <p>Students</p>
                </div>
                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1"
                        class="purecounter" style="color: #6499E9;"><?= $course_count; ?></span>
                    <p>Courses</p>
                </div>
                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1"
                        class="purecounter" style="color: #6499E9;"><?= $feedback_count; ?></span>
                    <p>Feedbacks</p>
                </div>
                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"
                        class="purecounter" style="color: #6499E9;"><?= $quiz_count; ?></span>
                    <p>Quiz</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trainers Section displaying information about trainers -->
    <section id="trainers" class="trainers">
        <div class="container" data-aos="fade-up">
            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                <!-- Trainer information cards -->
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="userPanelImages/trainer-1.jpg" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>Walter White</h4>
                            <span>Web Development</span>
                            <p>
                                Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis
                                quaerat qui aut aut aut
                            </p>
                            <!-- Social media links for the trainer -->
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="userPanelImages/trainer-2.jpg" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>Eva Daniels</h4>
                            <span>Marketing</span>
                            <p>
                                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum
                                rerum temporibus
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="userPanelImages/trainer-3.jpg" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>William Anderson</h4>
                            <span>Content</span>
                            <p>
                                Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum
                                toro des clara
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include footer file -->
    <?php include '_footer.php';?>

    <!-- Bootstrap JavaScript from a CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
