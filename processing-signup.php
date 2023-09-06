<?php

if ( ! filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)) {
	die("valid email is required");
}
if(empty($_POST["username"])){
    die ("username is required");
}
if(strlen($_POST["password"]) < 8){
	die("password must contain at least one letter");
}
if ( ! preg_match("/[a-z]/i", $_POST["password"])){
	die("password must contain at least one letter");
}
if ( ! preg_match("/[0-9]/", $_POST["password"])) {
	die("password must contain at least one number");
}
if ($_POST["password"] !== $_POST["password_confirmation"]){
	die("passswords must match");
}

$password_hash=password_hash($_POST["password"], PASSWORD_DEFAULT);
if(empty($_POST["Adress"])){
    die ("Adress required");
}

$mysqli=require __DIR__ ."/database.php";
$sql = "INSERT INTO user_details(email,username,password_hash) VALUES (?,?,?)";
$stmt=$mysqli->stmt_init();
if( ! $stmt->prepare($sql)){
	die("SQL error:".$mysqli->error);
}
$stmt->bind_param("sss",
					$_POST["email"],
					$_POST["email"],
					$password_hash);
 $stmt->execute();


//print_r($_POST); 
//var_dump($password_hash);
//exit;

echo("sign up successful");
?>
