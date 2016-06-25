<?php
/*
	Name: Justin Lee
	CSE 154
	Section: AH by Helen Ung
	March 8, 2016
	Assignment #8
*/
//The top part of the page
function top() {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My Movie Database (MyMDb)</title>
		<meta charset="utf-8" />
		<link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png" rel="shortcut icon" />

		<!-- Link to your CSS file that you should edit -->
		<link href="bacon.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="frame">
			<div id="banner">
				<a href="mymdb.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png" alt="banner logo" /></a>
				My Movie Database
			</div>
<?php
}
//the bottom part of the page
function bottom() {
?>
				<!-- form to search for every movie by a given actor -->
				<form action="search-all.php" method="get">
					<fieldset>
						<legend>All movies</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>

				<!-- form to search for movies where a given actor was with Kevin Bacon -->
				<form action="search-kevin.php" method="get">
					<fieldset>
						<legend>Movies with Kevin Bacon</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>
			</div> <!-- end of #main div -->

			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div> <!-- end of #frame div -->
	</body>
</html>
<?php
}

//Returns a actor's id according to this actor's name.
function tag_id($first, $last, $imdb) {
	$firstname = $imdb->quote($first.'%');
	$lastname = $imdb->quote($last);
	$rows = $imdb->query("SELECT id FROM actors WHERE last_name = $lastname AND first_name LIKE $firstname ORDER BY film_count DESC, id LIMIT 1");
	return $rows->fetch()["id"];
}

//returns thhat the actor is not found if the function is called
function notfound($first, $last) { ?>
					<p>Actor <?= $first ?> <?= $last ?> not found.</p>
<?php }

//creates a table based on the parameter.
function create_table($rows, $title) {
?>
		<table>
			<caption><?= $title ?></caption>
			<tr>
				<th>#</th>
				<th id="title">Title</th>
				<th>Year</th>
			</tr>
<?php
		for ($i=1; $i<=$rows->rowCount(); $i++) {
?>
			<tr>
				<?php
					$row = $rows->fetch();
				?>
				<td><?=$i ?></td>
				<td><?=$row["name"] ?></td>
				<td><?=$row["year"] ?></td>
			</tr>
<?php
		}
?>
		</table>
<?php
}
?>