<?php
session_start();
require_once 'database.php';  

$dblink = db_connect();

if (!isset($_SESSION['org_id'])) {
    $_SESSION['error_message'] = 'Please log in to manage events.';
    header("Location: signin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $org_id = $_SESSION['org_id']; 

    $stmt = $dblink->prepare("SELECT * FROM events WHERE event_id = ? AND org_id = ?");
    $stmt->bind_param("ii", $event_id, $org_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $dblink->prepare("DELETE FROM events WHERE event_id = ?");
        $stmt->bind_param("i", $event_id);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Event deleted successfully.';
        } else {
            $_SESSION['error_message'] = 'Error deleting the event.';
        }
    } else {
        $_SESSION['error_message'] = 'No such event found or unauthorized access.';
    }
} else {
    $_SESSION['error_message'] = 'Invalid request.';
}

header("Location: organization_dashboard.php");
exit();
?>
