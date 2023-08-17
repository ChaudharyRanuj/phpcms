<?php include "includes/header.php"; ?>
<?php 
session_destroy();
header("Location: ../login.php?loggedout");
?>
