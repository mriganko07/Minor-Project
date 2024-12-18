<?php
    // Include the file for checking user login status
    include 'check_login.php';
    
    // Get the course ID from the GET parameters
    $course_id = $_GET['course_id'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    
    <!-- Include Bootstrap CSS from a CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
        /* Responsive styling for various screen sizes */
        @media(max-width: 1000px) {
            .outer {
                width: 75% !important;
            }
            .inner {
                width: 75% !important;
            }
        }

        @media(max-width: 500px) {
            .outer {
                width: 85% !important;
            }
            .inner {
                width: 85% !important;
            }
        }

        @media(max-width: 400px) {
            .outer {
                width: 95% !important;
            }
            .inner {
                width: 95% !important;
            }
        }
    </style>
</head>

<body>
    <!-- Container for the entire page -->
    <div class="container-fluid">
        <!-- Outer container for the form -->
        <div class="outer d-flex flex-column justify-content-center mx-auto mt-5 w-50 rounded py-4 shadow-lg">
            <!-- Heading for the form -->
            <h1 class="text-center py-2">Checkout</h1>

            <!-- Form for payment -->
            <form action="pay.php" method="POST" class="inner d-flex flex-column justify-content-center mx-auto w-75">
                <!-- Input field for price (set to 1000) -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo 5500; ?>" readonly>
                </div>

                <!-- Input field for customer name -->
                <div class="mb-3">
                    <label for="customername" class="form-label">Name</label>
                    <input type="text" class="form-control" required id="customername" name="customername">
                </div>

                <!-- Input field for email address (pre-filled with user's registered email) -->
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address - * Must enter your registered email</label>
                    <input type="email" class="form-control" required id="email" name="email" aria-describedby="emailHelp" value="<?php echo $user_email; ?>" readonly>
                </div>

                <!-- Input field for contact number -->
                <div class="mb-3">
                    <label for="contactno" class="form-label">Contact</label>
                    <input type="text" class="form-control" required id="contactno" name="contactno">
                </div>

                <!-- Hidden input field for passing the course ID -->
                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                <!-- Submit button for payment -->
                <button type="submit" class="btn btn-primary" name="submit">Pay 5500</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript from a CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
