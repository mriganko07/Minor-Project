<?php
// Start the session
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin']!=true) {
  header("location: adminLogin.php");
  exit;
}
?>
<?php include '../classes/admin.php'; ?>
<?php
$adminName = $_SESSION['admin_name'];
$acp = new Admin();
?>
<?php
// Check if 'newpass' is set in the POST array before trying to access it
if (isset($_POST['newpass'])) {
    $admiNewPass = $_POST['newpass'];
    
    if (isset($_POST['update'])) {
        $changePasswordCheck = $acp->changePassword($adminName, $admiNewPass);
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
    <style>
    .button {
        width: 100%;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        font-weight: 500;
        color: white;
        background-color: #4f46e5;
        /* Replace with your desired color */
        border: 2px solid #4f46e5;
        /* Replace with your desired color */
        border-radius: 0.5rem;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .button:hover {
        background-color: #4338ca;
        /* Replace with your desired hover color */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* If you want to add space between text and an icon */
    .button .icon {
        margin-right: 0.5rem;
        /* Adjust as needed */
    }
    </style>
</head>

<body>
    <?php
// Check if 'newpass' is set in the POST array before trying to access it
if (isset($_POST['newpass'])) {
    $admiNewPass = $_POST['newpass'];
    
    if (isset($_POST['update'])) {
        $changePasswordCheck = $acp->changePassword($adminName, $admiNewPass);
    }
}
?>
    <?php
        include "header.php";
    ?>
    <div class="sm:w-full flex justify-center items-center">
        <div class="sm:max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300  w-[80%]">
            <h1 class="text-4xl font-bold text-black w-1/4">Reset Password</h1>
            <p class="text-slate-500">Fill out the form to reset your password</p>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="my-10">
                <div class="space-y-5">
                    <div>
                        <label for="email" class="font-medium text-slate-700 pb-2">Admin Name</label>
                        <input id="email" name="email" type="email"
                            class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-blue-500 hover:shadow"
                            placeholder="Enter email address" value="<?php  echo $adminName; ?>"
                            aria-describedby="emailHelp" readonly />
                    </div>
                    <div>
                        <label for="newPassword" class="font-medium text-slate-700 pb-2">New Password</label>
                        <input id="newPassword" name="newpass" type="password"
                            class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-blue-500 hover:shadow"
                            placeholder="Enter your new password" />
                    </div>

                    <input type="submit" class="button btn bg-blue-500 hover:bg-blue-800" value="Reset Password"
                        name="update">

                </div>
                <?php
                  if (isset($changePasswordCheck)) {
                    echo $changePasswordCheck;
                  }
                
                
                ?>
                
            </form>

        </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>