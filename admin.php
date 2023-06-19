<?php
session_start();
include_once("controllers/Controller.php");
include_once("controllers/UserController.php");
include_once("models/UserService.php");

$controller = 'users';

if($_SESSION['account'] == null || $_SESSION['account'] == ''){
    header("location:index.php?action=login");
}
else{
    $res= new Controller();
    $res->templateAdmin();
}

?>