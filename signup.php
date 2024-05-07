<?php
session_start();

include_once "header_loggedin.php";
require_once "database.php";
$dblink = db_connect();

$error = '';

if (isset($_POST["submit"])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $companyname = $_POST['companyname'];
    $zipcode = $_POST['zipcode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $is_organization = !empty($companyname);

    $errors = array();
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($phone)) {
        array_push($errors, "All fields except Company Name are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 5) {
        array_push($errors, "Password must be at least 5 characters long");
    }

    // Check if email already exists
    $sql = "SELECT email FROM users WHERE email = ? UNION SELECT email FROM organizations WHERE email = ?";
    $stmt = $dblink->prepare($sql);
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $error = 'An account with this email already exists!';
    } else {
        // Insert new user or organization
        if ($is_organization) {
            $sql = "INSERT INTO organizations (name, email, password, phone_number, zipcode) VALUES (?, ?, ?, ?, ?)";
            $stmt = $dblink->prepare($sql);
            $stmt->bind_param("sssss", $companyname, $email, $password, $phone, $zipcode);
        } else {
            $sql = "INSERT INTO users (first_name, last_name, email, password, zipcode, phone) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $dblink->prepare($sql);
            $stmt->bind_param("ssssss", $firstname, $lastname, $email, $password, $zipcode, $phone);
        }
        if ($stmt->execute()) {
            if (!$is_organization) {
                $_SESSION['user_id'] = $dblink->insert_id;
            } else {
                $_SESSION['org_id'] = $dblink->insert_id;
            }
            $dashboard = $is_organization ? 'organization_dashboard.php' : 'dashboard.php';
            header("Location: $dashboard");
            exit;
        } else {
            $error = "Error registering: " . $dblink->error;
        }
    }
}
?>
<link rel="stylesheet" href="assets/css/signin.css">
	 <div class="container">
        <form id="mainForm" method="post" action="signup.php" novalidate>
            <h1 class="signup-heading">Sign Up</h1>
			
			<!-- Error Message Display -->
        <?php if (!empty($error)): ?>
			<div class="alert alert-danger"><?= $error; ?></div>
		<?php endif; ?>
        
            <div class="col-sm-6 col-xs-12">
                <div id="topdivFirst" class="form-group">
                    <label class="control-label" for="firstname">First Name:</label>
                    <input type="text" class="form-control" id="First Name" name="firstname" required>
					<div id="firstfeedback"></div>
                </div>
			</div>
			<div class="col-sm-6 col-xs-12">
             	<div id="topdivLast" class="form-group">
                    <label class="control-label" for="lastname">Last Name:</label>
                    <input type="text" class="form-control" id="Last Name" name="lastname" required>
					<div id="lastfeedback"></div>
                </div>
            </div>
        
            <div class="col-sm-12">
                <div id="topdivCompany" class="form-group">
                <label class="control-label" for="companyname">Company Name: (Optional)</label>
                <input type="text" class="form-control" id="Company Name" name="companyname">
                </div>
            </div>
			<div id="companyfeedback"></div>

            <div class="col-sm-12">
                <div id="topdivZipcode" class="form-group">
                    <label class="control-label" for="zipcode">Zipcode:</label>
                    <input type="zipcode" class="form-control" id="Zipcode" name="zipcode" required>
					<div id="zipcodefeedback"></div>
                </div>
            </div>

            <div class="col-sm-12">
                <div id="topdivPhone" class="form-group">
                    <label class="control-label" for="phone">Phone Number:</label>
                    <input type="tel" class="form-control" id="Phone" name="phone" required>
					<div id="phonefeedback"></div>
                </div>
            </div>
			
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

            <!--button type="submit">Sign Up</button-->
            <div class="col-sm-12">
                <div class="single-contact-btn">
                     <input type="submit" value="Sign Up" name="submit" />  
                </div>
            </div>

            <div class="col-sm-12">
                <p>Already have an account? <a href="signin.php">Login</a></p>
            </div>
        </form>
        
    </div>
    <div>
		<br>
        <br>
        <br>
        <br>
    </div>
<?php
include_once "footer.php";
?>
<script src="assets/js/signup.js"></script>
