<?php
date_default_timezone_set('America/Managua');
require_once 'conexion.php';
$opcion = $_GET['opcion'];

switch($opcion)
{
	case 1:
			$sql="SELECT * FROM fnica.reiTipoEmisionPago";
			$result=sqlsrv_query($conexion,$sql);

			while ($fila = sqlsrv_fetch_array($result)) {

				echo '<option value="'.$fila['TipoPago'].'">'.$fila['Descripcion'].'</option>';
			}
		break;
	case 2:
			$sql="SELECT * FROM fnica.fafTIPOSPAGO";
			$result=sqlsrv_query($conexion,$sql);

			while ($fila = sqlsrv_fetch_array($result)) {

				echo '<option value="'.$fila['TIPOPAGO'].'">'.$fila['DESCRIPCION'].'</option>';
			}
		break;
}


