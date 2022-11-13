<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for editing manufacture -->
	<main class="admin">

	<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>

	<section class="right">
	
		
	<?php


	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('UPDATE manufacturers SET name = :name WHERE id = :id ');

		$criteria = [
			'name' => $_POST['name'],
			'id' => $_POST['id']
		];
// to update manufacturer name
		$stmt->execute($criteria);
		echo 'Manufacturer has been Saved';
	}
	else {
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {

			$currentMan = $pdo->query('SELECT * FROM manufacturers WHERE id = ' . $_GET['id'])->fetch();
		?>


			<h2>Edit Manufacturer</h2>

			<form action="" method="POST">

				<input type="hidden" name="id" value="<?php echo $currentMan['id']; ?>" />
				<label>Name</label>
				<input type="text" name="name" value="<?php echo $currentMan['name']; ?>" />


				<input type="submit" name="submit" value="Save Manufacturer" />

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