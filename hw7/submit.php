<?php
/*
	Name: Justin Lee
	CSE 154
	Section: AH Helen Ung
	3/2/2016
	Assignment #7
	adds and deletes items from the todolist
*/
#Setting up page.
session_start();
$name = $_SESSION["name"];
#Delete one of the things on the to do list.
if ($_POST["action"] == "delete") {
	$inner = file("todo-$name.txt");
	$numbering = $_POST["index"];
	$inner[$numbering] = "";
	file_put_contents("todo-$name.txt", $inner);
#Add what you need to do to the list.
} else if ($_POST["action"] == "add") {
	$to_do = $_POST["item"];
	file_put_contents("todo-$name.txt", $to_do . "\n", FILE_APPEND);
}
#moves back to todolist after you are done adding or deleting
header("Location: todolist.php");
?>