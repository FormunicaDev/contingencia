<?php
date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';
include('log.php');
include('funciones.php');

include ('validaAutorizacion.php');
$validate = new autorize();

if(!$validate->validate()) {
    echo '[{error:"No Autorizado",statusCode:"401"}]';
} else {
    $opcion=$_GET['opcion'];
    $documento=$_GET['documento'];
    $codSucursal=$_GET['codSucursal'];
    $CodCliente =$_GET['CodCliente'];

    $usuario = $_SESSION['Usuario'];
    $table = 'ccfDocumentoCC';
    $action = '';
    $initialVal='';
    $finalVal='';
    $ip = $_SERVER['REMOTE_ADDR'];
    $contingencia = new contingencia();
    $sysCobro= new sysCobro();

    switch($opcion) 
    {
        case 'get':

            echo $sysCobro->mostrarFactura($documento,$CodCliente,$codSucursal,$conexion);
            
            $action='consultar documento '.$documento." de sucursal ".$codSucursal;
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

            break;
        case 'post':
                
            break;
        case 'put':

                $plazo=$_POST['Plazo'];
                $plazoOriginal = $_POST['plazoOriginal'];

                $sysCobro->actualizarPlazoCCF($documento,$plazo,$codSucursal,$conexion);
                echo $sysCobro->actualizarPlazoFact($plazo,$documento,$codSucursal,$conexion);

                $action='actualizar documento '.$documento." de sucursal ".$codSucursal;
                $initialVal="Plazo: ".$plazoOriginal;
                $finalVal="Plazo: ".$plazo;
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            
            
            break;
        case 'delete':
            break;
    }
}

