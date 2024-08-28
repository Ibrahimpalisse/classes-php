<?php
require_once 'User.php'; 

$user = new User();

$user->disconnect();


header('Location: ./login.php');
exit();
?>


?>