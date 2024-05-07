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
    <link rel="stylesheet" href="assets/css/about-us.css">
</head>

<body>

<!--
    <div id="header">
        <div class="container">
            <div id="logo-dropdown-container">
                <div id="dropdown">
                    <span id="dropdown-icon">&#9776;</span>
                    <div id="dropdown-content">
                     <a href="./find_volunteer_opportunities.php"><button>Find Volunteer Opportunities</button></a>
                        <a href="./about_us.php"><button>About Us</button></a>
                        <a href="./faq.php"><button>FAQs</button></a>
                        <a href="./contact_us.php"><button>Contact Us</button></a>
                    </div>
                </div>
                <div id="logo">
                    <a href="index.php">
                        <img src="images/logo.png" alt="The Volunteer Hub Logo click to return to home">
                    </a>
                </div>
            </div>
            <div id="buttons">
                <?php if (!isset($_SESSION['user_id']) && !isset($_SESSION['org_id'])): ?>
                    <a href="./signup.php"><button>Sign Up</button></a>
                    <a href="./signin.php"><button>Sign In</button></a>
                <?php else: ?>
                    <div class="dropdown">
                        <img src="./images/profile_icon.png" alt="Icon Image" id="dropdownIcon">
                        <div class="dropdown-content" id="dropdownContent">
                            <?php if (isset($_SESSION['org_id'])): ?>
                                <a href="./organization_dashboard.php">Dashboard</a>
                            <?php else: ?>
                                <a href="./dashboard.php">Dashboard</a>
                            <?php endif; ?>
                            <a href="./Account_Settings.html">Account Settings</a>
                            <a href="./logout.php">Logout</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
-->
    
    <div class="about-text">
        <h2 style="color: green;">About Us</h2>
        <p>Welcome to Volunteer Hub, where passion meets purpose. Born from a desire to make volunteering accessible and meaningful for everyone, Volunteer Hub is a dynamic web application that connects volunteers with opportunities to make a difference in their communities. Our platform is the bridge between individuals eager to contribute their time and skills and organizations in need of passionate volunteers. At Volunteer Hub, we believe that by simplifying the process of finding and registering for volunteer opportunities, we can unlock the potential of countless individuals to serve and positively impact society.</p>
        <h3 style="color: green;">Mission</h3>
        <p>Our mission is to empower individuals and organizations to create meaningful impact through community engagement. We aim to provide a seamless platform that connects volunteers with opportunities that match their interests and schedules. By simplifying the process of finding and participating in volunteer work, we aspire to inspire a movement of active, informed, and dedicated community contributors.</p>
        <h3 style="color: green;">Purpose</h3>
        <p>To make volunteering accessible and rewarding for everyone, removing barriers to participation and empowering individuals to contribute to their communities.</p>
        <h3 style="color: green;">Vision</h3>
        <p>A world where everyone engages in volunteerism, fostering a universal culture of service that strengthens communities and creates positive social change.</p>
    </div>
    

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>

</body>

</html>
