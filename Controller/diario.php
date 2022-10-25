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
    $consecutivo=$_GET['diario'];
    $sucursal=$_GET['codSucursal'];
    $opcion=$_GET['opcion'];



    $usuario = $_SESSION['Usuario'];
    $table = 'fafDIARIO';
    $action = '';
    $initialVal='';
    $finalVal='';
    $ip = $_SERVER['REMOTE_ADDR'];

    $contingencia = new contingencia();
    $diario = new diario();

    switch($opcion)
    {
        case 'get':
                echo $diario->buscarDiario($consecutivo,$sucursal,$conexion);

                $action='consultar diario '.$consecutivo." de sucursal ".$sucursal;
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

            break;
        case 'getID':
                echo $diario->detalleDiario($consecutivo,$sucursal,$conexion);
                $table = "fafDIARIODETALLE";
                $action='consultar detalle diario '.$consecutivo." de sucursal ".$sucursal;
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
        case 'post':

                $monto=$_POST['monto'];
                $moneda=$_POST['moneda'];
                $cliente=$_POST['cliente'];
                $bancoEmisor=$_POST['bancoEmisor'];
                $bancoReceptor=$_POST['bancoReceptor'];
                $fechaCierre=$_POST['fechaCierre'];
                $diarioPost=$_POST['diario'];
                $tipoPago=$_POST['tipoPago'];
                $documento=$_POST['documento'];
                $deposito=$_POST['deposito'];

                echo $diario->registrarDiarioDetalle($consecutivo,$sucursal,$monto,$moneda,$cliente,$bancoEmisor,$bancoReceptor,$fechaCierre,$diarioPost,$conexion,$tipoPago,$documento,$deposito);
                
                $table = "fafDIARIODETALLE";
                $action='Registrar detalle diario '.$diarioPost." de sucursal ".$sucursal." deposito #".$deposito;
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
                
            break;
        case 'put':

                $montosOriginales = $diario->buscarDiario($consecutivo,$sucursal,$conexion);
                $array=json_decode($montosOriginales,true);

                $montos = ['EF'=>$_POST['ef'],'EFD'=>$_POST['efd'],'CHK'=>$_POST['chk'],'CHKD'=>$_POST['chkd'],'OTRO'=>$_POST['otro'],'OTROD'=>$_POST['otroD'],'RETENCION'=>$_POST['retencion']];
                echo $diario->updateMontosDiario($consecutivo,$sucursal,$montos,$conexion);

                $action = "Actualizar diario ".$consecutivo." de sucursal ".$sucursal;
                $finalVal = "Efectivo C$: ".$montos['EF']." Efectivo $: ".$montos['EFD']." Cheque C$: ".$montos['CHK']." Cheque $: ".$montos['CHKD']." Otros C$: ".$montos['OTRO']." Otros $: ".$montos['OTROD']." Retencion: ".$montos['RETENCION'];
                $initialVal = "Efectivo C$: ".$array[0]['EFECTIVOCORDOBA']." Efectivo $: ".$array[0]['EFECTIVODOLAR']." Cheque C$: ".$array[0]['CHEQUECORDOBA']." Cheque $: ".$array[0]['CHEQUEDOLAR']." Otros C$: ".$array[0]['OTROS']." Otros $: ".$array[0]['OTROSDOLAR']." Retencion: ".$array[0]['RETENCION'];
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
        case 'delete':
                $linea = $_GET['linea'];
                $deposito = $_GET['deposito'];
                
                echo $diario->eliminarLineaDiario($linea,$sucursal,$consecutivo,$deposito,$conexion);

                $table = "fafDIARIODETALLE";
                $action='Eliminar linea '.$linea.' del diario '.$diarioPost." de sucursal ".$sucursal." deposito #".$deposito;
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
        case 'putDetalle':
                $montoCordoba = $_POST['montoCordoba'];
                $montoDolar = $_POST['montoDolar'];
                $linea = $_POST['linea'];
                $tipoPago = $_POST['tipoPago'];

                echo $diario->actualizarDiarioDetalle($consecutivo,$sucursal,$linea,$montoCordoba,$montoDolar,$tipoPago,$conexion);
            break;
    }
}




?>