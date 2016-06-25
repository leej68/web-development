<?php
/*
	Name: Justin Lee
	CSE 154
	Section: AH by Helen Ung
	March 8, 2016
	Assignment #8
*/
//calls common.php and set up variables to be used later
	include("common.php");
	top();
	$first = $_GET['firstname'];
	$last = $_GET['lastname'];
	$imdb = new PDO("mysql:dbname=imdb;host=localhost", "leej68", "slKxpx52xP");
	$imdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$actor = tag_id($first, $last, $imdb);
?>
<!-- This shows a table of the movies that actor has been in with kevin bacon-->
<div id="main">
	<h1>The One Degree of Kevin Bacon</h1>
<?php
	//returns if the actor is found or not
	if ($actor == null) {

		notfound($first, $last);	
	//if actor is found then sees how many movies the actor was in with kevin bacon
	} else {
		$id = $imdb->quote($actor);
		$kevin = $imdb->quote(tag_id('Kevin', 'Bacon', $imdb));
		$rows = $imdb->query("SELECT name, year FROM movies m JOIN roles r1 ON m.id = r1.movie_id JOIN actors a1 ON a1.id = r1.actor_id JOIN roles r2 ON m.id = r2.movie_id JOIN actors a2 ON a2.id = r2.actor_id WHERE a1.id = $id AND a2.id = $kevin ORDER BY m.year DESC, m.name");
		if ($rows->rowCount() == 0) {
?>
			<p><?= $firstname ?> <?= $lastname ?> wasn't in any films with Kevin Bacon.</p>
<?php
		} else {
			create_table($rows, "Films with <?= $first ?> <?= $last ?> and Kevin Bacon");
		}
	}
	bottom();
?>