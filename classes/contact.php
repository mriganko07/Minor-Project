<?php include_once 'database.php'; ?>
<?php
// Define a class named Contact
class Contact{
     // Private property to store the database instance
    private $database;

// Constructor method, initializes the database instance
    function __construct(){
        $this->database= new database();
    }

    // Add contacts
    // Method to add contact messages to the database
    public function addContactMassege($name , $email , $message){

         // Sanitize input data to prevent SQL injection
        $name = $this->database->db->real_escape_string($name);
        $email= $this->database->db->real_escape_string($email);
        $message = $this->database->db->real_escape_string($message);

// Sanitize data for HTML output
        $name = htmlspecialchars($name, ENT_QUOTES);
        $email = htmlspecialchars($email, ENT_QUOTES);
        $message = htmlspecialchars($message, ENT_QUOTES);

// Construct SQL INSERT query
        $insert = "INSERT INTO contact(`username`, `mail`, `message`) VALUES ('$name','$email','$message')";
        
        // Execute the query using the database class's insert method
        $contentAdd = $this->database->insert($insert);

        // Return true if insertion is successful, otherwise false
        if ($contentAdd) {
            return true;
        }else{
            return false;
        }
    }
    // Get contacts
    // Method to retrieve all contact messages from the database
    public function getContactMassege(){
        // Construct SQL SELECT query
        $select = "SELECT * from contact";
        // Execute the query using the database class's select method
        $result = $this->database->select($select);

        // Return the result of the query
        return $result;
    }

     // Method to delete contact messages from the database based on ID
    public function deleteContactMassege($id){
         // Construct SQL DELETE query
        $delete = "DELETE FROM contact WHERE contact_id = '$id'";
         // Execute the query using the database class's delete method
        $result = $this->database->delete($delete);
}


}



?>