<?php
session_start();
include ("header_loggedin.php");

$success_message = "";
$error_message = "";

if(isset($_POST['Send'])) {
    $success_message = "Your message has been submitted successfully!";
}
?>
<link rel="stylesheet" href="assets/css/contact_us.css">
    <div class="container">
		<?php if(isset($success_message)): ?>
        	<div id="successMessage" class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
    	<?php endif; ?>
    	<?php if(isset($error_message)): ?>
        	<div id="errorMessage" class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
    	<?php endif; ?>
        <form method="post" id="contactForm">
            <h1 class="signup-heading">Contact Us</h1>
      
		<div class="col-sm-12">
			<div id="topdivFirst" class="form-group">
				<label class="control-label" for="firstname">First Name:</label>
				<input type="text" class="form-control" id="First Name" name="firstname" required>
				<div id="firstnameFeedback"></div>
			</div>
		</div>

        <div class="col-sm-12"> 
            <div id="topdivLast" class="form-group">
                <label class="control-label" for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="Last Name" name="lastname" required>
                <div id="lastnameFeedback"></div>
            </div>
        </div>
			
		<div class="col-sm-12">
				<div id="topdivEmail" class="form-group">
                	<label class="control-label" for="email">Email:</label>
                	<input type="email" class="form-control" id="Email" name="email" required>
					<div id="emailfeedback"></div>
				</div>
            </div>
			
		<div class="col-sm-12">
             	<div id="topdivMessage" class="form-group">
                    <label class="control-label" for="message">Message:</label>
					<input class="form-control" id="Message" name="message" required>
					<div id="messageFeedback"></div>
                </div>
        </div>

        <div class="col-sm-12">
            <div class="single-contact-btn">
                <input type="button" value="Send" onclick="setMessage()"/> 
            </div>
        </div>
        
        </form>
        
    </div>
<br><br><br><br>
<?php
include ("footer.php");
?>
<script src="assets/js/contact_us.js"></script>
<script>
function setMessage() {
    document.getElementById('action').value = 'message';
    document.getElementById('contactForm').submit();
}
document.addEventListener('DOMContentLoaded', function () {
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');

    if (successMessage) {
        successMessage.style.display = 'block';
        setTimeout(() => { successMessage.style.display = 'none'; }, 2000); 
    }

    if (errorMessage) {
        errorMessage.style.display = 'block';
        setTimeout(() => { errorMessage.style.display = 'none'; }, 2000);
    }
});
</script>
