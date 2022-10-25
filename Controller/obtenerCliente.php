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
	$CodSuc=$_GET['codSucursal'];

	$sql="SELECT CODCLIENTE,NOMBRESCLIENTE,APELLIDOSCLIENTE FROM fnica.ccfClientes where CODSUCURSAL='$CodSuc'";

	$result=sqlsrv_query($conexion,$sql);

	while ($fila = sqlsrv_fetch_array($result)) {

		echo '<option value="'.$fila['CODCLIENTE'].'">'.$fila['NOMBRESCLIENTE']." ".$fila['APELLIDOSCLIENTE']." ".$fila['CODCLIENTE'] .'</option>';
	}
}

