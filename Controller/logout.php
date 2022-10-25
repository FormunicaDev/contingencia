<?php
session_start();
session_destroy();
ob_start();
require_once 'conexion.php';
include 'log.php';
$contingencia = new contingencia();

$table = "";
$users = $_SESSION['Usuario'];
$action = "Cerrar Sesión";
$initialVal = "";
$finalVal = "";
$ip = $_SERVER['REMOTE_ADDR'];

$contingencia->logContig($table,$users,$action,$initialVal,$finalVal,$ip,$conexion);

header("Location:../index.php");

?>