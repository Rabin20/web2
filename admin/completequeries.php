<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for completing queries -->
	<main class="admin">
<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>


	<section class="right">
		
	<?php
// when logged in as admin

		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {

			$products = $pdo->query("UPDATE queries SET report = 'DONE' WHERE id = " . $_POST['id']);

			echo 'Queries has been ADDED';

		}

		else {
			
			include 'login.php';
		
		}

	}
	?>

</section>
	</main>

<!-- for footer -->
	<?php
	include '../templates/adminfooter.php';
	?>