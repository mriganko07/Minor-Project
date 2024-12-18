<?php
// Start the session
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] != true) {
  header("location: adminLogin.php");
  exit;
}
?>
<?php
include '../classes/contact.php';
?>
<?php
// Get Contact
$contact = new Contact();
$result = $contact->getContactMassege();
?>
<?php
// Delete
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;


if(isset($_POST['remove'])){
  $contact_id = $_POST['contact_id'];
  $delCheck = $contact->deleteContactMassege($contact_id);
  header("location:contacts.php");
}


?>


<!DOCTYPE html>
<html data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="overflow-x-hidden">
    <!-- Header Connection -->
    <?php include 'header.php'; ?>

    <!-- Main Content -->
    <div class="flex flex-col gap-10 p-10 rounded-xl mx-auto">
        <div class="container rounded-xl sm: text-white sm:rounded-xl">
            <h2 class="mb-4 text-2xl font-semibold leadi">All User Feedback</h2>
            <div class="overflow-x-auto ">
                <table class="w-full p-6 text-left whitespace-nowrap text-base rounded-xl">
                    <thead>
                        <tr class="bg-gray-300 text-black">
                            <th class="p-3">Sno</th>
                            <th class="p-3">Username</th>
                            <th class="p-3">User email</th>
                            <th class="p-3">Contact message</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-b bg-blue-900 rounded-xl">
                        <?php
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                            <td class="px-3 py-2">
                            <p>'. $row['contact_id'] .'</p>
                            </td>
                            <td class="px-3 py-2">
                            <p>'. $row['username'] .'</p>
                            </td>
                            <td class="px-3 py-2">
                            <p>'. $row['mail'] .'</p>
                            </td>
                            <td class="px-3 py-2">
                            <p>'. $row['message'] .'</p>
                            </td>
                            <td class="px-3 py-2 text-white text-base">
                            <form action="contacts.php" method="post">
                            <input type="hidden" name="contact_id" value="'.$row['contact_id'].'">

                            <div class="flex flex-row gap-4">
                            <input type="submit" name="remove" onclick="return checkDelete(' . $row['contact_id'] . ')" value="remove" class="mb-2 flex rounded px-3 py-2.5 text-xs font-medium uppercase leading-normal text-dark shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg" style="background-color: red">

                            
                            </div>
                            </form>
                            
                            </td>
                        </tr>';
                        }
                    }else {
                        echo '<h4 style="color: red;">No Contacts Available</h4>';
                    }
                ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
    <!-- <script src="LessonScript.js"></script> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="ModalScript.js"></script>
    <script>
    function checkDelete(contact_id) {
        if (confirm("Are you sure about that?")) {
            // If the user confirms, proceed with deleting the course.
            window.location.href = 'contacts.php';
            return true;
        } else {
            // If the user cancels, do not delete the course.
            return false;
        }
    }
    </script>

</body>

</html>