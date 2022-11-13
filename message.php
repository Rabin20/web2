<?php
include 'templates/header.php';
include 'templates/navbar.php';
?>
<main class="admin">
<?php
require 'connection/connect.php';
?>

	<section class="right">

		
	<?php


	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('INSERT INTO queries (name, feedback,report) 
							   VALUES (:name, :feedback,:report)');

		$criteria = [
			'name' => $_POST['name'],
			'feedback' => $_POST['feedback'],
		'report'=> 'NOT DONE',
			
		];

		$stmt->execute($criteria);

		

		echo 'feedback added';
	}
	else {
		
		?>


			<h2>Add queries</h2>

			<form action="add_query.php" method="POST" enctype="multipart/form-data">
				<label>Your Name:</label>
				<input type="text" name="name" />

				<label>feedback:</label>
				<textarea name="feedback"></textarea>

				<input type="submit" name="submit" value="Add queries" />

			</form>
			

		
		<?php
		

	}
	?>

</section>
	</main>
	<?php
include 'templates/footer.php';
?>


	