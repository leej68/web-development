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
<!-- shows the moveis that this person has been in -->
<div id="main">
	<h1>Results for <?= $first ?> <?= $last ?></h1>
<?php
	//returns if the actor is in the imdb database
	if ($actor == null) { 

		notfound($first, $last);
	//returns all the films the actor was in
	} else {
		$tag_id = $imdb->quote($actor);
		$rows = $imdb->query("SELECT name, year FROM movies m JOIN roles r ON m.id = r.movie_id JOIN actors a ON a.id = r.actor_id WHERE a.id = $tag_id ORDER BY m.year DESC, m.name");
		create_table($rows, "All Films");
	}
	bottom();
?>