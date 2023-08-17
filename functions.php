
<?php 
// 
function loggedOut () {
global $connection;
if(isset($_GET['loggedOut'])) {
header("Location: ../login.php");
}
}

?>


