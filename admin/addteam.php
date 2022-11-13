<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for adding news -->
	<main class="admin">
<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>
<!-- section for team -->
	<section class="right">

		
	<?php

// when submit is clicked
	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('INSERT INTO team_member (name) VALUES (:name)');

		$criteria = [
			'name' => $_POST['name']
		];

		$stmt->execute($criteria);
		echo 'team_member has added';
	}
	else {
		// when login as admin
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
		?>
<!-- to add a team member -->
			<h2>Add team_member</h2>

			<form action="" method="POST">
				<label>Name</label>
				<input type="text" name="name" />


				<input type="submit" name="submit" value="Add team_member" />

			</form>
			

			<?php
		}

		else {
			
			include 'login.php';
		
		}

	}
	?>

</section>
	</main>


	<?php
	include '../templates/adminfooter.php';
	?>