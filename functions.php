<?php
function emptyInputLogin($email, $password){
	$result;
	if(empty($email) || empty($password)){
		$result = true;
	}
	else{
		$result = false;
	}
}
function loginUser($conn, $email, $password){
	$userExists = userExists($conn, $email);
	// if returned false then it doesn't exists inside the db
	if($userExists === false){
		header("Location: ./signup.php?error=wronglogin");
		exit();
	}
	$pwdHash = $userExists["password"];
	$checkPwd = password_verify($password, $pwdHash);
	if($checkPwd === false){
		header("Location: ./signup.php?error=wronglogin");
		exit();
	}
	else if($checkPwd === true){
		session_start();
		$_SESSION["email"] = $userExists["email"];
		header("Location: ./dashboard.php");
		exit();
	}
}
function userExists($conn, $email){
	$sql = "SELECT * FROM users WHERE email =  ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: ./signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if($row = mysqli_fetch_assoc($resultData)){
		return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}
?>