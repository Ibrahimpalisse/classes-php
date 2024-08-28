<?php
require_once 'user-pdo.php'; 

$user = new User();

$user->disconnect();


header('Location: ./login.php');
exit();
?>


?>