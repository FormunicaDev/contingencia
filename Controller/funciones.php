<?php
date_default_timezone_set('America/Managua');

class sysCobro {
    public function actualizarPlazoCCF($documento,$plazo,$codSucursal,$conexion) {
        $sql = "UPDATE fnica.ccfDocumentosCC 
        set Plazo=$plazo,Vencimiento=dateadd(day,$plazo,Fecha),VencimientoVar=dateadd(day,$plazo,Fecha)
        where Documento='$documento' and CodSucursal='$codSucursal'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function actualizarPlazoFact($plazo,$documento,$codSucursal,$conexion) {
        $sql="UPDATE fnica.fafFACTURA
        set FECHAVENCIMIENTO=dateadd(day,$plazo,FECHAFACTURA)
        where FACTURA = '$documento' and CODSUCURSAL = '$codSucursal'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function mostrarFactura($documento,$CodCliente,$codSucursal,$conexion) {
        $sql = "SELECT a.*,b.NOMBRESCLIENTE+' '+b.APELLIDOSCLIENTE as Cliente
            FROM fnica.ccfDocumentosCC a
            join fnica.ccfCLIENTES b
            on a.CodCliente=b.CODCLIENTE
            where a.Documento='$documento' and a.CodCliente='$CodCliente' and a.CodSucursal='$codSucursal'";

            $result = sqlsrv_query($conexion,$sql);

            
            $tabla= array();

            while($item = sqlsrv_fetch_array($result)){
                $tabla[] = array (
                    'IDDocumentoCC' => $item['IDDocumentoCC'],
                    'CodCliente' => $item['CodCliente'],
                    'Cliente' => $item['Cliente'],
                    'CodSucursal' => $item['CodSucursal'],
                    'Documento' => $item['Documento'],
                    'Plazo' => $item['Plazo'],
                    'Fecha' => $item['Fecha']->format('Y-m-d'),
                    'Vencimiento' => $item['Vencimiento']->format('Y-m-d'),
                    'VencimientoVar' => $item['VencimientoVar']->format('Y-m-d'),
                    'MontoOriginal' => $item['MontoOriginal'],
                    'SaldoActual' => $item['SaldoActual'],
                    'PorcInteres' => $item['PorcInteres'],
                    'Asiento' => $item['Asiento']
                );
            }
            
            $jsonString = json_encode($tabla);
            return $jsonString;
    }
}


class permisos {
    public function tienePermiso($usuario,$role,$conexion) {
        $sql = "SELECT *
        from fnica.secUSUARIOROLE
        where USUARIO='$usuario' and IDROLE=$role";

        $result = sqlsrv_query($conexion,$sql);

        $data = array();
        $IdRole = '';

        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'IDRole' => $item['IDROLE'],
                'USUARIO' => $item['USUARIO'],
                'IdModulo' => $item['IDMODULO']
            );
            $IdRole = $item['IDROLE'];
            
        }
        
        if($IdRole != 0) {
            return true;
        } else {
            return false;
        }

    }
}


class factura {
    public function buscarFactura($factura,$sucursal,$conexion) {
        $sql = "SELECT a.FACTURA,a.CODCLIENTE,b.NOMBRESCLIENTE+' '+b.APELLIDOSCLIENTE as Cliente,
        a.CODSUCURSAL,c.SUCURSAL,a.CODVENDEDOR, d.NOMBRESVENDEDOR,a.TIPOPAGO,a.SUBTOTAL,a.DESCUENTO,
        a.TOTALFACTURA,a.FECHAFACTURA
        from fnica.fafFACTURA a
        join fnica.ccfCLIENTES b
        on a.CODCLIENTE=b.CODCLIENTE
        join fnica.GlobalSucursales c
        on a.CODSUCURSAL=c.CODSUCURSAL
        join fnica.globalVENDEDORES d
        on a.CODVENDEDOR=d.CODVENDEDOR
        where FACTURA=$factura and a.CODSUCURSAL='$sucursal'";

        $result=sqlsrv_query($conexion,$sql);
        $data = array();


        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'FACTURA' => $item['FACTURA'],
                'CODCLIENTE' => $item['CODCLIENTE'],
                'Cliente' => $item['Cliente'],
                'CODSUCURSAL' => $item['CODSUCURSAL'],
                'SUCURSAL' => $item['SUCURSAL'],
                'CODVENDEDOR' => $item['CODVENDEDOR'],
                'NOMBRESVENDEDOR' => $item['CODVENDEDOR']."-".$item['NOMBRESVENDEDOR'],
                'TIPOPAGO' => $item['TIPOPAGO'],
                'SUBTOTAL' => $item['SUBTOTAL'],
                'DESCUENTO' => $item['DESCUENTO'],
                'TOTALFACTURA' => $item['TOTALFACTURA'],
                'FECHAFACTURA' => $item['FECHAFACTURA']->format('Y-m-d'),
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;

    }

    public function detalleFactura($factura,$sucursal,$conexion) {
        $sql = "SELECT a.CODSUCURSAL,b.Descr,a.ARTICULO,c.DESCRIPCION,a.CODCLIENTE,
        a.CANTIDAD,a.PRECIOUNITARIODOLAR,a.SUBTOTALDOLAR,a.TOTALDOLAR,a.LOTE
        from fnica.fafFACTURADETALLE a
        join fnica.fafTIPO b
        on a.TIPO=b.Tipo
        join fnica.ARTICULO c
        on a.ARTICULO=c.ARTICULO
        where FACTURA=$factura and CODSUCURSAL='$sucursal';";

        $result = sqlsrv_query($conexion,$sql);

        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'CODSUCURSAL' => $item['CODSUCURSAL'],
                'TipoFact' => $item['Descr'],
                'ARTICULO' => $item['ARTICULO'],
                'NombreArticulo' => $item['DESCRIPCION'],
                'CODCLIENTE' => $item['CODCLIENTE'],
                'CANTIDAD' => $item['CANTIDAD'],
                'PRECIOUNITARIODOLAR' => $item['PRECIOUNITARIODOLAR'],
                'SUBTOTALDOLAR' => $item['SUBTOTALDOLAR'],
                'TOTALDOLAR' => $item['TOTALDOLAR'],
                'LOTE' => $item['LOTE']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;

    }

    public function buscarFacturaVendedor($factura,$codSucursal,$conexion) {
        $sql = "SELECT * 
        FROM fnica.fafFactura 
        where FACTURA = $factura and CODSUCURSAL='$codSucursal'";

        $result= sqlsrv_query($conexion,$sql);

        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array(
                'CODSUCURSAL' => $item['CODSUCURSAL'],
                'FACTURA' => $item['FACTURA'],
                'FECHAFACTURA' => $item['FECHAFACTURA']->format('Y-m-d'),
                'CODCLIENTE' => $item['CODCLIENTE'],
                'CLIENTE' => $item['CLIENTE'],
                'TIPOPAGO' => $item['TIPOPAGO'],
                'CODVENDEDOR' => $item['CODVENDEDOR'],
                'SUBTOTAL' => $item['SUBTOTAL'],
                'TOTALFACTURA' => $item['TOTALFACTURA']
            );
        } 

        $jsonString = json_encode($data);
        return $jsonString;
    }

    public function actualizarCodVendedorFact($factura,$codSucursal,$codVendedor,$conexion) {
        $sql = "UPDATE fnica.fafFactura 
        set CODVENDEDOR = '$codVendedor'
        where FACTURA = $factura and CODSUCURSAL = '$codSucursal'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }
}

class diario {
    
    public function buscarDiario($diario,$sucursal,$conexion) {
        
        $sql = "SELECT *
        from fnica.fafDIARIO
        where NUMEROCONSECUTIVO=$diario and CODSUCURSAL='$sucursal'";

        $result = sqlsrv_query($conexion,$sql);

        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'CODSUCURSAL' => $item['CODSUCURSAL'],
                'NUMEROCONSECUTIVO' => $item['NUMEROCONSECUTIVO'],
                'EFECTIVOCORDOBA' => $item['EFECTIVOCORDOBA'],
                'EFECTIVODOLAR' => $item['EFECTIVODOLAR'],
                'CHEQUECORDOBA' => $item['CHEQUECORDOBA'],
                'CHEQUEDOLAR' => $item['CHEQUEDOLAR'],
                'OTROS' => $item['OTROS'],
                'TIPOCAMBIO' => $item['TIPOCAMBIO'],
                'RETENCION' => $item['RETENCION'],
                'OTROSDOLAR' => $item['OTROSDOLAR']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;

    }

    public function detalleDiario($diario,$sucursal,$conexion) {
        $sql = "SELECT a.LINEA,a.CODSUCURSAL,a.FECHACIERRE,a.NUMEROCONSECUTIVO,a.NOMBRECLIENTE,
        c.DESCRIPCION as BancoEmisor,a.BANCORECEPTOR,a.NUMERODEPOSITO,a.MONTOCORDOBA,
        a.MONTODOLAR,b.DESCRIPCION as TipoPago,a.NUMERODOCUMENTO
        from fnica.fafDIARIODETALLE a
        join fnica.fafTIPOSPAGO b
        on a.TIPOPAGO=b.TIPOPAGO
        join fnica.fafBANCOS c
        on a.BANCOEMISOR = c.CODBANCO
        where NUMEROCONSECUTIVO='$diario' and CODSUCURSAL='$sucursal';";

        $result = sqlsrv_query($conexion,$sql);

        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'LINEA' => $item['LINEA'],
                'CODSUCURSAL' => $item['CODSUCURSAL'],
                'FECHACIERRE' => $item['FECHACIERRE'],
                'NUMEROCONSECUTIVO' => $item['NUMEROCONSECUTIVO'],
                'TipoPago' => $item['TipoPago'],
                'NOMBRECLIENTE' => $item['NOMBRECLIENTE'],
                'BancoEmisor' => $item['BancoEmisor'],
                'BANCORECEPTOR' => $item['BANCORECEPTOR'],
                'NUMERODEPOSITO' => $item['NUMERODEPOSITO'],
                'MONTOCORDOBA' => $item['MONTOCORDOBA'],
                'MONTODOLAR' => $item['MONTODOLAR'],
                'NUMERODOCUMENTO' => $item['NUMERODOCUMENTO']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;
    }

    

    public function registrarDiarioDetalle($consecutivo,$sucursal,$monto,$moneda,$cliente,$bancoEmisor,$bancoReceptor,$fechaCierre,$diario,$conexion,$tipoPago,$documento,$deposito) {
        $montoCordoba = 0;
        $montoDolar = 0;
        $Linea = $this->obtenerUltimaLinea($diario,$sucursal,$conexion);

        switch($moneda)
        {
            case 'dol':
                    $montoDolar = $monto;
                break;
            case 'cor':
                    $montoCordoba = $monto;
                break;
        }

        $sql = "INSERT INTO fnica.fafDIARIODETALLE 
        (LINEA,CODSUCURSAL,FECHACIERRE,NUMEROCONSECUTIVO,TIPOPAGO,BANCOEMISOR,NUMERODOCUMENTO,NOMBRECLIENTE,BANCORECEPTOR,NUMERODEPOSITO,MONTOCORDOBA,MONTODOLAR)
        values('$Linea','$sucursal','$fechaCierre',$consecutivo,'$tipoPago','$bancoEmisor','$documento','$cliente','$bancoReceptor','$deposito','$montoCordoba','$montoDolar')";

        if(sqlsrv_query($conexion,$sql)) {
            return $this->actualizarMontosDiario($consecutivo,$sucursal,$moneda,$monto,$tipoPago,$conexion);
            
        } else {
            return 2;
        }


    }

    private function obtenerUltimaLinea($diario,$sucursal,$conexion) {
        $sql = "SELECT LINEA 
        FROM fnica.fafDIARIODETALLE
        where NUMEROCONSECUTIVO='$diario' and CODSUCURSAL='$sucursal';";

        $result = sqlsrv_query($conexion,$sql);
        $Linea = '';

        while($item = sqlsrv_fetch_array($result)) {
            $Linea = $item['LINEA'];
            
        }
        $Linea=$Linea+1;

        return $Linea;

    }

    private function actualizarMontosDiario($consecutivo,$sucursal,$moneda,$monto,$tipoPago,$conexion) {

        /* declaracion de variables para los nuevos montos */
        $efectivoCordoba = 0;
        $efectivoDolar = 0;
        $chequeCordoba = 0;
        $chequeDolar = 0;
        $otros = 0;
        $otrosDolar = 0;

        /* variables para recuperar datos del fafdiario  */
        $cordobaEF = 0;
        $dolarEF = 0;
        $cordobaCHK = 0;
        $dolarCHK = 0;
        $otrosMontos = 0;
        $otrosMontosDol = 0;

        /*consultar a la base de datos los montos actuales del diario */ 
        $consultaMontos = "SELECT * 
        FROM fnica.fafDIARIO 
        where NUMEROCONSECUTIVO = '$consecutivo' and CODSUCURSAL = '$sucursal'";

        $resultMontos = sqlsrv_query($conexion,$consultaMontos);

        while($item = sqlsrv_fetch_array($resultMontos)) {
            $cordobaEF = $item['EFECTIVOCORDOBA'];
            $dolarEF = $item['EFECTIVODOLAR'];
            $cordobaCHK = $item['CHEQUECORDOBA'];
            $dolarCHK = $item['CHEQUEDOLAR'];
            $otrosMontos = $item['OTROS'];
            $otrosMontosDol = $item['OTROSDOLAR'];            
        }

        switch($tipoPago)
        {
            case 'AN':
                break;
            case 'CK':
                    if($moneda=='dol')
                    {
                        $chequeDolar =  $monto;
                    } else {
                        $chequeCordoba = $monto;
                    }
                break;
            case 'EF':
                    if($moneda=='dol') {
                        $efectivoDolar = $monto;
                    } else {
                        $efectivoCordoba = $monto;
                    }
                break;
            case 'GB':
                break;
            case 'NC':
                break;
            case 'OT':
                    if($moneda=='dol') {
                        $otrosDolar = $monto;
                    } else {
                        $otros = $monto;
                    }
                break;
            case 'RT':
                break;
            case 'TB':
                    if($moneda=='dol') {
                        $otrosDolar = $monto;
                    } else {
                        $otros = $monto;
                    }
                break;
            case 'TC':
                    if($moneda=='dol') {
                        $otrosDolar = $monto;
                    } else {
                        $otros = $monto;
                    }
                break;
        }

        $cordobaEF = $cordobaEF + $efectivoCordoba;
        $dolarEF = $dolarEF + $efectivoDolar;
        $cordobaCHK = $cordobaCHK + $chequeCordoba;
        $dolarCHK = $dolarCHK + $chequeDolar;
        $otrosMontos = $otrosMontos + $otros; 
        $otrosMontosDol = $otrosMontosDol + $otrosDolar;

        $sqlUpdate = "UPDATE fnica.fafDIARIO
        set EFECTIVOCORDOBA = $cordobaEF,EFECTIVODOLAR=$dolarEF,CHEQUECORDOBA=$cordobaCHK,CHEQUEDOLAR=$dolarCHK,OTROS=$otrosMontos,OTROSDOLAR=$otrosMontosDol
        where NUMEROCONSECUTIVO='$consecutivo' and CODSUCURSAL='$sucursal'";

        if(sqlsrv_query($conexion,$sqlUpdate)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function eliminarLineaDiario($linea,$sucursal,$consecutivo,$deposito,$conexion) {
        $sql = "DELETE FROM fnica.fafDIARIODETALLE 
        where LINEA=$linea and CODSUCURSAL = '$sucursal' and NUMEROCONSECUTIVO='$consecutivo' and NUMERODEPOSITO = $deposito";

        $this->recalcularDiarioAnulado($consecutivo,$sucursal,$conexion,$linea);
        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    private function recalcularDiarioAnulado($consecutivo,$sucursal,$conexion,$linea) {
        $consultaDetalle  = "SELECT LINEA,CODSUCURSAL,NUMEROCONSECUTIVO,TIPOPAGO,
        MONTOCORDOBA,MONTODOLAR 
        FROM fnica.fafDIARIODETALLE 
        where NUMEROCONSECUTIVO='$consecutivo' and CODSUCURSAL='$sucursal' and LINEA=$linea";

        $consultaDiario = "SELECT EFECTIVOCORDOBA,EFECTIVODOLAR,CHEQUECORDOBA,CHEQUEDOLAR,
        OTROS,OTROSDOLAR,RETENCION
        FROM fnica.fafDIARIO where NUMEROCONSECUTIVO='$consecutivo' and CODSUCURSAL='$sucursal'";

        $resultDetail = sqlsrv_query($conexion,$consultaDetalle);
        $resultDiario = sqlsrv_query($conexion,$consultaDiario);

        /* variables del diario */
        $efectivoCordoba = 0;
        $efectivoDolar = 0;
        $chequeCordoba = 0;
        $chequeDolar = 0;
        $otros = 0;
        $otrosDolar = 0;
        $retencion = 0;

        $montoCordoba = 0;
        $montoDolar = 0;
        $tipoPago = '';

        while($item = sqlsrv_fetch_array($resultDetail)) {
            $montoCordoba = $item['MONTOCORDOBA'];
            $montoDolar = $item['MONTODOLAR'];
            $tipoPago = $item['TIPOPAGO'];
        }

        while($item = sqlsrv_fetch_array($resultDiario)) {
            $efectivoCordoba = $item['EFECTIVOCORDOBA'];
            $efectivoDolar = $item['EFECTIVODOLAR'];
            $chequeCordoba = $item['CHEQUECORDOBA'];
            $chequeDolar = $item['CHEQUEDOLAR'];
            $otros = $item['OTROS'];
            $otrosDolar = $item['OTROSDOLAR'];    
            $retencion = $item['RETENCION'];        
        }

        switch($tipoPago)
        {
            case 'AN':
                break;
            case 'CK':
                    $chequeCordoba=$chequeCordoba-$montoCordoba;
                    $chequeDolar=$chequeDolar-$montoDolar;
                break;
            case 'EF':
                   $efectivoCordoba=$efectivoCordoba-$montoCordoba;
                   $efectivoDolar=$efectivoDolar-$montoDolar;
                break;
            case 'GB':
                break;
            case 'NC':
                break;
            case 'OT':
                   $otrosDolar=$otrosDolar-$montoDolar;
                   $otros=$otros-$montoCordoba;
                break;
            case 'RT':
                    $retencion=$retencion-$montoCordoba;
                break;
            case 'TB':
                    $otrosDolar=$otrosDolar-$montoDolar;
                    $otros=$otros-$montoCordoba;
                break;
            case 'TC':
                    $otrosDolar=$otrosDolar-$montoDolar;
                    $otros=$otros-$montoCordoba;
                break;
        }

        $sqlUpt = "UPDATE fnica.fafDIARIO 
        set EFECTIVOCORDOBA=$efectivoCordoba,EFECTIVODOLAR=$efectivoDolar,CHEQUECORDOBA=$chequeCordoba,
        CHEQUEDOLAR=$chequeDolar,OTROS=$otros,RETENCION=$retencion,OTROSDOLAR=$otrosDolar
        where NUMEROCONSECUTIVO='$consecutivo' and CODSUCURSAL='$sucursal'";

       
        if(sqlsrv_query($conexion,$sqlUpt))
        {
            return 1;
        } else {
            return 0;
        }

        
    }

    public function updateMontosDiario($diario,$sucursal,$montos,$conexion) {
        list('EF' => $EF,'EFD'=>$EFD,'CHK'=>$CHK,'CHKD'=>$CHKD,'OTRO'=>$OTRO,'OTROD'=>$OTROD,'RETENCION'=>$RETENCION) = $montos;

        $sql = "UPDATE fnica.fafDiario
        set EFECTIVOCORDOBA=$EF,EFECTIVODOLAR=$EFD,CHEQUECORDOBA=$CHK,CHEQUEDOLAR=$CHKD,OTROS=$OTRO,RETENCION=$RETENCION,OTROSDOLAR=$OTROD
        where numeroconsecutivo=$diario and codSucursal='$sucursal'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }


    }

    public function actualizarDiarioDetalle($diario,$sucursal,$linea,$montoCordoba,$montoDolar,$tipoPago,$conexion) {
        $sql = "UPDATE fnica.fafDiarioDetalle
        set MONTOCORDOBA=$montoCordoba,MONTODOLAR=$montoDolar
        where NUMEROCONSECUTIVO='$diario' and CODSUCURSAL = '$sucursal' and LINEA='$linea'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }
}

class clientes {
    public function listarClientes($conexion) {
        $sql = "SELECT top 100 a.CODCLIENTE,a.APELLIDOSCLIENTE,
        a.NOMBRESCLIENTE,a.FECHAINGRESO,a.DIRECCION,a.TELEFONO1,
        a.CEDULA,b.SUCURSAL,a.CODVENDEDOR,a.TECHOCREDITO,a.PLAZODIAS
            FROM fnica.ccfClientes a
            join fnica.GLOBALSUCURSALES b
            on a.CODSUCURSAL = b.CODSUCURSAL
            where a.NOMBRESCLIENTE not in ('',' ','O','OOO')
            order by a.FECHAINGRESO desc";

        $result = sqlsrv_query($conexion,$sql);
        
        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'CODCLIENTE' => $item['CODCLIENTE'],
                'NOMBRESCLIENTE' => $item['NOMBRESCLIENTE'],
                'APELLIDOSCLIENTE' => $item['APELLIDOSCLIENTE'],
                'FECHAINGRESO' => $item['FECHAINGRESO'],
                'DIRECCION' => $item['DIRECCION'],
                'TELEFONO1' => $item['TELEFONO1'],
                'CEDULA' => $item['CEDULA'],
                'SUCURSAL' => $item['SUCURSAL'],
                'CODVENDEDOR' => $item['CODVENDEDOR'],
                'TECHOCREDITO' => $item['TECHOCREDITO'],
                'PLAZODIAS' => $item['PLAZODIAS']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;
    }

    public function buscarCliente($cliente,$conexion) {
        $sql = "SELECT a.CODCLIENTE,a.APELLIDOSCLIENTE,a.NOMBRESCLIENTE,
        a.FECHAINGRESO,a.DIRECCION,a.TELEFONO1,a.CEDULA,b.SUCURSAL,a.CODVENDEDOR,a.TECHOCREDITO,a.PLAZODIAS
        FROM fnica.ccfClientes a
        join fnica.GLOBALSUCURSALES b
        on a.CODSUCURSAL = b.CODSUCURSAL
        where CODCLIENTE = '$cliente'";

        $result = sqlsrv_query($conexion,$sql);
                
        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'CODCLIENTE' => $item['CODCLIENTE'],
                'NOMBRESCLIENTE' => $item['NOMBRESCLIENTE'],
                'APELLIDOSCLIENTE' => $item['APELLIDOSCLIENTE'],
                'FECHAINGRESO' => $item['FECHAINGRESO']->format('Y-m-d'),
                'DIRECCION' => $item['DIRECCION'],
                'TELEFONO1' => $item['TELEFONO1'],
                'CEDULA' => $item['CEDULA'],
                'SUCURSAL' => $item['SUCURSAL'],
                'CODVENDEDOR' => $item['CODVENDEDOR'],
                'TECHOCREDITO' => $item['TECHOCREDITO'],
                'PLAZODIAS' => $item['PLAZODIAS']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;

    }

    public function actualizarCliente($infoCliente,$codCliente,$conexion){
        // fafgetvalidate
        list('nombre' => $nombre,'apellido'=>$apellido,'cedula'=>$cedula,'telefono'=>$telefono,'direccion'=>$direccion) = $infoCliente;

        $sql = "UPDATE fnica.ccfClientes
        set  NOMBRESCLIENTE = '$nombre',APELLIDOSCLIENTE='$apellido',TELEFONO1=$telefono,DIRECCION='$direccion'
        where CODCLIENTE='$codCliente'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function solicitudCambioPlazo($plazo,$codCliente,$usuario,$conexion) {
        $estado = "Ingresado";
        $sql = "INSERT INTO solicitudCambioPlazoCliente (codCliente,Plazo,Estado,UsuarioSolicitud) 
        values ('$codCliente','$plazo','$estado','$usuario')";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 2;
        }
    }

    public function solicitudCambioTechoCredito($techoCredito,$codCliente,$usuario,$conexion) {
        $estado = "Ingresado";
        $sql = "INSERT INTO solicitudCambioTechoCredito (codCliente,TechoCredito,Estado,UsuarioSolicitud)
        values('$codCliente','$techoCredito','$estado','$usuario')";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 2;
        }
    }

    public function listarSolicitudes($role,$usuario,$conexion) {
        if($role == '9005') {
            $sql = "SELECT * FROM solicitudCambioPlazoCliente 
            where UsuarioSolicitud = '$usuario'";
        } else {
            $sql = "SELECT * FROM solicitudCambioPlazoCliente 
            where Estado= 'Ingresado'";
        }
        

        $result = sqlsrv_query($conexion,$sql);
                
        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'Id' => $item['Id'],
                'codCliente' => $item['codCliente'],
                'Plazo' => $item['Plazo'],
                'Estado' => $item['Estado'],
                'UsuarioSolicitud' => $item['UsuarioSolicitud']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;

    }

    public function listarSolicitudesTechoCredito($role,$usuario,$conexion) {
        if($role == '9005') {
            $sql = "SELECT * FROM solicitudCambioTechoCredito 
            where UsuarioSolicitud = '$usuario'";
        } else {
            $sql = "SELECT * FROM solicitudCambioTechoCredito 
            where Estado= 'Ingresado'";
        }
        

        $result = sqlsrv_query($conexion,$sql);
                
        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'Id' => $item['Id'],
                'codCliente' => $item['codCliente'],
                'TechoCredito' => $item['TechoCredito'],
                'Estado' => $item['Estado'],
                'UsuarioSolicitud' => $item['UsuarioSolicitud']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;

    }

    public function procesarSolicitud($codCliente,$IdSolicitud,$aprobacion,$plazo,$conexion,$usuario) {
        switch($aprobacion)
        {
            case 1:
                    $fechaActualizacion = date('Y-m-d H:i:s');

                    $sql = "UPDATE fnica.ccfClientes 
                    set PLAZODIAS = $plazo
                    where CODCLIENTE = '$codCliente' ";

                    $upt = "UPDATE solicitudCambioPlazoCliente
                    set Estado = 'Aprobado',FechaActualizacion='$fechaActualizacion',UsuarioAprobacion='$usuario'
                    where Id = $IdSolicitud";

                    if(sqlsrv_query($conexion,$sql)) {
                        sqlsrv_query($conexion,$upt);
                        return 1;
                    } else {
                       
                        return 0;
                    }
                break;
            case 2:
                    $fechaActualizacion = date('Y-m-d H:i:s');

                    $upt = "UPDATE solicitudCambioPlazoCliente
                    set Estado = 'Rechazado',FechaActualizacion='$fechaActualizacion',UsuarioAprobacion='$usuario'
                    where Id = $IdSolicitud";

                    if(sqlsrv_query($conexion,$upt)) {
                        return 1;
                    } else {
                        return 0;
                    }
                break;
        }
    }

    public function procesarSolicitudTechoCredito($codCliente,$IdSolicitud,$aprobacion,$techoCredito,$conexion,$usuario) {
        switch($aprobacion)
        {
            case 1:
                    $fechaActualizacion = date('Y-m-d H:i:s');

                    $sql = "UPDATE fnica.ccfClientes 
                    set TECHOCREDITO = $techoCredito
                    where CODCLIENTE = '$codCliente' ";

                    $upt = "UPDATE solicitudCambioTechoCredito
                    set Estado = 'Aprobado',FechaActualizacion='$fechaActualizacion',UsuarioAprobacion='$usuario'
                    where Id = $IdSolicitud";

                    if(sqlsrv_query($conexion,$sql)) {
                        sqlsrv_query($conexion,$upt);
                        return 1;
                    } else {
                       
                        return 0;
                    }
                break;
            case 2:
                    $fechaActualizacion = date('Y-m-d H:i:s');

                    $upt = "UPDATE solicitudCambioTechoCredito
                    set Estado = 'Rechazado',FechaActualizacion='$fechaActualizacion',UsuarioAprobacion='$usuario'
                    where Id = $IdSolicitud";

                    if(sqlsrv_query($conexion,$upt)) {
                        return 1;
                    } else {
                        return 0;
                    }
                break;
        }
    }

}