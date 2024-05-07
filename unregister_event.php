<?php 
session_start();
require_once('database.php');

$dblink = db_connect();

if (isset($_SESSION['user_id']) && !isset($_SESSION['org_id'])) { 
    if (isset($_POST['event_id'])) {
        $userID = $_SESSION['user_id'];
        $eventID = $_POST['event_id'];

        if (filter_var($userID, FILTER_VALIDATE_INT) && filter_var($eventID, FILTER_VALIDATE_INT)) {
            $sql = "DELETE FROM event_history WHERE user_id = ? AND event_id = ?";
            $stmt = $dblink->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ii", $userID, $eventID);
                $success = $stmt->execute();

                if ($success) {
                    $_SESSION['message'] = "Unregistration successful.";
                } else {
					$_SESSION['error'] = "An error occurred. Please try again.";
				}
			}
		}
	}
}

header("Location: dashboard.php");
exit();
?>