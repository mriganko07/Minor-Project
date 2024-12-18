<?php
// Start the session and regenerate the session ID for security
session_start();
session_regenerate_id(true);

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] != true) {
  header("location: adminLogin.php");
  exit;
}
?>
<?php
// Include the Feedback class
include '../classes/feedback.php';
?>
<?php
// Create an instance of the Feedback class to get feedback data
$feedback = new Feedback();
$result = $feedback->getFeedback();
?>
<?php
// Process feedback deletion
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

if(isset($_POST['remove'])){
  $f_id = $_POST['fid'];
  $delCheck = $feedback->deleteFeedback($f_id);
  header("location:feedback.php");
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
  <head>
    <!-- Meta tags and title for the HTML document -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedbacks</title>
    <!-- Link to the stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php include 'header.php'; ?>
    <!-- Feedback display section -->
    <div class="flex flex-col gap-10 p-10 rounded-xl mx-auto">
      <div class="container rounded-xl sm: text-white sm:rounded-xl">
        <h2 class="mb-4 text-2xl font-semibold leadi">All User Feedback</h2>
        <div class="overflow-x-auto ">
          <!-- Table to display feedback data -->
          <table class="w-full p-6 text-left whitespace-nowrap text-base rounded-xl">
            <thead>
              <!-- Table header row -->
              <tr class="bg-gray-300 text-black">
                <th class="p-3">Sno</th>
                <th class="p-3">Feedback</th>
                <th class="p-3">User ID</th>
                <th class="p-3">Time</th>
                <th class="p-3">Action</th>
              </tr>
            </thead>
            <tbody class="border-b bg-blue-900 rounded-xl">
              <?php
                // Check if there is feedback data
                if ($result) {
                  // Loop through each feedback entry and display it in a table row
                  while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                    <td class="px-3 py-2">
                      <p>'. $row['f_id'] .'</p>
                    </td>
                    <td class="px-3 py-2">
                      <p>'. $row['f_content'] .'</p>
                    </td>
                    <td class="px-3 py-2">
                      <p>'. $row['user_id'] .'</p>
                    </td>
                    <td class="px-3 py-2">
                      <p>'. $row['time'] .'</p>
                    </td>
                    <td class="px-3 py-2 text-white text-base">
                    <form action="feedback.php" method="post">
                    <input type="hidden" name="fid" value="'.$row['f_id'].'">

                      <div class="flex flex-row gap-4">
                      <!-- Form for removing feedback -->
                      <input type="submit" name="remove" onclick="return checkDelete(' . $row['f_id'] . ')" value="remove" class="mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-dark shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg" style="background-color: red">
                      </div>
                      </form>
                    </td>
                  </tr>';
                  }
                } else {
                  // If there is no feedback, display a message
                  echo '<h4 style="color: red;">No Feedbacks Available</h4>';
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- JavaScript script for confirming feedback deletion -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    function checkDelete(f_id) {
        if (confirm("Are you sure about that?")) {
            // If the user confirms, proceed with deleting the feedback.
            window.location.href = 'feedback.php';
            return true;
        } else {
            // If the user cancels, do not delete the feedback.
            return false;
        }
    }
    </script>
  </body>
</html>
