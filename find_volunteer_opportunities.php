<?php
session_start();
require_once('database.php');
include ("header_loggedin.php");

$dblink = db_connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Volunteer Hub</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="assets/css/find_volunteer_opportunities.css">
	<link rel="stylesheet" href="assets/css/images.css">
</head>
<body>
<!--
    <div id="header">
        <div>
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

    <div class="container">
        <div class="centered-text">
            <h3>Find Volunteer Opportunity</h3>
            <form method="post" action="filter_event.php">
                <div class="green-area">
                    <div class="search-container">
                        <input type="text" id="keyword" name="keyword" placeholder="Search by organization name">
                        <button type="button" class="search-button" id="filter" name="filter">Search</button>
                    </div> 
                </div>
            </form> 
            <div class="results-area">
                <?php
                $sql = "SELECT events.*, organizations.name AS org_name, events.start_time, events.end_time FROM events INNER JOIN organizations ON events.org_id = organizations.org_id";
                $res = $dblink->query($sql) or die("<p>Something went wrong with $sql<br>".$dblink->error);
                if($res->num_rows > 0){
                    while($row = $res->fetch_array(MYSQLI_ASSOC)){
                        echo "<div class='opportunity'>";
                        echo "<form method='post' action='register_event.php'>";
                        echo "<input type='hidden' name='event_id' value='" . $row['event_id'] . "'>";
                        echo "<input type='hidden' name='org_id' value='" . $row['org_id'] . "'>";
						if(stristr($row['event_name'], "tree")){
							echo '<img class="img_volunteer" src="images/plant_trees.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "clean")){
							echo '<img class="img_volunteer" src="images/clean_up_community.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "charity")){
							echo '<img class="img_volunteer" src="images/charity_center_happy.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "food")){
							echo '<img class="img_volunteer" src="images/food_bank_happy.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "cloth")){
							echo '<img class="img_volunteer" src="images/clothes_box_happy.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "kitchen")){
							echo '<img class="img_volunteer" src="images/kitchen_volunteer.jpeg" alt="Responsive image">';
						}
						else{
							echo '<img class="img_volunteer" src="images/volunteer_group_happy.jpeg" alt="Responsive image">';
						}
                        echo "<p><strong>Event Name:</strong> " . htmlspecialchars($row['event_name']) . "</p>";
                        echo "<p><strong>Organization:</strong> " . htmlspecialchars($row['org_name']) . "</p>";
                        echo "<p><strong>Task:</strong> " . htmlspecialchars($row['task']) . "</p>";
                        echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
                        echo "<p><strong>Start Time:</strong> " . htmlspecialchars($row['start_time']) . "</p>";
                        echo "<p><strong>End Time:</strong> " . htmlspecialchars($row['end_time']) . "</p>";
                        echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
                        if (isset($_SESSION['user_id'])) {
                            echo "<button type='submit' class='search-button' name='register'>Register</button>";
                        } else {
                            echo "<button type='button' onclick=\"location.href='signin.php'\" class='search-button'>Register</button>";
                        }
                        echo "</form>";
                        echo "</div>";            
                    }
                } else {
                    echo "<p>No entries found.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>

    <script>
    document.getElementById("filter").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        filterEvents(); // Call the filterEvents function to handle the form submission
    });

    function filterEvents() {
        var keyword = document.getElementById("keyword").value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "filter_event.php?keyword=" + encodeURIComponent(keyword), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementsByClassName("results-area")[0].innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
    </script>
</body>
</html>
