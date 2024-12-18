<?php

include_once "database.php" ;

?>
<?php
class Lesson{
    private $database;

    function __construct(){
        $this->database= new database();
    }
    // Get course by it's ID
    public function getCourseId(){
        $select = "SELECT `course_id` FROM `courses`";
        $result = $this->database->select($select);
        return $result;
    }
    // Get lessons by course-ID
    public function getLessonByCheckId($checkId){
        $select = "SELECT * FROM `lessons` WHERE `course_id`='$checkId'";
        $result = $this->database->select($select);
        return $result;
    }
    // Add Lessons
    public function addLesson($lessonName, $lessonDesc, $relative_link_directory, $c_id, $c_name){
        if ($lessonName === '' || $lessonDesc === '' || $relative_link_directory === '' || $c_id === '' || $c_name === '') {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> All fields are required.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        } else {
            $lessonName = $this->database->db->real_escape_string($lessonName);
            $lessonDesc = $this->database->db->real_escape_string($lessonDesc);
            $relative_link_directory = $this->database->db->real_escape_string($relative_link_directory);

            $lessonName = htmlspecialchars($lessonName, ENT_QUOTES);
            $lessonDesc = htmlspecialchars($lessonDesc, ENT_QUOTES);
            $relative_link_directory = htmlspecialchars($relative_link_directory, ENT_QUOTES);
            
            $insert = "INSERT INTO `lessons`(`lesson_name`, `lesson_desc`, `lesson_link`, `course_id`, `course_name`) VALUES ('$lessonName','$lessonDesc','$relative_link_directory','$c_id','$c_name')";
            
            $lessonAdd = $this->database->insert($insert);
            
            if ($lessonAdd) {
                $msg = '<div class="fixed top-0 left-0 right-0 flex items-center justify-center z-50">
                <div class="flex shadow-md gap-6 rounded-lg overflow-hidden divide-x max-w-2xl dark:bg-gray-900 dark:text-gray-100 divide-gray-700">
                        <div class="flex flex-1 flex-col p-4 border-l-8 dark:border-violet-400">
                            <span class="text-2xl">Success</span>
                            <span class="text-xs dark:text-gray-400">Lesson has been created.</span>
                        </div>
                        <button class="px-4 flex items-center text-xs uppercase tracki dark:text-gray-400 dark:border-gray-700">Dismiss</button>
                    </div>
            </div>';
            } else {
                $msg = '<div class="fixed top-0 left-0 right-0 flex items-center justify-center z-50 mt-10">
                <div class="flex shadow-md gap-6 rounded-lg overflow-hidden divide-x max-w-2xl dark:bg-gray-900 dark:text-gray-100 divide-gray-700">
                        <div class="flex flex-1 flex-col p-4 border-l-8 dark:border-violet-400">
                            <span class="text-2xl">Error</span>
                            <span class="text-xs dark:text-gray-400">Lesson can not created.</span>
                        </div>
                        <button class="px-4 flex items-center text-xs uppercase tracki dark:text-gray-400 dark:border-gray-700">Dismiss</button>
                    </div>
            </div>';
            }
        }
        
        return $msg;
    }
    // Delete lesson by lesson-ID
    public function deleteLesson($lessonId){
            $delete = "DELETE FROM `lessons` WHERE `lesson_id`='$lessonId'";
            $result = $this->database->delete($delete);
        return $result; 
    }
    // Get lesson by lesson-ID
    public function getLessonById($lessonId){
        $query = "SELECT * FROM `lessons` WHERE `lesson_id`='$lessonId'";
        $result = $this->database->select($query);
        return $result;
    }
    // Edit Lesson by lesson-ID
    public function editLesson($lessonId, $lessonName, $lessonDesc, $lessonLink){
        $lessonName = $this->database->db->real_escape_string($lessonName);
        $lessonDesc = $this->database->db->real_escape_string($lessonDesc);
        $lessonLink = $this->database->db->real_escape_string($lessonLink);

        $lessonName = htmlspecialchars($lessonName);
        $lessonDesc = htmlspecialchars($lessonDesc);
        $lessonLink = htmlspecialchars($lessonLink);

        $update = "UPDATE `lessons` SET `lesson_name` = '$lessonName', `lesson_desc` = '$lessonDesc', `lesson_link`='$lessonLink' WHERE `lessons`.`lesson_id` = '$lessonId'";
        $courseUpdate = $this->database->update($update);
    }
}
?>