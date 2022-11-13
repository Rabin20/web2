<main class="admin">

<?php	
if (isset($_POST['submit'])){
    if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
    session_destroy();
    }


?>

<section class="right">
<h2>You are now logged out</h2>
</section>
<?php
}
include '../index.php';
?>
</main>