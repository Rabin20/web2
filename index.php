<?php
include 'templates/header.php';
include 'templates/navbar.php';
?>
<img src="images/randombanner.php"/>
	<main class="home">
		<p>Welcome to Claire's Cars, Northampton's specialist in classic and import cars.</p>
	
	<ul>
			<?php
	require 'connection/connect.php';
	$new = $pdo->prepare('SELECT * FROM news');

	$new->execute();

	$news = $new->fetchAll();
	echo "Latest Post of Cars:";
	foreach($news as $news)
	{

		echo '<br>';
		echo '<li>';

		
		echo '<div class="details">';
		echo '<h2>' . $news['title']. '</h2>';
		echo '<h3>' . $news['description'] . '</h3>';
		echo 'Date Posted:' .$news['date'];

		echo '</div>';
		echo '</li>';
	
} 

	

	?>
		</ul>
		</main>
	<?php
include 'templates/footer.php';
?>