<?php

include_once "database.php";

?>

<?php

class certificate
{

    private $conn;

    // Constructor

    public function __construct()
    {
        $this->conn = new database();
    }

    // Function for Add Certificate

    public function addCertificate($user_id, $user_name, $course_id, $course_name)
    {

        $sql = "SELECT * FROM `certificate` WHERE `user_id` = '$user_id' AND `course_id` = '$course_id'";
        $exists = $this->conn->select($sql);

        if ($exists === null) {

            $sql2 = "INSERT INTO `certificate`(`user_id`, `user_name`, `course_id`, `course_name`) VALUES ('$user_id','$user_name','$course_id','$course_name')";
            $result = $this->conn->insert($sql2);
            if (!$result) {
                return false;
            } else {
                return true;
            }
            return true;
        }

        return true;
    }

    // Function for Get Certificate

    public function getCertificateInfo($user_id, $course_id)
    {

        $sql = "SELECT * FROM `certificate` WHERE `user_id` = '$user_id' AND `course_id` = '$course_id'";
        $exists = $this->conn->select($sql);
        if ($exists) {
            $certificate_info = $exists->fetch_assoc();

            return $certificate_info;
        } else {
            return false;
        }
    }

    // Function for Generating Certificate

    public function generateCertificate($user_name, $course_name, $date, $user_email)
    {
        $font = "certificate_module/ArialTh.ttf";
        $image = imagecreatefromjpeg("certificate_module/certificate.jpg");
        $color = imagecolorallocate($image, 19, 21, 22);

        // Define course_name and date
        $course_name = $course_name;
        $date = $date;

        // Get image dimensions
        $image_width = imagesx($image);
        $image_height = imagesy($image);

        // Calculate text dimensions and positions
        $text_box_user = imagettfbbox(70, 0, $font, $user_name);
        $text_width_user = abs($text_box_user[2] - $text_box_user[0]);
        $x_user = ($image_width - $text_width_user) / 2;

        $text_box_course = imagettfbbox(35, 0, $font, $course_name);
        $text_width_course = abs($text_box_course[2] - $text_box_course[0]);
        $x_course = ($image_width - $text_width_course) / 2;

        $text_box_date = imagettfbbox(40, 0, $font, $date);
        $text_width_date = abs($text_box_date[2] - $text_box_date[0]);

        // Add user_name, course_name, and date to the image
        imagettftext($image, 70, 0, $x_user, 650, $color, $font, $user_name);
        imagettftext($image, 35, 0, $x_course, 875, $color, $font, $course_name);
        imagettftext($image, 40, 0, 1280, 1055, $color, $font, $date);

        // Save the image
        $imageFileName = "certificate/" . $user_email . ".jpg";
        imagejpeg($image, $imageFileName);
        imagedestroy($image);


        require('certificate_module/fpdf.php');
        $pdf = new FPDF('L', 'in', [11.7, 8.27]);
        $pdf->AddPage();
        $pdf->Image($imageFileName, 0, 0, 11.7, 8.27);
        $pdfFileName = "certificate/" . $user_email . ".pdf";
        $pdf->Output($pdfFileName, "F");

        return true;
    }
    // Delete specific orders by their id
    public function deleteCertificate($id, $course_id, $user_id, $action)
    {
        if ($action === "delete") {
            $delete = "DELETE FROM `certificate` WHERE `id`='$id'";
            $result = $this->conn->delete($delete);
            if (!$result) {

                return false;
            } else {
                return true;
            }
        } elseif ($action === "deleteByCourse") {
            $delete = "DELETE FROM `certificate` WHERE `course_id`='$course_id'";
            $result = $this->conn->delete($delete);
            if (!$result) {

                return false;
            } else {

                return true;
            }
        } elseif ($action === "deleteByUser") {
            $delete = "DELETE FROM `certificate` WHERE `user_id`='$user_id'";
            $result = $this->conn->delete($delete);
            if (!$result) {

                return false;
            } else {

                return true;
            }
        }
    }
}

?>





