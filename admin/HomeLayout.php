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
// Include the Orders class file
include_once '../classes/orders.php';

// Create an Order object
$order = new Order();

// Get all orders
$result = $order->getOrders();

// Check if 'order_id' is set in the URL
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

// Check if the form is submitted and the 'remove' button is clicked
if (isset($_POST['remove'])) {
    $order_id = $_POST['order_id'];
    // Call the deleteOrders method to delete the order
    $delete = $order->deleteOrders($order_id, null, "delete");
    header("location:HomeLayout.php?delete_success=true");
}
?>

<!DOCTYPE html>
<html data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Set the title of the page -->
    <title>Dashboard</title>
    <!-- Include the DaisyUI CSS library -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
</head>
<style>
@media (max-width: 768px) {
    .content {
        margin-top: 100vh;
    }
}
</style>

<body class="overflow-x-hidden">
    <!-- Header Connection -->
    <?php include 'header.php'; ?>
    <!-- Main content -->
    <?php include 'Cards.php'; ?>
    <!-- Order Table -->
    <div class="container p-2 mx-auto sm:p-4 dark:text-gray-100">
        <h2 class="mb-4 text-2xl font-semibold leadi" style="
    color: black;">Course Ordered</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs">
                <colgroup>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col class="w-24">
                </colgroup>
                <thead class="dark:bg-gray-700">
                    <tr class="text-left">
                        <th class="p-3">Order ID</th>
                        <th class="p-3">Course ID</th>
                        <th class="p-3">User Email</th>
                        <th class="p-3">Order Date</th>
                        <th class="p-3 text-right">Amount</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display orders in the table
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr class="border-b border-opacity-20 dark:border-gray-700 dark:bg-gray-900">
                            <td class="p-3">
                                <p>' . $row['id'] . '</p>
                            </td>
                            <td class="p-3">
                                <p>' . $row['course_id'] . '</p>
                            </td>
                            <td class="p-3">
                                <p>' . $row['email'] . '</p>
                                
                            </td>
                            <td class="p-3">
                                <p>' . $row['order_date'] . '</p>
                            </td>
                            <td class="p-3 text-right">
                                <p>' . $row['price'] . '</p>
                            </td>
                            <td class="p-3 text-right">
                                <form action="HomeLayout.php" method="post">
                                    <input type="hidden" name="order_id" value="' . $row['id'] . '">
                                    <input type="submit" name="remove" onclick="return checkDelete(' . $row['id'] . ')" value="Del" class="mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg" style="background-color: red;">
                                </form>
                            </td>
                        </tr>';
                        }
                    } else {
                        echo "<p style='
                        color: red;
                    '>No orders right now.</p>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="flex justify-center">
        <button class="btn btn-outline btn-info" onclick="window.location.href='contacts.php'">Contact</button>
    </div>

    <!-- Include external scripts -->
    <script src="script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="ModalScript.js"></script>
    <script>
        function checkDelete(order_id) {
            if (confirm("Are you sure about that?")) {
                // If the user confirms, proceed with deleting the order.
                window.location.href = 'HomeLayout.php';
                return true;
            } else {
                // If the user cancels, do not delete the order.
                return false;
            }
        }
    </script>

</body>

</html>
