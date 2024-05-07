<?php
session_start();  
include("header_loggedin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Volunteer Hub</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="assets/css/faq.css">
</head>

<body>

<!--
        <div id="header">
        <div >
			<div class="header">
  				<div id="logo" title="VolunteerHub Logo">
                    <a href="index.php">
                        <img src="images/logo.png" alt="The Volunteer Hub Logo click to return to home">
                    </a>
                </div>
  				<div>
   					<a href="./find_volunteer_opportunities.php" aria-label="Find Opportunities" title="Find Opportunities">Find Opportunities</a>
                    <a href="./about_us.php" aria-label="About Us" title="About Us">About Us</a>
                    <a href="./faq.php" aria-label="Frequently Asked Questions" title="Frequently Asked Questions">FAQs</a>
                    <a href="contact_us.php" aria-label="Contact Us" title="Contact Us">Contact Us</a>
  				</div>
			</div>

            <div id="buttons">
                <?php if (!isset($_SESSION['user_id']) && !isset($_SESSION['org_id'])): ?>
                    <a href="./signup.php"><button>Sign Up</button></a>
                    <a href="./signin.php"><button>Log In</button></a>
                <?php else: ?>
                    <div class="dropdown">
                        <img src="./images/profile_icon.png" alt="Icon Image" id="dropdownIcon">
                        <div class="dropdown-content" id="dropdownContent">
                            <?php if (isset($_SESSION['org_id'])): ?>
                                <a href="./organization_dashboard.php">Dashboard</a>
                            <?php else: ?>
                                <a href="./dashboard.php">Dashboard</a>
                            <?php endif; ?>
                            <a href="account_settings.php">Account Settings</a>
                            <a href="./logout.php">Logout</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
-->
    
    <div class="faq-text">
        <h2 style="color: green;">FAQs for Volunteer Hub</h2>
        <h5 style="color: green;">1. How do I sign up to volunteer?</h5>
        <p>To sign up, simply create an account on our website, browse through the list of available
            volunteer opportunities, and click 'Register' for the opportunity you choose.
            You'll receive a confirmation once you're successfully registered.</p>
        <h5 style="color: green;">2. What types of volunteer opportunities are available?</h5>
        <p>We offer a diverse range of volunteering opportunities across various sectors, including
            environmental, educational, health, community development, and many more, to suit
            different interests and skill sets.</p>
        <h5 style="color: green;">3. Is there a minimum commitment required?</h5>
        <p>Each volunteer opportunity has its own set of requirements, including time commitment,
            which will be clearly stated on the opportunity page. Some events may require a one-time
            involvement, while others might need a longer-term commitment.</p>
        <h5 style="color: green;">4. Do I need any special skills to volunteer?</h5>
        <p>While some opportunities may require specific skills, many do not and are open to
            everyone. Skill requirements, if any, will be detailed in the event's description.</p>
        <h5 style="color: green;">5. Can I cancel my registration for an event?</h5>
        <p>Yes, you can cancel your registration directly from your dashboard. Please try to cancel as
            early as possible to allow others the opportunity to participate.</p>
        <h5 style="color: green;">6. How do I change my account information?</h5>
        <p>You can update your account information at any time by logging in to your profile and
            accessing the 'Account Settings' option.</p>
        <h5 style="color: green;">7. What happens if an event is canceled?</h5>
        <p>In the rare case that an event is canceled, you will be notified via email and will see the
            cancellation on your dashboard. We will do our best to suggest alternative opportunities.</p>
        <h5 style="color: green;">8. How can my organization list volunteer opportunities on Volunteer Hub?</h5>
        <p>Organizations can register on our platform and submit their volunteer opportunities by using
            the 'Post Event' in their dashboard</p>
    </div>
    
    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>

</body>

</html>
