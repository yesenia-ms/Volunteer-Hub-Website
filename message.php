<?php
require_once 'database.php'; 
$dblink = db_connect();

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    $sql = "SELECT events.*, organizations.name AS org_name, events.start_time, events.end_time FROM event_history INNER JOIN events ON event_history.event_id = events.event_id INNER JOIN organizations ON events.org_id = organizations.org_id WHERE events.event_id = ?";
    $stmt = $dblink->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $event_name = htmlspecialchars($row['event_name']);
		$org_name = htmlspecialchars($row['org_name']);// Sanitize event_name
    } else {
        // Handle case where no event is found with the specified ID
        echo "No event found with the specified ID.";
        exit; // Stop further execution
    }
} else {
    // Handle case where event_id is not set
    echo "No event ID specified.";
    exit; // Stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Volunteer Hub</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

    <div id="header">
        <div id="logo-dropdown-container">
            <div id="dropdown">
                <span id="dropdown-icon">&#9776;</span>
                <div id="dropdown-content">
                    <a href="./find_volunteer_opportunities.php"><button>Find Volunteer Opportunities</button></a>
                    <a href="./about_us.php"><button>About Us</button></a>
                    <a href="./faq.php"><button>FAQs</button></a>
                    <a href="contact_us.php"><button>Contact Us</button></a>
                </div>
            </div>
            <div id="logo">
                <a href="index.php">
                    <img src="images/logo.png" alt="The Logo">
                </a>
            </div>
        </div>
        <div id="buttons">
        <div class="dropdown">
            <img src="./images/profile_icon.png" alt="Icon Image" id="dropdownIcon">
            <div class="dropdown-content" id="dropdownContent">
                <a href="./dashboard.php">Dashboard</a>
                <a href="account_settings.php">Account Settings</a>
                <a href="./logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="centered-text">

            <?php 
			echo "<h3>Messaging ".$org_name."</h3>";
			echo "<h4>Event: ".$event_name."</h4>";
			?>

            <div class="results-area">
                <div class="opportunity">
					<form method='post' action=''>
               			<label class="control-label" for="password">Subject:</label>
                		<input  class="form-control" id="subject" name="subject" >
						<br>
						<label class="control-label" for="password">Message:</label><br>
						
						<textarea id="large-textarea" name="user_input" rows="10" cols="50"></textarea>
                    	<button type="submit" class="search-button" name='submit'>Message</button>
					</form>
                </div>

            </div>            

        </div>
    </div>

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>

</body>

</html>
<?php 
if(isset($_POST['submit'])){
header("Location: dashboard.php");
exit();
}

?>