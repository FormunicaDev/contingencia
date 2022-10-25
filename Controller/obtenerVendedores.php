<?php
date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';
include ('validaAutorizacion.php');
$validate = new autorize();

$sucursal = $_GET['codSucursal'];

if(!$validate->validate()) {
    echo '[{error:No Autorizado,statusCode:401}]';
} else {
	$sql="SELECT CODVENDEDOR,NOMBRESVENDEDOR,APELLIDOSVENDEDOR FROM fnica.globalvendedores where CODSUCURSAL = '$sucursal'";

	$result=sqlsrv_query($conexion,$sql);

	while ($fila = sqlsrv_fetch_array($result)) {

		echo '<option value="'.$fila['CODVENDEDOR'].'">'.$fila['NOMBRESVENDEDOR']." ".$fila['APELLIDOSVENDEDOR'].'</option>';
	}
}
