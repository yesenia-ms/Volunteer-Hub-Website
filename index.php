<?php
session_start();  
include ("header_loggedin.php");
?>
<link rel="stylesheet" href="assets/css/index-page.css">
<style>
	.img_volunteer{
		border: 1px solid #ddd;
  		border-radius: 4px;
  		padding: 5px;
  		width: 50%;
	}
</style>

    <div class="container">
        <div class="centered-text">
			<img class="img_volunteer" src="images/volunteer_group_happy.jpeg" alt="Image of Happy Volunteers">
            <p>Welcome to Volunteer Hub!</p>
            <p>We are dedicated to connecting volunteers with meaningful opportunities to make a positive impact on their communities.</p>
            <p>Join us in making a difference! <a style="color: green;" href="signup.php">Join Today</a></p>
        </div>
    </div>

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>

</body>
</html>
