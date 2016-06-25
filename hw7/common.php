<?php
/*
	Name: Justin Lee
	CSE 154
	Section: AH Helen Ung
	3/2/2016
	Assignment #7
	This php holds all parts of the page that is common between 
	start.php and todolist.php
*/
#Depict the beginning part of start.php and todolist.php
function starter() { ?>	
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Remember the Cow</title>
			<link rel="stylesheet" type="text/css" href="https://webster.cs.washington.edu/css/cow-provided.css">
			<link rel="stylesheet" type="text/css" href="cow.css">
			<link rel="shortcut icon" type="image/ico" href="https://webster.cs.washington.edu/images/todolist/favicon.ico">
		</head>
		<body>
			<div class="headfoot">
				<h1>
					<img alt="logo" src="https://webster.cs.washington.edu/images/todolist/logo.gif">
					Remember
					<br>
					the Cow
				</h1>
			</div>
<?php		
}
#Depict the last part of start.php and todolist.php
function ending() {
?>
			<div class="headfoot">
				<p>
					"Remember The Cow is nice, but it's a total copy of another site." - PCWorld
					<br>
					All pages and content © Copyright CowPie Inc.
				</p>
				<div id="w3c">
					<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
					<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
				</div>
			</div>
		</body>
	</html>
<?php
}

?>