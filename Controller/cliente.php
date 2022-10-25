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
    echo '[{error:No Autorizado,statusCode:401}]';
} else {
    $opcion = $_GET['opcion'];
    $codCliente = $_GET['codCliente'];

    $usuario = $_SESSION['Usuario'];
    $table = 'ccfClientes';
    $action = '';
    $initialVal='';
    $finalVal='';
    $ip = $_SERVER['REMOTE_ADDR'];

    $contingencia = new contingencia();
    $cliente = new clientes();

    switch($opcion)
    {
        case 'get':
            echo $cliente->listarClientes($conexion);

            $action='consultar ultimos 100 clientes ';
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

            break;
        case 'getById':
            echo $cliente->buscarCliente($codCliente,$conexion);

            $action="consultar cliente: ".$codCliente;
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
        case 'put':
            $infoCliente = ['nombre'=>$_POST['nombre'],'apellido'=>$_POST['apellido'],'cedula'=>$_POST['cedula'],'telefono'=>$_POST['telefono'],'direccion'=>$_POST['direccion']];
            echo $cliente->actualizarCliente($infoCliente,$codCliente,$conexion);
            $action= "Actualizar cliente ".$codCliente;
            $finalVal = "Nombre: ".$_POST['nombre']." Apellido: ".$_POST['apellido']." Direccion: ".$_POST['direccion'];
            $initialVal = "";
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
        case 'post':
                $plazo = $_POST['plazo'];
                $codCliente = $_POST['codCliente'];
                
                echo $cliente->solicitudCambioPlazo($plazo,$codCliente,$usuario,$conexion);
                $action = "Se ingreso una solicitud de cambio de plazo en dias para el cliente ".$codCliente;
                $table = "solicitudCambioPlazoCliente";
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
        case 'postCredito':
                $techoCredito = $_POST['techoCredito'];
                $codCliente = $_POST['codCliente'];

                echo $cliente->solicitudCambioTechoCredito($techoCredito,$codCliente,$usuario,$conexion);
                $action = "Se ingreso ingreso una solicitud de cambio de techo de credito para el cliente ".$codCliente;
                $table = "solicitudCambioTechoCredito";
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
        case 'getSol':
                $role = $_GET['role'];
                echo $cliente->listarSolicitudes($role,$usuario,$conexion);
            break;
        case 'putSol':
                $plazo = $_POST['plazo'];
                $aprobacion = $_POST['aprobacion'];
                $IdSolicitud = $_POST['IdSolicitud'];

                echo $cliente->procesarSolicitud($codCliente,$IdSolicitud,$aprobacion,$plazo,$conexion,$usuario);
                if($aprobacion == 1) {
                    $action = "Se aprobo la solicitud ".$IdSolicitud.", cliente: ".$codCliente;
                    $table = "solicitudCambioPlazoCliente, ccfClientes";
                    $finalVal = "Plazo: ".$plazo." Estado: Aprobado";
                } else {
                    $action = "Se rechazo la solicitud ".$IdSolicitud.", cliente: ".$codCliente;
                    $table = "solicitudCambioPlazoCliente";
                    $finalVal = "Estado: Rechazado";
                }   
                
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;

        case 'getSolTecho':
                $role = $_GET['role'];
                echo $cliente->listarSolicitudesTechoCredito($role,$usuario,$conexion);
            break;
        case 'putSolTecho':
                $techoCredito = $_POST['techoCredito'];
                $aprobacion = $_POST['aprobacion'];
                $IdSolicitud = $_POST['IdSolicitud'];

                echo $cliente->procesarSolicitudTechoCredito($codCliente,$IdSolicitud,$aprobacion,$techoCredito,$conexion,$usuario);

                if($aprobacion == 1) {
                    $action = "Se aprobo la solicitud ".$IdSolicitud.", cliente: ".$codCliente;
                    $table = "solicitudCambioTechoCredito, ccfClientes";
                    $finalVal = "Techo Credito: ".$techoCredito." Estado: Aprobado";
                } else {
                    $action = "Se rechazo la solicitud ".$IdSolicitud.", cliente: ".$codCliente;
                    $table = "solicitudCambioTechoCredito";
                    $finalVal = "Estado: Rechazado";
                }   
                
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

            break;
    }
}
