<?php
date_default_timezone_set('America/Managua');


class contingencia {
    public function logContig($table,$users,$action,$initialVal,$finalVal,$Ip,$conexion) {
        $fechaReg=date('Y-m-d H:m:s');
        $sql = "INSERT INTO LogContingencia 
        (TableName,Users,Accion,InitialValue,FinalValue,Ip,RegisterDate)
        values('$table','$users','$action','$initialVal','$finalVal','$Ip','$fechaReg')";
        
        sqlsrv_query($conexion,$sql);
    }
}
