<?php
/*
	Name: Justin Lee
	CSE 154
	Section: AH Helen Ung
	3/2/2016
	Assignment #7
	This php logs you out of the todolist page
*/
#When you click log out of the todolist page and back to start
session_destroy();
session_regenerate_id();
header("Location: start.php");
?>