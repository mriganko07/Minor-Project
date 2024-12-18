<?php include_once 'database.php'; ?>
<?php
class Course{
    private $database;

    function __construct(){
        $this->database= new database();
    }
    // Add course function
    public function addCourse($courseName, $courseDesc, $courseCategory, $instructorName, $image){

        $courseName = $this->database->db->real_escape_string($courseName);
        $courseDesc = $this->database->db->real_escape_string($courseDesc);
        $courseCategory = $this->database->db->real_escape_string($courseCategory);
        $instructorName = $this->database->db->real_escape_string($instructorName);

        $courseName = htmlspecialchars($courseName, ENT_QUOTES);
        $courseDesc = htmlspecialchars($courseDesc, ENT_QUOTES);
        $courseCategory = htmlspecialchars($courseCategory, ENT_QUOTES);
        $instructorName = htmlspecialchars($instructorName, ENT_QUOTES);

        $insert = "INSERT INTO `courses` (`c_name`, `c_desc`, `c_category`, `instructor_name`, `image_url`, `timestamp`) VALUES ( '$courseName', '$courseDesc', '$courseCategory', '$instructorName','$image', current_timestamp())";
        $courseAdd = $this->database->insert($insert);
        if ($courseAdd) {
            $msg= '<div class="fixed top-0 left-0 right-0 flex items-center justify-center z-50">
            <div class="flex shadow-md gap-6 rounded-lg overflow-hidden divide-x max-w-2xl dark:bg-gray-900 dark:text-gray-100 divide-gray-700">
                    <div class="flex flex-1 flex-col p-4 border-l-8 dark:border-violet-400">
                        <span class="text-2xl">Success</span>
                        <span class="text-xs dark:text-gray-400">Course has been created.</span>
                    </div>
                    <button class="px-4 flex items-center text-xs uppercase tracki dark:text-gray-400 dark:border-gray-700">Dismiss</button>
                </div>
        </div>';
            return $msg;
        }else{
            $msg= '<div class="flex shadow-md gap-6 rounded-lg overflow-hidden divide-x max-w-2xl dark:bg-gray-900 dark:text-gray-100 divide-gray-700">
            <div class="flex flex-1 flex-col p-4 border-l-8 dark:border-violet-400">
                <span class="text-2xl">Error</span>
                <span class="text-xs dark:text-gray-400">Can not create the course.</span>
            </div>
            <button class="px-4 flex items-center text-xs uppercase tracki dark:text-gray-400 dark:border-gray-700">Dismiss</button>
        </div>';
            return $msg;
        }
    }
    // Get Course function
    public function getCourse(){
        $gettingData = "SELECT * FROM `courses` ORDER BY `course_id` DESC";
        $result = $this->database->select($gettingData);  
        return $result;
    }
    // Delete function
    public function deleteCourse($sno){
        $delete = "DELETE FROM `courses` WHERE `course_id`='$sno'";
        $result = $this->database->delete($delete);
    }
    // Get course by id function
    public function getCourseById($id){
        $query = "SELECT * FROM `courses` WHERE `course_id`='$id'";
        $result = $this->database->select($query);
        if(!$result){
            return false;
        }
        return $result;
    }
    // update course function
    public function updateCourse($courseId, $courseName, $courseDesc, $courseCategory, $instructorName){
        $courseName = $this->database->db->real_escape_string($courseName);
        $courseDesc = $this->database->db->real_escape_string($courseDesc);
        $courseCategory = $this->database->db->real_escape_string($courseCategory);
        $instructorName = $this->database->db->real_escape_string($instructorName);

        $courseName = htmlspecialchars($courseName, ENT_QUOTES);
        $courseDesc = htmlspecialchars($courseDesc, ENT_QUOTES);
        $courseCategory = htmlspecialchars($courseCategory, ENT_QUOTES);
        $instructorName = htmlspecialchars($instructorName, ENT_QUOTES);
        

        $update = "UPDATE `courses` SET `c_name` = '$courseName', `c_desc` = '$courseDesc', `c_category`='$courseCategory', `instructor_name`='$instructorName' WHERE `courses`.`course_id` = '$courseId'";
        $courseUpdate = $this->database->update($update);
        if ($courseUpdate) {
            $msg= '<div class="fixed top-0 left-0 right-0 flex items-center justify-center z-50">
            <div class="flex shadow-md gap-6 rounded-lg overflow-hidden divide-x max-w-2xl dark:bg-gray-900 dark:text-gray-100 divide-gray-700">
                    <div class="flex flex-1 flex-col p-4 border-l-8 dark:border-violet-400">
                        <span class="text-2xl">Success</span>
                        <span class="text-xs dark:text-gray-400">Course has been updated.</span>
                    </div>
                    <button class="px-4 flex items-center text-xs uppercase tracki dark:text-gray-400 dark:border-gray-700">Dismiss</button>
                </div>
        </div>';
            return $msg;
        }else{
            $msg= '<div class="flex shadow-md gap-6 rounded-lg overflow-hidden divide-x max-w-2xl dark:bg-gray-900 dark:text-gray-100 divide-gray-700">
            <div class="flex flex-1 flex-col p-4 border-l-8 dark:border-violet-400">
                <span class="text-2xl">Error</span>
                <span class="text-xs dark:text-gray-400">Can not update the course.</span>
            </div>
            <button class="px-4 flex items-center text-xs uppercase tracki dark:text-gray-400 dark:border-gray-700">Dismiss</button>
        </div>';
            return $msg;
        }
    } 
    public function getCourseByLimit(){
        $select = "SELECT * FROM `courses` LIMIT 3";
        $result = $this->database->select($select);
        return $result;
    } 
    public function count(){

        $sql = "SELECT COUNT(*) as course_count FROM `courses`";
        $result = $this->database->select($sql);
        $course_count = 0;

        if ($result) {
        $row = $result->fetch_assoc();
        $course_count = (int)$row['course_count'];

        }
    return $course_count;  
    }
}
?>