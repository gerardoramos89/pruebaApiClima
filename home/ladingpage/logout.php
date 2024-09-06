<?php
@session_start();
session_destroy();
$nuevaURL = './login.php';
header("Location: $nuevaURL");
?>
