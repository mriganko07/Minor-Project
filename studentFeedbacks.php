<?php
// Include necessary files
include 'check_login.php';
include_once 'classes/feedback.php';
?>

<?php
// Create an instance of the Feedback class
$fb = new Feedback();
?>

<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include 'stuInclude/stuHeader.php'; ?>
        <div class="col-sm-6 mt-5 w-75">

        <?php
            // Check if the feedback form has been submitted
            if (isset($_POST['submit'])) {
                // Get feedback content from the form
                $feedback = $_POST['f_content'];
                
                // Call the addFeedback method to handle feedback submission
                $result = $fb->addFeedback($feedback, $user_id);
                
                // Display success or error message based on the result
                if ($result) {
                    echo "<h4 class='text-success ms-5'>Feedback submitted successfully</h4>";
                } else {
                    echo "<h4 class='text-danger ms-5'>Feedback Not submitted</h4>";
                }
            }
        ?>
            
            <form class="mx-5 shadow-lg rounded px-3 py-3" method="post" enctype="multipart/form-data">
                <!-- Hidden input field to store student ID -->
                <input type="hidden" name="student_id" value="<?= $user_id; ?>">
                
                <div class="form-group">
                    <label for="student_id">Name</label>
                    <!-- Display the student name (read-only) -->
                    <input class="form-control" type="text" name="student_name" id="student_name" value="<?= $user_name; ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="f_content">Write Feedback</label>
                    <!-- Textarea for entering feedback content -->
                    <textarea class="form-control" name="f_content" id="f_content" rows="2" required></textarea>
                </div>
                
                <div class="d-flex flex-row justify-content-start my-3">
                    <!-- Submit button to submit the feedback form -->
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary mx-1">
                    
                    <!-- Reset button to clear the form -->
                    <input type="reset" value="Cancel" name="cancel" class="btn btn-danger mx-1">
                </div>
            </form>
        </div>
    </div>
</div>
