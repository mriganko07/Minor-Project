<?php
// Start the session to maintain user data
// session_start();
include 'check_login.php';

// Include the 'Order' class and configuration for Razorpay
include_once 'classes/orders.php';
require('razorpayConfig.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

// Initialize variables for success and error messages
$success = true;
$error = "Payment Failed";

// Check if the Razorpay payment ID is not empty
if (empty($_POST['razorpay_payment_id']) === false)
{
    // Create an instance of the Razorpay API
    $api = new Api($keyId, $keySecret);

    try
    {
        // Verify the payment signature using the provided attributes
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        // If there is a verification error, set success to false and capture the error message
        $success = false;
        $error = 'Razorpay Error: ' . $e->getMessage();
    }
}

// If payment is successful, proceed to create an order
if ($success === true)
{
    // Retrieve data from session variables
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $email = $_SESSION['email'];
    $price = $_SESSION['price'];
    $course_id = $_SESSION['course_id'];

    // Create an instance of the 'Order' class
    $orders = new Order();

    // Call the 'createOrders' method to store order details in the database
    $result = $orders->createOrders($razorpay_order_id, $razorpay_payment_id, $email, $price, $course_id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Thank You Page Content -->
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="border border-3 border-success"></div>
            <div class="card  bg-white shadow p-5">
                <div class="mb-4 text-center">
                    <!-- Display a checkmark icon indicating success -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                        fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                </div>
                <div class="text-center">
                    <!-- Display a thank you message and a button to navigate back to the home page -->
                    <h1>Thank You !</h1>
                    <p><?php if (isset($result)) { echo $result; }?></p>
                    <a href="studentProfile.php" class="btn btn-outline-success">Back Home</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
