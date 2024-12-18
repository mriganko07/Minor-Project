<?php
include_once '../classes/database.php';

class Admin {
    private $database;

    function __construct() {
        $this->database = new database();
    }

    public function adminLogin($adminName, $adminPass) {
        $adminName = $this->database->db->real_escape_string($adminName);
        $adminPass = $this->database->db->real_escape_string($adminPass);

        $sql = "SELECT * FROM `admin` WHERE `admin_name`= '$adminName'";
        $result = $this->database->select($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['admin_password'];

            if ($adminPass == $hashed_password) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['admin_name'] = $adminName;
                header("Location: HomeLayout.php");
                exit();
            } else {
                return '<div class="flex justify-center">
                    <div class="text-red-600 font-bold">Error! Invalid Password or Username</div>
                </div>';
            }
        } else {
            return '<div class="flex justify-center">
                <div class="text-red-600 font-bold">Error! Invalid Password or Username</div>
            </div>';
        }
    }

    public function adminLogout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /CodexLearns/admin/index.php");
        exit();
    }

    public function changePassword($adminName, $adminNewPass) {
        $select = "SELECT * FROM `admin` WHERE `admin_name` = '$adminName'";
        $result = $this->database->select($select);

        if ($adminNewPass == '') {
            return '<div
            class="font-regular relative block w-full rounded-lg bg-red-500 p-4 text-base leading-5 text-white opacity-100"
            data-dismissible="alert"
          >
            <div class="mr-12"><b>Error:</b> Password can not be empty!</div>
            <div
              class="absolute top-2.5 right-3 w-max rounded-lg transition-all hover:bg-white hover:bg-opacity-20"
              data-dismissible-target="alert"
            >
              <button
                role="button"
                class="w-max rounded-lg p-1"
                data-alert-dimissible="true"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                  ></path>
                </svg>
              </button>
            </div>
          </div>';
        }else{
            if ($result && $result->num_rows == 1) {
                $update = "UPDATE `admin` SET `admin_password` = '$adminNewPass'";
                if ($this->database->update($update) === true) {
                    return '<div
                    class="font-regular relative block w-full rounded-lg bg-green-500 p-4 text-base leading-5 text-white opacity-100"
                    data-dismissible="alert"
                  >
                    <div class="mr-12"><b>Success:</b> Your Password Has Been Changed</div>
                    <div
                      class="absolute top-2.5 right-3 w-max rounded-lg transition-all hover:bg-white hover:bg-opacity-20"
                      data-dismissible-target="alert"
                    >
                      <button
                        role="button"
                        class="w-max rounded-lg p-1"
                        data-alert-dimissible="true"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-6 w-6"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                          stroke-width="2"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                          ></path>
                        </svg>
                      </button>
                    </div>
                  </div>';
                } else {
                    return '<div
                    class="font-regular relative block w-full rounded-lg bg-red-500 p-4 text-base leading-5 text-white opacity-100"
                    data-dismissible="alert"
                  >
                    <div class="mr-12"><b>Error:</b> Unable to change your password</div>
                    <div
                      class="absolute top-2.5 right-3 w-max rounded-lg transition-all hover:bg-white hover:bg-opacity-20"
                      data-dismissible-target="alert"
                    >
                      <button
                        role="button"
                        class="w-max rounded-lg p-1"
                        data-alert-dimissible="true"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-6 w-6"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                          stroke-width="2"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                          ></path>
                        </svg>
                      </button>
                    </div>
                  </div>';
                }
            }

        }

        
    }
}
?>