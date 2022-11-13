<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for editing team -->
	<main class="admin">

<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>

	<section class="right">
	
		
	<?php


	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('UPDATE team_member SET name = :name WHERE id = :id ');
// to edit team name
		$criteria = [
			'name' => $_POST['name'],
			'id' => $_POST['id']
		];

		$stmt->execute($criteria);
		echo 'team_member Saved';
	}
	else {
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {

			$currentMan = $pdo->query('SELECT * FROM team_member WHERE id = ' . $_GET['id'])->fetch();
		?>


			<h2>Edit team_member</h2>

			<form action="" method="POST">

				<input type="hidden" name="id" value="<?php echo $currentMan['id']; ?>" />
				<label>Name</label>
				<input type="text" name="name" value="<?php echo $currentMan['name']; ?>" />


				<input type="submit" name="submit" value="Save team_member" />

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