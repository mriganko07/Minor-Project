<nav class="navbar navbar-expand-lg" style="background: #f0ece2;">
    <div class="container-fluid">
        <a class="navbar-brand  fs-5 text-dark" href="index.php"><strong>CodexLearn</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  fs-5 text-dark" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  fs-5 text-dark" href="studentCourses.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  fs-5 text-dark" href="aboutUs.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  fs-5 text-dark" href="contact.php">Contact</a>
                </li>
            </ul>
            <div class="d-flex">
            <?php if(isset($_SESSION['user_id'])){
                            echo '<div class="dropdown-center me-5">
                            <button class="btn bg-transparent border-0 shadow-none" onclick="window.location.href=\'studentProfile.php\'" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/img/profile.png" width="40px" class="border border-dark rounded-circle">
                            </button>
                        </div>';
                        
                        }
                        else{
                            $user_id = '';
                            echo '<a href="studentLogin.php" class="btn btn-danger btn-md mx-1">Login</a>
                                    <a href="studentSignup.php" class="btn btn-danger btn-md mx-1">Sign Up</a>';     
                        }  ?>
        </div>
        </div>
        
    </div>
    </div>

</nav>