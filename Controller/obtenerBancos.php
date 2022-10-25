<?php
date_default_timezone_set('America/Managua');
require_once 'conexion.php';

$CodSuc=$_GET['codSucursal'];

$sql="SELECT CODBANCO,DESCRIPCION FROM fnica.fafBANCOS";

$result=sqlsrv_query($conexion,$sql);

while ($fila = sqlsrv_fetch_array($result)) {

	echo '<option value="'.$fila['CODBANCO'].'">'.$fila['DESCRIPCION'].'</option>';
}