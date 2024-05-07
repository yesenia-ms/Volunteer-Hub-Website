<?php
/*
if(empty($_POST['firstname'])){
    die("First name is required");
}

if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    die("Valid email is required");
}

if(strlen($_POST['password']) < 5){
    die("Password must be at least 5 characters");
}

// Extra password validation but not needed to not make it complicated for the user
// and to reduce frustration from user - security is not a big concern for this website
if( ! preg_match("/[a-z]/i", $_POST["password"])){ // matches any single lower case letter
    die("Password must contain at least one letter");
}

// hashing the password to not save it into plain text
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

// writing the sql to insert user stuff into the database
$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)"; // placeholders

$stmt = $mysqi->stmt_init();

if(! $sql->prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                    $_POST['name'],
                    $_POST['email'],
                    $password_hash);

$stmt->execute(); // execute method on the statement object
echo "Sign up successful!";

print_r($_POST);
var_dump($password_hash);
*/
?>
