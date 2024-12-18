<?php
// Start a session
session_start();

?>
<?php
// Include the Contact class file
include_once "classes/contact.php";

// Create an instance of the Contact class
$contact = new contact();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/contact.css" />
  </head>
  <body>



    <?php
    // Check if the form is submitted
    if(isset($_POST['submit_query'])){

       // Retrieve form data
      $name = $_POST['name'];
      $email = $_POST['email'];
      $message = $_POST['message'];     

     // Call the addContactMassege method from the Contact class
      // and display an alert based on the result
      if($contact->addContactMassege($name , $email , $message )){
        echo "<script> alert('Your contact message has been recived.');</script>";
      }
      else{
        echo "<script> alert('Task failed! Try again.');</script>";
      }
    }
    

  ?>
   <!-- HTML structure for the contact form -->
    <div class="container">
      <div class="form">
        <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>
          <p class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe
            dolorum adipisci recusandae praesentium dicta!
          </p>

             <!-- Contact information -->
          <div class="info">
            <div class="information">
              <img src="img/location.png" class="icon" alt="" />
              <p>92 Cherry Drive Uniondale, NY 11553</p>
            </div>
            <div class="information">
              <img src="img/email.png" class="icon" alt="" />
              <p>lorem@ipsum.com</p>
            </div>
            <div class="information">
              <img src="img/phone.png" class="icon" alt="" />
              <p>123-456-789</p>
            </div>
          </div>
           <!-- Social media links -->
          <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
        </div>
            <!-- Contact form -->
        <div class="contact-form">
          <span class="circle two"></span>
           
          <!-- Form for user input -->
          <form action="contact.php" method="post" autocomplete="off">
            <h3 class="title">Contact us</h3>
            <div class="input-container">
              <!-- <label for="name">Your name</label> -->
              <input type="text" name="name" class="input" placeholder="Name" id="name" required/>
            </div>
            <div class="input-container">
            <!-- <label for="email">Your mail</label> -->
              <input type="email" name="email" class="input" placeholder="email" id="email" required/>
            </div>
            <div class="input-container textarea">
            <!-- <label for="message">Your message</label> -->
              <textarea name="message" class="input" id="message" placeholder="describe" required></textarea>
            </div>
            <input type="submit" name="submit_query" value="Send" class="btn" />
          </form>
        </div>
      </div>
    </div>
    
  </body>
</html>