<!--
	Name: Justin Lee
	CSE 154
	Section: AH Helen Ung
	3/2/2016
	Assignment #7
	This creates the todolist page and calls on 
	common.php for the first and last part of the page
-->
<?php
include("common.php");
starter();
session_start();
$name = $_SESSION["name"];
?>

		<h2><?= $name ?>'s To-Do List</h2>

		<ul id="todolist">
			<?php
				if (file_exists("todo-$name.txt")) {
					$to_do_list = file("todo-$name.txt", FILE_IGNORE_NEW_LINES);
					for ($i=0; $i<count($to_do_list); $i++) { ?>
						<li>
							<form method="post" action="submit.php">
								<input type="hidden" value="delete" name="action">
								<input type="hidden" value=<?= $i ?> name="index">
								<input type="submit" value="Delete">
							</form>
							<?= $to_do_list[$i] ?>
						</li>
				<?php
					}		
				}
			?>
			<li>
				<form method="post" action="submit.php">
					<input type="hidden" value="add" name="action">
					<input type="text" autofocus="autofocus" size="25" name="item">
					<input type="submit" value="Add">
				</form>
			</li>
		</ul>

		<div>
			<a href="logout.php">
			<strong>Log Out</strong>
			</a>
			<em>(logged in since <?=$_COOKIE["time"]?>)</em>
		</div>
<?php
ending();
?>