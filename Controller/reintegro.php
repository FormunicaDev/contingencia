<?php
date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';
include 'log.php';
include ('validaAutorizacion.php');
$validate = new autorize();

if(!$validate->validate()) {
    echo '[{error:No Autorizado,statusCode:401}]';
} else {
    $opcion=$_GET['opcion'];
    $IdSolicitud = $_GET['IDSol'];
    $usuario = $_SESSION['Usuario'];
    $table = 'reiSolicitudReintegroDePago';
    $action = '';
    $initialVal='';
    $finalVal='';
    $ip = $_SERVER['REMOTE_ADDR'];
    $contingencia = new contingencia();

    switch($opcion) {
        case "get":
                if($IdSolicitud != null || $IdSolicitud != 0) {
                    $sql="SELECT * FROM fnica.reiSolicitudReintegroDePago where IdSolicitud='$IdSolicitud'";
                    $action = "consultar ".$IdSolicitud;
                } else {
                    $sql="SELECT top 50 * FROM fnica.reiSolicitudReintegroDePago order by FechaSolicitud desc";
                    $action = "consultar";
                }
                

                $result=sqlsrv_query($conexion,$sql);
                
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
                
                $tabla= array();
                
                while($item = sqlsrv_fetch_array($result)){
                    $tabla[] = array (
                        'IdSolicitud' => $item['IdSolicitud'],
                        'CENTRO_COSTO' => $item['CENTRO_COSTO'],
                        'Concepto' => $item['Concepto'],
                        'FechaSolicitud' => $item['FechaSolicitud']->format('Y-m-d'),
                        'Monto' => $item['Monto']
                    );
                    
                }
                
                $jsonString = json_encode($tabla,JSON_UNESCAPED_UNICODE);
                //echo '{"Data":['.$jsonString.']}';
                echo $jsonString;
            break;
        case "post":
                $centroCosto = $_POST['centroCosto'];
                $beneficiario= $_POST['nombreBeneficiario'];
                $monto= $_POST['monto'];
                $FechaFactura = $_POST['fechaFact'];
                $tipoSol = $_POST['cmbTipoSol'];
                $concepto= $_POST['txtConcepto'];
                $esDolar=$_POST['rdbEsDol'];
                $estadoSol=$_POST['cmbEstadoSol'];
                $action="Registrar";
                
                $fechaReg=date('Y-m-d H:m:s');
                $fechaAsientoContable=null;
                $NumCheque=null;
                $asiento=null;

                $usuario1='';
                $fechaUpt='';
                $anulado=0;
                $flgAsientoGenerado=0;

                $consulta="SELECT max(IdSolicitud) as IdSolicitud FROM fnica.reiSolicitudReintegroDePago";
                
                $result=sqlsrv_query($conexion,$consulta);
                while($item = sqlsrv_fetch_array($result)){
                    $IdSolicitud = $item['IdSolicitud'];
                }
                $IdSolicitud=$IdSolicitud+1;
                $sql = "INSERT INTO fnica.reiSolicitudReintegroDePago 
                (IdSolicitud,CENTRO_COSTO,FechaSolicitud,Monto,TipoPago,Beneficiario,Concepto,EsDolar,CodEstado,Usuario,FECHAREGISTRO,Asiento,CUENTA_BANCO,NumCheque,Anulada,flgAsientoGenerado,FechaAsientoContable,USUARIO1,FECHAUPDATE)
                        values('$IdSolicitud','$centroCosto','$FechaFactura','$monto','$tipoSol','$beneficiario','$concepto','$esDolar','$estadoSol','$usuario','$fechaReg','$asiento','','$NumCheque','$anulado','$flgAsientoGenerado','$fechaAsientoContable','$usuario1','$fechaUpt')";
                if(sqlsrv_query($conexion,$sql)){
                    echo $IdSolicitud;
                    $contingencia->logContig($table,$usuario,$action." ".$IdSolicitud,$initialVal,$finalVal,$ip,$conexion);
                }else {
                    echo "2";
                }
            break;
        case "put":
                $CentroCosto = $_POST['CentroCosto'];
                $Monto = $_POST['Monto'];
                $action="Actualizar";
                
                $consultarSol="SELECT CENTRO_COSTO,Monto FROM fnica.reiSolicitudReintegroDePago where IdSolicitud='$IdSolicitud'";
                $result=sqlsrv_query($conexion,$consultarSol);
                while($item = sqlsrv_fetch_array($result)){
                    $CentroCostoSolicitud = $item['CENTRO_COSTO'];
                    $MontoSolicitud = $item['Monto'];
                }

                $sql = "UPDATE fnica.reiSolicitudReintegroDePago 
                    set CENTRO_COSTO = '$CentroCosto',Monto='$Monto' 
                    where IdSolicitud = '$IdSolicitud'";

                $initialVal="Centro de Costo: ".$CentroCostoSolicitud." Monto: ".$MontoSolicitud;
                $finalVal="Centro de Costo: ".$CentroCosto." Monto: ".$Monto;
                
                if(sqlsrv_query($conexion,$sql)) {
                    echo 1;
                    $contingencia->logContig($table,$usuario,$action." ".$IdSolicitud,$initialVal,$finalVal,$ip,$conexion);
                } else {
                    echo 2;
                }
            break;
        case "delete":
            break;
    }

}


