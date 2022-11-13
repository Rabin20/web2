<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for adding news -->
	<main class="admin">
		
	<?php
	if (isset($_POST['submit'])) {
		if ($_POST['password'] == 'opensesame') {
			$_SESSION['logged_in_admin'] = true;	
		}
	}


	if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
	?>

	<?php
	include '../templates/adminsidebar.php';
	?>

	<section class="right">
	<h2>You are now logged in</h2>
	</section>
	<?php
	}

	else {
			
		include 'login.php';
	
	}


?>

</section>
</main>


<?php
include '../templates/adminfooter.php';
?>