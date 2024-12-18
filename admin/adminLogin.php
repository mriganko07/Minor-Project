<?php include '../classes/admin.php'; ?>
<?php
    $al = new Admin();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['sign_in'])) {
        $adminName = $_POST['adminName'];
        $adminPass = $_POST['adminPassword'];

        $loginCheck = $al->adminLogin($adminName, $adminPass);
    }
?>



<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.3/dist/full.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-base-300">
    <div class="h-screen flex items-center justify-center">
      <div
        class="w-full max-w-sm p-6 m-auto mx-auto bg-white rounded-lg shadow-lg">
        <div class="flex justify-center mx-auto">
          <h3 class="font-semibold text-dark text-lg">Admin Login</h3>
        </div>
        <!-- Start Form -->
        <form class="mt-6 rounded-md" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
          <div>
            <label
              for="adminName"
              class="block text-sm text-gray-800 dark:text-gray-200"
              >Username</label
            >
            <input
              type="text"
              class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" name="adminName" />
          </div>

          <div class="mt-4">
            <div class="flex items-center justify-between">
              <label
                for="forgotPass"
                class="block text-sm text-gray-800 dark:text-gray-200"
                >Password</label
              >
              <a
                href="#"
                class="text-xs text-gray-600 dark:text-gray-400 hover:underline"
                >Forgot Password?</a
              >
            </div>

            <input
              type="password"
              class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" name="adminPassword" />
          </div>

          <div class="mt-6">
            <input type="submit"
              class="w-full px-6 py-2.5 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50" name ="sign_in" value="Sign in"/>
          </div>
          <?php
            if (isset($loginCheck)) {
              echo $loginCheck;
            }
          ?>
        </form><!-- Form End -->
      </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
  </body>
</html>