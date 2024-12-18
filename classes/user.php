<?php

include_once 'database.php';

?>

<?php

// Class for User Operations

class user{
    
    private $conn;

    // Constructor

    public function __construct() {
        
        $this->conn = new database();
        
    }

    // Function for User Signup

    public function addUser( $user_name , $user_email , $user_pass  , $user_cpass , $user_ph , $user_occupation){

        $user_name = $this->conn->db->real_escape_string($user_name);
        $user_email = $this->conn->db->real_escape_string($user_email);
        $user_pass = $this->conn->db->real_escape_string($user_pass);
        $user_cpass = $this->conn->db->real_escape_string($user_cpass);
        $user_ph = $this->conn->db->real_escape_string($user_ph);
        $user_occupation = $this->conn->db->real_escape_string($user_occupation);

        $user_name = htmlspecialchars($user_name, ENT_QUOTES);
        $user_email = htmlspecialchars($user_email, ENT_QUOTES);
        $user_pass = htmlspecialchars($user_pass, ENT_QUOTES);
        $user_cpass = htmlspecialchars($user_cpass, ENT_QUOTES);
        $user_ph = htmlspecialchars($user_ph, ENT_QUOTES);
        $user_occupation = htmlspecialchars($user_occupation, ENT_QUOTES);


        if ($user_pass !== $user_cpass) {
            return false;
        }

        // Check if the user already exists
        $sql = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
        $exists = $this->conn->select($sql);

        if ($exists->num_rows > 0) {
            return false;
        }

        // Hash the password
        $hash = password_hash($user_pass, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql2 = "INSERT INTO `users` (`user_name`, `user_email`, `user_ph`, `user_password`, `user_occupation`, `img_url`) VALUES ('$user_name', '$user_email', '$user_ph', '$hash', '$user_occupation', 'profile.png')";
        $result = $this->conn->insert($sql2);

        if (!$result) {
            return "false";
        }

        return "true";
            


    }

    // Function for User Login

    public function userLogin( $user_input , $user_pass){

        $sql = "SELECT * FROM `users` WHERE `user_email` = '$user_input'";
        
        $result = $this->conn->select($sql);
       
    
        if (!$result) {
            return false; //User not found
        }
        $user = $result->fetch_assoc();
        if(!$user){
            return false;
        }

        if (password_verify($user_pass, $user['user_password'])) {
            
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_email'] = $user['user_email'];
            $_SESSION['loggedin'] = true;
            
            return true; // User Login successfull
        } else {
            return false; // User Login failed
        }

    }

    // Function for getting User Info

    public function getUser($user_id , $action){   

        if($action == "getUser"){
            $sql = "SELECT * FROM `users`";
            $result = $this->conn->select($sql);
            if(!$result){
                return false;
            }
            // Initialize an empty array to store course data
            $user_info = [];
        
            // Fetch all rows and store them in the $course_info array
            while ($row = $result->fetch_assoc()) {
                $user_info[] = $row;
            }
        
            
            return $user_info;
        }

        elseif($action == "getUserById"){
        
            $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
            $result = $this->conn->select($sql);
            if(!$result){
                return false;
            }
            // Initialize an empty array to store course data
            $user_info = [];
        
            // Fetch all rows and store them in the $course_info array
            while ($row = $result->fetch_assoc()) {
                $user_info[] = $row;
            }
        
            
            return $user_info;
        }

    }

    // Function for update user profile image

    public function updateUserImage($user_id , $user_img){
        $sql = "UPDATE `users` SET `img_url`='$user_img' WHERE `user_id`='$user_id'";
        $result = $this->conn->update($sql);

        if(!$result){
            return false;
        }
        else{
            return true;
        }
    }

    // Function for User Account Info Update

    public function editUser($user_id , $user_name , $user_email , $user_ph , $user_occupation){

        $user_name = $this->conn->db->real_escape_string($user_name);
        $user_email = $this->conn->db->real_escape_string($user_email);
        $user_ph = $this->conn->db->real_escape_string($user_ph);
        $user_occupation = $this->conn->db->real_escape_string($user_occupation);

        $user_name = htmlspecialchars($user_name, ENT_QUOTES);
        $user_email = htmlspecialchars($user_email, ENT_QUOTES);
        $user_ph = htmlspecialchars($user_ph, ENT_QUOTES);
        $user_occupation = htmlspecialchars($user_occupation, ENT_QUOTES);

        if(strlen($user_ph) < 10 || strlen($user_ph) > 10){
            return false;
        }

        $sql = "UPDATE `users` SET `user_name`='$user_name',`user_email`='$user_email',`user_ph`='$user_ph',`user_occupation`='$user_occupation' WHERE `user_id` = '$user_id'";
        $result = $this->conn->update($sql);

        if(!$result){
            return false; // User update failed
        }
        else{
            
            return true; // User updated successfully
        }

    }

    // Function for Change Password

    public function changePassword($user_id, $old_pass, $new_pass) {
        $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
        $result = $this->conn->select($sql);
        $user = $result->fetch_assoc();
    
        if (password_verify($old_pass, $user['user_password'])) {
            if ($new_pass !== $old_pass) {
                $hash = password_hash($new_pass, PASSWORD_DEFAULT);
                $sql2 = "UPDATE `users` SET `user_password`='$hash' WHERE `user_id` = '$user_id'";
                $result = $this->conn->update($sql2);
    
                if (!$result) {
                    // Password update failed
                    return false;
                }
    
                return true; // Password updated successfully
            } else {
                // New passwords do not match
                return false;
            }
        } else {
            // Incorrect old password
            return false;
        }
    }

    // Function for Delete User

    public function deleteUser($user_id){

        $sql = "DELETE FROM `users` WHERE `user_id` = '$user_id'";
        $result = $this->conn->delete($sql);

        if(!$result){

            return false;

        }
        else{

            return true;

        }

    }

    public function count(){

        $sql = "SELECT COUNT(*) as user_count FROM `users`";
        $result = $this->conn->select($sql);
        $user_count = 0;

        if ($result) {
        $row = $result->fetch_assoc();
        $user_count = (int)$row['user_count'];

        }
    return $user_count;
}
    

}

?>