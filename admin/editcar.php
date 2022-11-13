<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for edting car -->
	<main class="admin">

	<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>

	<section class="right">
	
		
	<?php


	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('UPDATE cars
								SET name = :name, 
								    description = :description, 
								    price = :price,
								    manufacturerId = :manufacturerId
								   WHERE id = :id 
						');
// to edit car
		$criteria = [
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'manufacturerId' => $_POST['manufacturerId'],
			'id' => $_POST['id']
		];

		$stmt->execute($criteria);

		if ($_FILES['image']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . '.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'], '../productimages/' . $fileName);
		}

		echo 'Product saved';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

			$car = $pdo->query('SELECT * FROM cars WHERE id = ' . $_GET['id'])->fetch();


		?>

			<h2>Edit Car</h2>

			<form action="editcar.php" method="POST" enctype="multipart/form-data">

				<input type="hidden" name="id" value="<?php echo $car['id']; ?>" />
				<label>Name</label>
				<input type="text" name="name" value="<?php echo $car['name']; ?>" />

				<label>Description</label>
				<textarea name="description"><?php echo $car['description']; ?></textarea>

				<label>Price</label>
				<input type="text" name="price" value="<?php echo $car['price']; ?>" />

				<label>Category</label>

				<select name="manufacturerId">
				<?php
					$stmt = $pdo->prepare('SELECT * FROM manufacturers');
					$stmt->execute();

					foreach ($stmt as $row) {
						if ($car['categoryId'] == $row['id']) {
							echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}
						else {
							echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';	
						}
						
					}

				?>

				</select>

				<label>Engine Type</label>
				<input type="text" name="typeofengine" value="<?php echo $car['typeofengine']; ?>" />

				<label>mileageofcars</label>
				<input type="text" name="mileageofcars" value="<?php echo $car['mileageofcars']; ?>" />


				<?php

					if (file_exists('../productimages/' . $car['id'] . '.jpg')) {
						echo '<img src="../productimages/' . $car['id'] . '.jpg" />';
					}
				?>
				<label>Product image</label>

				<input type="file" name="image" />

				<input type="submit" name="submit" value="Save Product" />

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