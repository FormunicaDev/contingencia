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
    $table = 'reiSolicitudReintegroDePagoDetalle';
    $action = '';
    $initialVal='';
    $finalVal='';
    $ip = $_SERVER['REMOTE_ADDR'];
    $contingencia = new contingencia();

    switch($opcion) {
        case "get":
                $sql="SELECT * FROM fnica.reiSolicitudReintegroDePagoDetalle where IdSolicitud='$IdSolicitud'";

                $result=sqlsrv_query($conexion,$sql);

                $action='consultar '.$IdSolicitud;
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

                $tabla= array();
                
                while($item = sqlsrv_fetch_array($result)){
                    $tabla[] = array (
                        'IdSolicitud' => $item['IdSolicitud'],
                        'CENTRO_COSTO' => $item['CENTRO_COSTO'],
                        'Cuenta_Contable' => $item['Cuenta_Contable'],
                        'Linea' => $item['Linea'],
                        'Concepto' => $item['Concepto'],
                        'FechaFactura' => $item['FechaFactura']->format('Y-m-d'),
                        'Monto' => $item['Monto'],
                        'Factura' => $item['NumeroFactura'],
                        'Establecimiento' => $item['NombreEstablecimiento_Persona']
                    );
                }
                
                $jsonString = json_encode($tabla);
                echo $jsonString;
            break;
        case "post":
                $IdSolicitud = $_POST['txtIdSolic'];
                $CentroCosto = $_POST['centroCosto'];
                $CuentaContable = $_POST['cuentaContable'];
                $FechaFactura = $_POST['dtpFechaFactura'];
                $NumFactura = $_POST['txtNumFact'];
                $NombreEstablecimiento = $_POST['txtNombreEst'];
                $monto = $_POST['txtMonto'];
                $concepto = $_POST['txtConcepto'];

                $consulta="SELECT max(Linea) as Linea from fnica.reiSolicitudReintegroDePagoDetalle where IdSolicitud='$IdSolicitud'";
                $consultaSolicitud="SELECT Monto from fnica.reiSolicitudReintegroDePago where IdSolicitud='$IdSolicitud'";
                $consultarMonto="SELECT sum(Monto) as Total from fnica.reiSolicitudReintegroDePagoDetalle where IdSolicitud='$IdSolicitud'";

                $result = sqlsrv_query($conexion,$consulta);
                $resultSol = sqlsrv_query($conexion,$consultaSolicitud);
                $resultMonto=sqlsrv_query($conexion,$consultarMonto);

                while($item = sqlsrv_fetch_array($result)){
                    $Linea = $item['Linea'];
                }
                while($i = sqlsrv_fetch_array($resultMonto)){
                    $MontoActual = $i['Total'];
                }
                while($it = sqlsrv_fetch_array($resultSol)) {
                    $MontoSolicitud = $it['Monto'];
                }

                $MontoPrevisto = $MontoActual+$monto;
                
                if($MontoPrevisto>$MontoSolicitud) {
                    $diferencia =$MontoPrevisto-$MontoSolicitud;
                    echo $diferencia;
                } else {
                    $Linea=$Linea+1;
                    $sql="INSERT INTO fnica.reiSolicitudReintegroDePagoDetalle (IdSolicitud,CENTRO_COSTO,Cuenta_Contable,Linea,Concepto,FechaFactura,NumeroFactura,NombreEstablecimiento_Persona,Monto)
                    values('$IdSolicitud','$CentroCosto','$CuentaContable','$Linea','$concepto','$FechaFactura','$NumFactura','$NombreEstablecimiento','$monto')";

                    if(sqlsrv_query($conexion,$sql)) {
                        echo 1;
                        $action='Insertar linea'.$Linea." de solicitud ".$IdSolicitud;
                        $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
                    } else {
                        echo 2;
                    }
                }

                

            break;
        case "put":
            break;
        case "delete":
                $CentroCosto = $_GET['CentroCosto'];
                $Linea = $_GET['Linea'];
                $Monto= $_GET['Monto'];

                $sql="DELETE FROM fnica.reiSolicitudReintegroDePagoDetalle 
                where IdSolicitud='$IdSolicitud' and CENTRO_COSTO = '$CentroCosto' and Linea = '$Linea' and Monto='$Monto'";

                if(sqlsrv_query($conexion,$sql)) {
                    echo 1;
                    $action="Eliminar linea ".$Linea." de solicitud ".$IdSolicitud;
                    $initialVal="Centro Costo: ".$CentroCosto." Linea: ".$Linea." Monto: ".$Monto;
                    $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
                } else {
                    echo 2;
                }
                
            break;
    }

}

