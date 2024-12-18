<?php include_once 'database.php'; ?>

<?php
// Feedback class definition
class Feedback{
    // Database connection instance
    private $database;

    // Constructor to initialize the database connection
    function __construct(){
        $this->database = new database();
    }

    // Add feedbacks to the database
    public function addFeedback($feedbackcontent, $userId){
        // Escape and sanitize input to prevent SQL injection and cross-site scripting (XSS)
        $feedbackcontent = $this->database->db->real_escape_string($feedbackcontent);
        $feedbackcontent = htmlspecialchars($feedbackcontent, ENT_QUOTES);

        // SQL query to insert feedback into the database
        $insert = "INSERT INTO `feedbacks` (`f_content`, `user_id`) VALUES ('$feedbackcontent', '$userId')";
        
        // Call the database insert method and check if the operation was successful
        $feedbackAdd = $this->database->insert($insert);

        // Return true if the feedback was successfully added, false otherwise
        if ($feedbackAdd) {
            return true;
        } else {
            return false;
        }
    }

    // Get all feedbacks from the database
    public function getFeedback(){
        // SQL query to select all feedbacks
        $select = "SELECT * FROM `feedbacks`";

        // Call the database select method and return the result
        $result = $this->database->select($select);
        return $result;
    }

    // Delete a specific feedback by its ID
    public function deleteFeedback($fid){
        // SQL query to delete a feedback by its ID
        $delete = "DELETE FROM `feedbacks` WHERE `f_id` = '$fid'";
        

        // Call the database delete method
        return $result = $this->database->delete($delete);
    }

    // Count the total number of feedbacks in the database
    public function count(){
        // SQL query to count the number of feedbacks
        $sql = "SELECT COUNT(*) as feedback_count FROM `feedbacks`";

        // Call the database select method to get the count result
        $result = $this->database->select($sql);
        $feedback_count = 0;

        // Check if the result is valid and retrieve the count value
        if ($result) {
            $row = $result->fetch_assoc();
            $feedback_count = (int)$row['feedback_count'];
        }

        // Return the total count of feedbacks
        return $feedback_count;
    }
}
?>
