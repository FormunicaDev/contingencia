<?php
date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';
include ('validaAutorizacion.php');
$validate = new autorize();

if(!$validate->validate()) {
    echo '[{error:No Autorizado,statusCode:401}]';
} else {
	$sql="SELECT CODSUCURSAL,SUCURSAL FROM fnica.GlobalSucursales";

	$result=sqlsrv_query($conexion,$sql);

	while ($fila = sqlsrv_fetch_array($result)) {

		echo '<option value="'.$fila['CODSUCURSAL'].'">'.$fila['SUCURSAL']."-".$fila['CODSUCURSAL'].'</option>';
	}
}

