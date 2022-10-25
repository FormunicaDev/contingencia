<?php
date_default_timezone_set('America/Managua');
require_once 'conexion.php';
include('funciones.php');

$usuario = $_SESSION['Usuario'];
$role= $_GET['role'];

$permisos = new permisos();

echo $permisos->tienePermiso($usuario,$role,$conexion);