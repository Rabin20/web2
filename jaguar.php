<?php
include 'templates/header.php';
include 'templates/navbar.php';
require 'connection/connect.php';
?>
	<main class="admin">

	<section class="left">
		<ul>
			<li><a href="jaguar.php">Jaguar</a></li>
			<li><a href="mercedes.php">Mercedes</a></li>
			<li><a href="aston.php">Aston Martin</a></li>

		</ul>
	</section>

	<section class="right">

		<h1>Jaguar Cars</h1>

	<ul class="cars">


	<?php
	
	$cars = $pdo->prepare('SELECT * FROM cars WHERE manufacturerId = 2');
	$manu = $pdo->prepare('SELECT * FROM manufacturers WHERE id = :id');

	$cars->execute();


	foreach ($cars as $car) {
		$manu->execute(['id' => $car['manufacturerId']]);
		$manufacturer = $manu->fetch();
		echo '<li>';

		if (file_exists('images/cars/' . $car['id'] . '.jpg')) {
			echo '<a href="images/cars/' . $car['id'] . '.jpg"><img src="images/cars/' . $car['id'] . '.jpg" /></a>';
		}

		echo '<div class="details">';
		echo '<h2>' . $manufacturer['name'] . ' ' . $car['name'] . '</h2>';
		echo '<h3>£' . $car['price'] . '</h3>';
		echo '<p>' . $car['description'] . '</p>';

		echo '</div>';
		echo '</li>';
	}

	?>

</ul>

</section>
	</main>
	<?php
include 'templates/footer.php';
?>