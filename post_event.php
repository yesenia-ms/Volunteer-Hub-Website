<?php
session_start();
require_once 'database.php';  
$dblink = db_connect();

$message = '';

if (!isset($_SESSION['org_id'])) {
    $_SESSION['error_message'] = "You must be logged in to post an event.";
    header("Location: signin.php");
    exit();
}

if(isset($_POST["submit"])){
    $eventname = $_POST['eventname'];
    $task = $_POST['task'];
    $date = $_POST['date'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $location = $_POST['location'];
    $org_id = $_SESSION['org_id'];  

    $sql = "INSERT INTO events (event_name, org_id, task, date, start_time, end_time, location) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dblink->prepare($sql);
    if (!$stmt) {
        $message = "Prepare failed: " . $dblink->error;
    } else {
        $stmt->bind_param("sisssss", $eventname, $org_id, $task, $date, $starttime, $endtime, $location);
        if($stmt->execute()){
            $_SESSION['success_message'] = "Event posted successfully!";
            header("Location: organization_dashboard.php"); 
            exit(); 
        } else {
            $message = "Error posting event: " . $stmt->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Volunteer Hub</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="assets/css/post_event.css">
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
    <form action="post_event.php" method="post">
        <h1 class="post-heading">Post Event</h1>
    
        <div class="input-wrapper">
            <label for="eventname">Event Name:</label>
            <input type="text" id="eventname" name="eventname" required>
        </div>
    
        <div class="input-wrapper">
            <label for="organization">Organization:</label>
            <input type="text" id="organization" name="organization" required>
        </div>
    
        <div class="input-wrapper">
            <label for="task">Task:</label>
            <input type="text" id="task" name="task" required>
        </div>
    
        <div class="input-wrapper">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
        </div>
    
        <div class="input-wrapper">
            <label for="starttime">Start Time:</label>
            <input type="time" id="starttime" name="starttime" required>
            <label for="endtime">End Time:</label>
            <input type="time" id="endtime" name="endtime" required>
        </div>
    
        <div class="input-wrapper">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
        </div>
    
        <button type="submit" name="submit">Post</button>

    </form>
</div>

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>
	

</body>

</html>
