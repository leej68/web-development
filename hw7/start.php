<!--
	Name: Justin Lee
	CSE 154
	Section: AH Helen Ung
	3/2/2016
	Assignment #7
	This is the start up page of the Remember the Cow page 
	and calls on common.php for the first and last part of the page
-->
<?php
session_start();
include("common.php");
starter();
?>
		<div id="main">
			<p>
				The best way to manage your tasks.
				<br>
				Never forget the cow (or anything else) again!
			</p>
			<p>
				Log in now to manage your to-do list.
				<br>
				If you do not have an account, one will be created for you.
			</p>

			<form id="loginform" method="post" action="login.php">
				<div>
					<input type="text" autofocus="autofocus" size="8" name="name">
					<strong>User Name</strong>
				</div>
				<div>
					<input type="password" size="8" name="password">
					<strong>Password</strong>
				</div>
				<div>
					<input type="submit" value="Log in">
				</div>
			</form>
			<?php
				if (isset($_COOKIE["time"])) {
			?>
					<p>
						<em>(last login from this computer was <?=$_COOKIE["time"]?>)</em>
					</p>
			<?php
				}
			?>
		</div>	
<?php
ending()
?>