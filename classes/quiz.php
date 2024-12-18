<?php

include_once "database.php" ;

?>

<?php

//Class for quiz operations

class quiz{

    private $conn;

    //Constructor

    public function __construct(){

        $this->conn = new database();

    }

    //Function for Add Quiz

    public function addQuiz($course_id , $question , $first_ans , $second_ans , $third_ans , $fourth_ans , $org_ans){

        
        $course_id = $this->conn->db->real_escape_string($course_id);
        $question = $this->conn->db->real_escape_string($question);
        $first_ans = $this->conn->db->real_escape_string($first_ans);
        $second_ans = $this->conn->db->real_escape_string($second_ans);
        $third_ans = $this->conn->db->real_escape_string($third_ans);
        $fourth_ans = $this->conn->db->real_escape_string($fourth_ans);
        $org_ans = $this->conn->db->real_escape_string($org_ans);

       
        $course_id = htmlspecialchars($course_id, ENT_QUOTES);
        $question = htmlspecialchars($question, ENT_QUOTES);
        $first_ans = htmlspecialchars($first_ans, ENT_QUOTES);
        $second_ans = htmlspecialchars($second_ans, ENT_QUOTES);
        $third_ans = htmlspecialchars($third_ans, ENT_QUOTES);
        $fourth_ans = htmlspecialchars($fourth_ans, ENT_QUOTES);
        $org_ans = htmlspecialchars($org_ans, ENT_QUOTES);

        $sql = "SELECT * FROM `quiz` WHERE `course_id` = '$course_id' AND `question` = '$question'";
        $exists = $this->conn->select($sql);
        $num = $exists->num_rows;
        
        if($num == 0){

            $sql2 = "INSERT INTO `quiz`(`course_id`, `question`, `first_ans`, `second_ans`, `third_ans`, `fourth_ans`, `orginal_ans`) VALUES ('$course_id','$question','$first_ans','$second_ans','$third_ans','$fourth_ans','$org_ans')";
            $result = $this->conn->insert($sql2);

            if(!$result){

                return false;

            }
            else{

                return true;
            
            }

        }
        return true;

    }

    //Function for Get Quiz

    public function getQuiz($course_id , $quiz_id , $action){


            if($action == "getQuiz"){
                            $sql = "SELECT * FROM `quiz`";
                            $result = $this->conn->select($sql);
                            if(!$result){
                                return false;
                            }
                            // Initialize an empty array to store course data
                            $quiz_info = [];
                        
                            // Fetch all rows and store them in the $course_info array
                            while ($row = $result->fetch_assoc()) {
                                $quiz_info[] = $row;
                            }
                        
                            
                            return $quiz_info;

                        }

            elseif($action == "getQuizByCourse"){
                            $sql = "SELECT * FROM `quiz` WHERE `course_id` = '$course_id'";
                            $result = $this->conn->select($sql);
                            
                            if($result === null){
                                return false;
                            }
                            // Initialize an empty array to store course data
                            $quiz_info = [];
                            
                            // Fetch all rows and store them in the $course_info array
                            while ($row = $result->fetch_assoc()) {
                                $quiz_info[] = $row;
                            }
                            
                            return $quiz_info;
                        }

            elseif($action == "getQuizById"){
                            $sql = "SELECT * FROM `quiz` WHERE `id` = '$quiz_id'";
                            $result = $this->conn->select($sql);
                            
                            if($result === null){
                                return false;
                            }
                            // Initialize an empty array to store course data
                            $quiz_info = [];
                            
                            // Fetch all rows and store them in the $course_info array
                            while ($row = $result->fetch_assoc()) {
                                $quiz_info[] = $row;
                            }
                            
                            return $quiz_info;
                        }
                        return true;

    }

    //Function for Edit Quiz

    public function editQuiz($quiz_id , $course_id , $question , $first_ans , $second_ans , $third_ans , $fourth_ans , $org_ans){


        $quiz_id = $this->conn->db->real_escape_string($quiz_id);
        $course_id = $this->conn->db->real_escape_string($course_id);
        $question = $this->conn->db->real_escape_string($question);
        $first_ans = $this->conn->db->real_escape_string($first_ans);
        $second_ans = $this->conn->db->real_escape_string($second_ans);
        $third_ans = $this->conn->db->real_escape_string($third_ans);
        $fourth_ans = $this->conn->db->real_escape_string($fourth_ans);
        $org_ans = $this->conn->db->real_escape_string($org_ans);

        $question = htmlspecialchars($question, ENT_QUOTES);
        $first_ans = htmlspecialchars($first_ans, ENT_QUOTES);
        $second_ans = htmlspecialchars($second_ans, ENT_QUOTES);
        $third_ans = htmlspecialchars($third_ans, ENT_QUOTES);
        $fourth_ans = htmlspecialchars($fourth_ans, ENT_QUOTES);
        $org_ans = htmlspecialchars($org_ans, ENT_QUOTES);

        $sql = "UPDATE `quiz` SET `question`='$question',`first_ans`='$first_ans',`second_ans`='$second_ans',`third_ans`='$third_ans',`fourth_ans`='$fourth_ans',`orginal_ans`='$org_ans' WHERE `id` = '$quiz_id'";
        $result = $this->conn->update($sql);

        if(!$result){

            return false;

        }
        else{

            return true;

        }

    }

    //Function for Delete Quiz by Id

    public function deleteQuiz($quiz_id){
        $sql = "DELETE FROM `quiz` WHERE `id` = '$quiz_id'";
        $result = $this->conn->delete($sql);

        if(!$result){

            return false;

        }
        else{

            return true;

        }
    

    }



    //Function for Check Quiz

    function checkQuiz($course_id, $user_answers) {
        $correct = 0;
        $wrong = 0;
        $attemptedQuestion = [];
        $notAttempted = 0;

        $sql = "SELECT COUNT(*) as total_questions FROM `quiz` WHERE `course_id` = '$course_id'";
        $result = $this->conn->select($sql);
        $totalQuestion = 0;

    if ($result) {
        $row = $result->fetch_assoc();
        $totalQuestion = (int)$row['total_questions'];
    }
    
        foreach ($user_answers as $question_id => $user_answer) {
            // Fetch the correct answer from the database
            $sql = "SELECT `orginal_ans` FROM `quiz` WHERE `id` = '$question_id'";
            $result = $this->conn->select($sql);
    
            if ($result) {
                $row = $result->fetch_assoc();
                $correct_answer = html_entity_decode($row['orginal_ans']);
                $user_answer = html_entity_decode($user_answer);
                
                // Check if the user's answer is correct
                if ($correct_answer === $user_answer ) {
                    $correct++;
                } else {
                    $wrong++;
                }
                $attemptedQuestion[] = $question_id;
            }
        }

    
        $notAttempted = $totalQuestion - count($attemptedQuestion);
        $percentage = ($totalQuestion > 0) ? number_format(($correct / $totalQuestion) * 100, 2) : 0;
    
        $results = [
            'correct' => $correct,
            'wrong' => $wrong,
            'totalQuestion' => $totalQuestion,
            'attempted' => count($attemptedQuestion),
            'notAttempted' => $notAttempted,
            'percentage' => $percentage,
        ];
    
        return $results;
    }
    public function count(){

        $sql = "SELECT COUNT(*) as quiz_count FROM `quiz`";
        $result = $this->conn->select($sql);
        $quiz_count = 0;

        if ($result) {
        $row = $result->fetch_assoc();
        $quiz_count = (int)$row['quiz_count'];
        }
    return $quiz_count;  
    }
    


}


?>