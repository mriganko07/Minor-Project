<?php

include_once 'database.php';

?>
<?php
class Order{
    private $database;

    function __construct(){
        $this->database= new database();
    }
    // Create Order function
    public function createOrders($razorpay_order_id, $razorpay_payment_id, $email, $price, $course_id){
        $insert = "INSERT INTO `orders` (`order_id`, `razorpay_payment_id`, `status`, `course_id`, `email`, `price`, `order_date`) VALUES ('$razorpay_order_id', '$razorpay_payment_id', 'success',  '$course_id', '$email', '$price', current_timestamp())";
        $result = $this->database->insert($insert);
        if ($result) {
            return '<p>Your payment was successful</p>';
        }else{
            return '<p>Your payment was failed</p>';
        }
    }
    // Get user purchased course
    public function getPurchasedCourse($user_email){
        $select = 
        "SELECT o.order_id, c.course_id, c.c_name, c.instructor_name, c.c_desc, c.image_url
        FROM orders o
        JOIN courses c ON c.course_id = o.course_id
        WHERE o.email = '$user_email';
        ";
        $result = $this->database->select($select);
        return $result;
    }
    // Get all orders by the users
    public function getOrders(){
        $select = "SELECT * FROM orders";
        $result = $this->database->select($select);
        return $result;
    }
    // Delete specific orders by their id
    public function deleteOrders($order_id , $user_email , $action){
        if($action === "delete"){
            $delete = "DELETE FROM `orders` WHERE `id`='$order_id'";
            $result = $this->database->delete($delete);
            if(!$result){
    
                return false;
    
            }
            else{
    
                return true;
    
            }
        }
        elseif($action === "deleteByUser"){
            $delete = "DELETE FROM `orders` WHERE `email`='$user_email'";
        $result = $this->database->delete($delete);
        if(!$result){

            return false;

        }
        else{

            return true;

        }

        }
        
    }
    // Check a user is enrolled or not 
    public function isEnrolled($course_id, $user_email){
        $checkOrder = "SELECT * FROM `orders` WHERE `course_id`='$course_id' AND `email`='$user_email' AND `status`='success'";
        $result = $this->database->select($checkOrder);
        return $result;
        
    }
    // Count the orders
    public function count(){

        $sql = "SELECT COUNT(*) as order_count FROM `orders`";
        $result = $this->database->select($sql);
        $order_count = 0;

        if ($result) {
        $row = $result->fetch_assoc();
        $order_count = (int)$row['order_count'];

        }
    return $order_count;  
    }

}



?>