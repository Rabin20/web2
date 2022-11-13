<?php
include 'templates/header.php';
include 'templates/navbar.php';
?>
<img src="/images/randombanner.php" />
<main class="admin">

	<section class="left">
		<ul>
			<?php
	require 'connection/connect.php';
	$manu = $pdo->prepare('SELECT * FROM manufacturers');

	$manu->execute();

	$manufacturers = $manu->fetchAll();
	foreach($manufacturers as $manufacturer)
	{
		echo '<li><a href="manufacturercars.php?manufacturer=' . $manufacturer['id'] . '">' . $manufacturer['name'] . '</a></li>';
	
} 

	

	?>



		</ul>
	</section>

	<section class="right">

		<h1>Our cars</h1>

		<ul class="cars">


			<?php
	
	$cars = $pdo->prepare("SELECT * FROM cars WHERE visible != 'Archive' LIMIT 10");
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
		$discount = $car['price'] + 10/100* $car['price'];
		echo '<strike><h3>Was £' . $discount . '</h3></strike>';
		echo '<h3>Now £' . $car['price'] . '</h3>';
		echo '<h3>mileageofcars:' . $car['mileageofcars'] . '</h3>';
		echo '<h3>typeofengine:' . $car['typeofengine'] . '</h3>';
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