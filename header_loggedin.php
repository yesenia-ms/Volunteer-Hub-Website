<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Volunteer Hub</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
	<link rel="stylesheet" href="assets/css/nav_menu.css">
</head>

<body>

    <div id="navbar">
        <div class="container">
			<div class="header">
  				<div id="logo" title="VolunteerHub Logo">
                    <a href="index.php">
                        <img src="images/logo_new.png" alt="The Volunteer Hub Logo click to return to home">
                    </a>
                </div>
  				<div>
   					<a href="./find_volunteer_opportunities.php" aria-label="Find Opportunities" title="Find Opportunities">Find Opportunities</a>
                    <a href="./about_us.php" aria-label="About Us" title="About Us">About Us</a>
                    <a href="./faq.php" aria-label="Frequently Asked Questions" title="Frequently Asked Questions">FAQs</a>
                    <a href="contact_us.php" aria-label="Contact Us" title="Contact Us">Contact Us</a>
  				</div>
			</div>
<!--
            <div id="logo-dropdown-container">
                <div id="dropdown" title="Dropdown menu">
                    <span id="dropdown-icon">&#9776;</span>
                    <div id="dropdown-content" aria-label="Dropdown menu">
                        <a href="./find_volunteer_opportunities.php" aria-label="Find Volunteer Opportunities" title="Find Volunteer Opportunities"><button>Find Volunteer Opportunities</button></a>
                        <a href="./about_us.php" aria-label="About Us" title="About Us"><button>About Us</button></a>
                        <a href="./faq.php" aria-label="Frequently Asked Questions" title="Frequently Asked Questions"><button>FAQs</button></a>
                        <a href="contact_us.php" aria-label="Contact Us" title="Contact Us"><button>Contact Us</button></a>
                    </div>
                </div>
                <div id="logo" title="VolunteerHub Logo">
                    <a href="index.php">
                        <img src="images/logo.png" alt="The Volunteer Hub Logo click to return to home">
                    </a>
                </div>
            </div>
-->
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
	