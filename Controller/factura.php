<?php
date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';
include ('validaAutorizacion.php');
include('log.php');
include('funciones.php');

$validate = new autorize();

if(!$validate->validate()) {
    echo '[{"error":"No Autorizado","statusCode":"401"}]';
} else {
    $codfactura=$_GET['documento'];
    $SUCURSAL=$_GET['codSucursal'];
    $opcion=$_GET['opcion'];

    $usuario = $_SESSION['Usuario'];
    $table = 'fafFactura';
    $action = '';
    $initialVal='';
    $finalVal='';
    $ip = $_SERVER['REMOTE_ADDR'];

    $contingencia = new contingencia();
    $factura = new factura();

    switch($opcion) 
    {
        case 'get':
            echo $factura->buscarFactura($codfactura,$SUCURSAL,$conexion);

            $action='consultar factura '.$codfactura." de sucursal ".$SUCURSAL;
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

            break;
        case 'getID':
            echo $factura->detalleFactura($codfactura,$SUCURSAL,$conexion);

            $table = 'fafFacturaDetalle';

            $action='consultar detalle de factura '.$codfactura." de sucursal ".$SUCURSAL;
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            
            break;
        case 'getVendedor':
            echo $factura->buscarFacturaVendedor($codfactura,$SUCURSAL,$conexion);

            $action="consultar fatura ".$codfactura." de sucursal ".$SUCURSAL;
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
        case 'post':
            break;
        case 'put':
            $codVendedor = $_POST['codVendedor'];
            $codVendedorOld = $_POST['codOldVendedor'];
            echo $factura->actualizarCodVendedorFact($codfactura,$SUCURSAL,$codVendedor,$conexion);

            $action = "actualizar factura".$codfactura." de sucursal ".$SUCURSAL; 
            $finalVal="Cod. Vendedor: ".$codVendedor;
            $initialVal="Cod. Vendedor: ".$codVendedorOld;
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
    }
}



