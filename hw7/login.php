<?php
/*
	Name: Justin Lee
	CSE 154
	Section: AH Helen Ung
	3/2/2016
	Assignment #7
	This logs allows you to log into the page and directs you to 
	the todolist
*/
session_start();
include("common.php");

#Tests to see if there is a password and name and moves to the 
#todolist if there is one
function login() {
	if (isset($_SESSION["name"]) || isset($_SESSION["password"])) {
		header("Location: todolist.php");
		die();
	}
}

$name = $_POST["name"];
$password = $_POST["password"];

#Iterate through users.txt to put all the contents into an array.
$list = array();
$user_pass_info = file("users.txt", FILE_IGNORE_NEW_LINES);

#Test if the username or password is the required form.
if (!array_key_exists($name, $list)) {
	$checkname = preg_match("/^[a-z][a-z0-9]{2,7}$/", $name);
	$checkpassword = preg_match("/^\d.*\W$/", $password);
	if ($checkname && $checkpassword) {
		file_put_contents($user_pass_info, $name . ":" . $password . "\n" , FILE_APPEND);
		$list[$name] = $password;
	} else {
		header("Location: start.php");
	}
}
#Test if the password matches the name entered
if ($password == $list[$name]) {
	$_SESSION["name"] = $name;
	$_SESSION["password"] = $password;
	date_default_timezone_set("America/Los_Angeles");
	setcookie("time", date("D y M d, g:i:s a"), time()+ 7 * 24 * 3600);
	header("Location: todolist.php");
} 
?>