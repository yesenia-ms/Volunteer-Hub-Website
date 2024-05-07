<?php
session_start();
require_once 'database.php';  

$dblink = db_connect();

if (!isset($_SESSION['org_id'])) {
    header('Location: signin.php');
    exit;
}

$success_message = '';
$error_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); 
}
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); 
}

$org_id = $_SESSION['org_id']; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Volunteer Hub</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="assets/css/organization_dashboard.css">
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
                <a href="./organization_dashboard.php">Dashboard</a>
                <a href="account_settings.php">Account Settings</a>
                <a href="./logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="centered-text">
            <?php if ($success_message): ?>
                <div id="successMessage" class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>
            <?php if ($error_message): ?>
                <div id="errorMessage" class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
            <?php endif; ?>

            <h3>Posted Volunteer Opportunities</h3>
            <div class="results-area">
                <?php
                $sql = "SELECT events.*, organizations.name AS org_name, events.start_time, events.end_time FROM events INNER JOIN organizations ON events.org_id = organizations.org_id WHERE events.org_id = ?";
                $stmt = $dblink->prepare($sql);
                $stmt->bind_param("i", $org_id); 
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='opportunity'>";
                        echo "<form method='post' action='delete_events.php'>";
                        echo "<p><strong>Event Name:</strong> " . htmlspecialchars($row['event_name']) . "</p>";
                        echo "<p><strong>Organization:</strong> " . htmlspecialchars($row['org_name']) . "</p>";
                        echo "<p><strong>Task:</strong> " . htmlspecialchars($row['task']) . "</p>";
                        echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
                        echo "<p><strong>Start Time:</strong> " . htmlspecialchars($row['start_time']) . "</p>";
    					echo "<p><strong>End Time:</strong> " . htmlspecialchars($row['end_time']) . "</p>";
                        echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
                        echo "<input type='hidden' name='event_id' value='" . $row['event_id'] . "'>";
                        echo "<button type='submit' class='search-button'>Delete</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No entries found.</p>";
                }
                ?>
            </div>
			
			<a href="post_event.php" class="post-event-button">Post New Event</a>
			
        </div>
    </div>

    <footer>
        © 2024 Volunteer Hub. All rights reserved.
    </footer>
	
<script>
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
	
</body>
</html>

