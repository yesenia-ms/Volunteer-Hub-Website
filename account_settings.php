<?php
session_start();
require_once('database.php');
include("header_loggedin.php");
$dblink = db_connect();

$message = '';
$error = '';

// Check if the user or organization is logged in
if (isset($_SESSION['user_id']) || isset($_SESSION['org_id'])) {
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $org_id = isset($_SESSION['org_id']) ? $_SESSION['org_id'] : null;

    $id = $user_id ? $user_id : $org_id;

    $sql = $user_id ? "SELECT first_name, last_name, email, phone, zipcode FROM users WHERE user_id = ?" :
                      "SELECT name, email, phone_number, zipcode FROM organizations WHERE org_id = ?";
    $stmt = $dblink->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $details = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_info'])) {
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $companyname = isset($_POST['companyname']) ? $_POST['companyname'] : '';
        $zipcode = isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        $sql = $user_id ? "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, zipcode = ? WHERE user_id = ?" :
                          "UPDATE organizations SET name = ?, email = ?, phone_number = ?, zipcode = ? WHERE org_id = ?";
        $stmt = $dblink->prepare($sql);
        if ($user_id) {
            $stmt->bind_param("sssssi", $firstname, $lastname, $email, $phone, $zipcode, $user_id);
        } else {
            $stmt->bind_param("ssssi", $companyname, $email, $phone, $zipcode, $org_id);
        }
        if ($stmt->execute()) {
			$message = "Information updated successfully!";
		} else {
			$error = "Error updating information: " . $dblink->error;
		}
		
    }
	
	if (isset($_POST['change_password'])) {
        $currentPassword = isset($_POST['currentpassword']) ? $_POST['currentpassword'] : '';
        $newPassword = isset($_POST['newpassword']) ? $_POST['newpassword'] : '';
        $confirmPassword = isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : '';

        // Checking password match
        if ($newPassword === $confirmPassword) {
            // Update the password in the database
            $sql = $user_id ? "UPDATE users SET password = ? WHERE user_id = ?" : "UPDATE organizations SET password = ? WHERE org_id = ?";
            $stmt = $dblink->prepare($sql);
            $stmt->bind_param("si", $newPassword, $id);
            if ($stmt->execute()) {
                $message = "Password updated successfully!";
            } else {
                $error = "Error updating password: " . $dblink->error;
            }
        } else {
            $error = "New passwords do not match.";
        }
    }
}
// Handle account deletion
if (isset($_POST['delete'])) {
    $sql = $user_id ? "DELETE FROM users WHERE user_id = ?" : "DELETE FROM organizations WHERE org_id = ?";
    $stmt = $dblink->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        session_destroy();
        header("Location: index.php");
        exit;
    } else {
        $error = "Failed to delete account.";
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
    <link rel="stylesheet" href="assets/css/account_settings.css">
</head>

<body>
<!--
    <div id="header">
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
                    <img src="images/logo.png" alt="The Logo">
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
                        <a href="./account_settings.php">Account Settings</a>
                        <a href="./logout.php">Logout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
-->

    <div class="container">
        <form action="account_settings.php" method="post">
            <div class="delete-container">
                <button name="delete" type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete your account? This cannot be undone.');">Delete Account</button>
            </div>
			
			<?php if ($message): ?>
                <p class="success" id="successMessage"><?php echo $message; ?></p>
            <?php endif; ?>
            <?php if ($error): ?>
                <p class="error" id="errorMessage"><?php echo $error; ?></p>
            <?php endif; ?>
        
            <h3 class="signup-heading">Update Information</h3>
        
            <div class="name-container">
                <div class="input-wrapper">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname">
                </div>
                <div class="input-wrapper">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname">
                </div>
            </div>
        
            <label for="companyname">Company Name: (Optional)</label>
            <input type="text" id="companyname" name="companyname"><br>
        
            <label for="zipcode">Zipcode:</label>
            <input type="zipcode" id="zipcode" name="zipcode"><br>
        
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone"><br>
        
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>

            <button type="submit" name="update_info">Update Information</button>
        
            <h3 class="signup-heading">Change password</h3>

            <label for="currentpassword">Current Password:</label>
            <input type="currentpassword" id="currentpassword" name="currentpassword"><br>

            <label for="newpassword">New Password:</label>
            <input type="newpassword" id="newpassword" name="newpassword"><br>

            <label for="confirmpassword">Confirm Password:</label>
            <input type="confirmpassword" id="confirmpassword" name="confirmpassword"><br>
        
            <button type="submit" name="change_password">Change Password</button>

        </form>
        

        
    </div>

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>
	
	<script>
    if (document.getElementById('successMessage')) {
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 2000);
    }

    if (document.getElementById('errorMessage')) {
        setTimeout(function() {
            document.getElementById('errorMessage').style.display = 'none';
        }, 2000);
    }
	</script>

</body>

</html>
