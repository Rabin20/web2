<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for cars -->
	<main class="admin">
<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>

	<section class="right">
		
	<?php
// when logged in as admin
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
		?>


			<h2>Cars</h2>

			<a class="new" href="addcar.php">Add new car</a>

			<?php
			echo '<table>';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Model</th>';
			echo '<th>Status</th>';
			echo '<th>mileageofcars</th>';
			echo '<th>Engine Type</th>';
			echo '<th style="width: 10%">Price</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';

			echo '</tr>';
// to add car details
			$cars = $pdo->query('SELECT * FROM cars');

			foreach ($cars as $car) {
				
				echo '<tr>';
				echo '<td>' . $car['name'] . '</td>';
				echo '<td>' . $car['visible'] . '</td>';
				echo '<td>£' . $car['price'] . '</td>';
				
				echo '<td>£' . $car['typeofengine'] . '</td>';
				echo '<td>' . $car['mileageofcars'] . '</td>';
				echo '<td><a style="float: right" href="editcar.php?id=' . $car['id'] . '">Edit</a></td>';
				echo '<td><form method="post" action="deletecar.php">
				<input type="hidden" name="id" value="' . $car['id'] . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
				echo '<td><form method="post" action="archivecars.php">
				<input type="hidden" name="id" value="' . $car['id'] . '" />
				<input type="submit" name="submit" value="Archive" />
				</form></td>';
				echo '<td><form method="post" action="unarchivecars.php">
				<input type="hidden" name="id" value="' . $car['id'] . '" />
				<input type="submit" name="submit" value="UnArchive" />
				</form></td>';
				echo '</tr>';
			}

			echo '</thead>';
			echo '</table>';

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