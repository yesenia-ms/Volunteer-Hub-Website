<?php
include_once 'header_loggedin.php';
session_start();

require_once('database.php'); 
$conn = db_connect(); 

$error = '';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($password === $user['password']) { 
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = 'Invalid password!';
        }
    } else {
        $sql = "SELECT * FROM organizations WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($org = $result->fetch_assoc()) {
            if ($password === $org['password']) { 
                $_SESSION['org_id'] = $org['org_id'];
                $_SESSION['org_email'] = $org['email'];
                header("Location: organization_dashboard.php");
                exit();
            } else {
                $error = 'Invalid password!';
            }
        } else {
            $error = 'No user found with that email address!';
        }
    }
}
?>
<link rel="stylesheet" href="assets/css/signin.css">
<div class="container">
    <form action="signin.php" method="post">
        <h1 class="signin-heading">Log In</h1>

        <!-- Error Message Display -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <div class="col-sm-12">
            <div id="topdivEmail" class="form-group">
                <label class="control-label" for="email">Email:</label>
                <input type="email" class="form-control" id="Email" name="email" required>
                <div id="emailfeedback"></div>
            </div>
        </div>

        <div class="col-sm-12"> 
            <div id="topdivPassword" class="form-group">
                <label class="control-label" for="password">Password:</label>
                <input type="password" class="form-control" id="Password" name="password" required>
                <div id="passwordfeedback"></div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="single-contact-btn">
                <input type="submit" value="Log In" name="submit" />  
            </div>
        </div>

        <p>New to Volunteer Hub? <a href="signup.php">Join Today</a></p>
    </form>
</div>
<?php
include_once "footer.php";
?>
<script src="assets/js/signin.js"></script>
