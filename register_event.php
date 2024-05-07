<?php
session_start();
require_once('database.php');

$dblink = db_connect();

if (isset($_SESSION['user_id']) && !isset($_SESSION['org_id'])) { 
    if (isset($_POST['event_id']) && isset($_POST['org_id'])) {
        $userID = $_SESSION['user_id'];
        $orgID = $_POST['org_id'];
        $eventID = $_POST['event_id'];

        // Check if the user is already registered for this event
        $check_sql = "SELECT * FROM event_history WHERE user_id = ? AND event_id = ? AND org_id = ?";
        $check_stmt = $dblink->prepare($check_sql);
        $check_stmt->bind_param("iii", $userID, $eventID, $orgID);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "You are already registered for this event.";
            header("Location: dashboard.php");
            exit();
        } else {
            // Proceed with the registration
            $sql = "INSERT INTO event_history (user_id, event_id, org_id) VALUES (?, ?, ?)";
            $stmt = $dblink->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("iii", $userID, $eventID, $orgID);
                $success = $stmt->execute();

                if ($success) {
                    $_SESSION['message'] = "Registration successful!";
                } else {
                    $_SESSION['error'] = "Registration failed. Please try again.";
                }
            } else {
                $_SESSION['error'] = "Unable to prepare registration statement.";
            }
        }
    }
}

header("Location: dashboard.php");
exit();
?>
