<?php
session_start();
include_once("controllers/Controller.php");
include_once("controllers/UserController.php");
include_once("models/UserService.php");

$controller = 'alumno';

$res= new Controller();
$res->template();
?>