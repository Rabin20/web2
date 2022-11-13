<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for deleting cars -->
	<main class="admin">

<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>


	<section class="right">
		
	<?php

// when logged in as admin
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
// to delete cars info
			$stmt = $pdo->prepare('DELETE FROM cars WHERE id = :id');
			$stmt->execute(['id' => $_POST['id']]);

			echo 'Car details is deleted';

		}

		else {
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
			