<?php
// Start a session
include 'check_login.php';
    // Include the Razorpay configuration file
    require('razorpayConfig.php');
    // Include the Razorpay PHP library
    require('razorpay-php/Razorpay.php');
    
    
    // Import the Razorpay Api class
    use Razorpay\Api\Api; // Move the 'use' statement outside the conditional block
    
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Form has been submitted, process the data

        // Create an instance of the Razorpay Api class
        $api = new Api($keyId, $keySecret);

        // Check if the required keys exist in the $_POST array
        if (isset($_POST['price'], $_POST['customername'], $_POST['email'], $_POST['course_id'], $_POST['contactno'])) {
            // Retrieve form data
            $price = $_POST['price'];
            $_SESSION['price'] = $price;
            $customername = $_POST['customername'];
            $email = $_POST['email'];
            $_SESSION['email'] = $email;
            $course_id = $_POST['course_id'];
            $_SESSION['course_id'] = $course_id;
            $contactno = $_POST['contactno'];

            // Prepare data for creating an order
            $orderData = [
                'receipt'         => 3456,
                'amount'          => $price * 100, // Convert amount to paise
                'currency'        => 'INR',
                'payment_capture' => 1 // Auto capture
            ];

            // Create a Razorpay order
            $razorpayOrder = $api->order->create($orderData);

            // Extract the Razorpay order ID
            $razorpayOrderId = $razorpayOrder['id'];

            // Store the Razorpay order ID in the session
            $_SESSION['razorpay_order_id'] = $razorpayOrderId;

            // Initialize display amount
            $displayAmount = $amount = $orderData['amount'];

            // Convert amount to display currency if it's not INR
            if ($displayCurrency !== 'INR') {
                $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                $exchange = json_decode(file_get_contents($url), true);

                $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
            }

            // Prepare data for Razorpay checkout form
            $data = [
                "key"               => $keyId,
                "amount"            => $amount,
                "name"              => "CodexLearns",
                "description"       => "Coding for Everyone",
                "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
                "prefill"           => [
                    "name"              => $customername,
                    "email"             => $email,
                    "contact"           => $contactno,
                    "course_id"         => $course_id,
                ],
                "notes"             => [
                    "address"           => "Hello World",
                    "merchant_order_id" => "12312321",
                ],
                "theme"             => [
                    "color"             => "#F37254"
                ],
                "order_id"          => $razorpayOrderId,
            ];

            // Include display currency and amount if it's not INR
            if ($displayCurrency !== 'INR') {
                $data['display_currency']  = $displayCurrency;
                $data['display_amount']    = $displayAmount;
            }

            // Convert data to JSON format
            $json = json_encode($data);
        } else {
            // Handle the case where some or all of the required keys are missing in $_POST
            echo "Please fill in all the required fields in the form.";
        }
    } else {
        // The page is loaded for the first time, or without form submission
        // You can display the form here
    }
?>

<!-- Razorpay checkout form -->
<form action="verify.php" method="POST">
    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key']?>"
        data-amount="<?php echo $data['amount']?>" data-currency="INR" data-name="<?php echo $data['name']?>"
        data-image="<?php echo $data['image']?>" data-description="<?php echo $data['description']?>"
        data-prefill.name="<?php echo $data['prefill']['name']?>"
        data-prefill.email="<?php echo $data['prefill']['email']?>"
        data-prefill.contact="<?php echo $data['prefill']['contact']?>"
        data-prefill.course_id="<?php echo $data['prefill']['course_id']?>" data-notes.shopping_order_id="3456"
        data-order_id="<?php echo $data['order_id']?>" <?php if ($displayCurrency !== 'INR') { ?>
        data-display_amount="<?php echo $data['display_amount']?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?>
        data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>>
    </script>
    <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
    <input type="hidden" name="shopping_order_id" value="3456">
</form>

<!-- CSS style to hide the Razorpay payment button -->
<style>
    .razorpay-payment-button {
        display: none;
    }
</style>

<!-- Script to automatically click the Razorpay payment button on page load -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var button = document.querySelector('.razorpay-payment-button');
        if (button) {
            button.click();
        }
    });
</script>
