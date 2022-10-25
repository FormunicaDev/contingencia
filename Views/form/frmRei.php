<div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
              <div class="card-tools">
              <button ID="btnNuevaSolRei" type="button" class="btn btn-block btn-outline-success btn-sm" >Nueva Solicitud de Reintegro</button>
            </div>
                <br><br>
              <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="ingresar Id de Solicitud" aria-label="Recipient's username" aria-describedby="basic-addon2" id="txtSolicitud">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" id="btnBuscar" type="button">Buscar</button>
                </div>
                </div>
           
             
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=" overflow-x: scroll; height:650px">
              <table id="tblReintegro" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                <thead>
                <tr>
                  <th>IDSolicitud</th>
                  <th>Centro de Costo</th>
                  <th>Concepto</th>
                  <th>Fecha Solicitud</th>
                  <th>Monto</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>ID Solicitud</th>
                  <th>Centro de Costo</th>
                  <th>Concepto</th>
                  <th>Fecha Solicitud</th>
                  <th>Monto</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>



   <!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                 <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detalle de la Solicitud</h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=" overflow-x: scroll; height="250px"">
            <form id="frmDetalleRei" name="frmDetalleRei" method="post">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Centro de Costo</label>
                            <input type="text" class="form-control" id="centroCosto" name="centroCosto" data-inputmask='"mask": "99-99-99"' data-mask>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Cuenta Contable</label>
                            <input type="text" class="form-control" id="cuentaContable" name="cuentaContable" data-inputmask='"mask": "9-99-99-999-999"' data-mask>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Fecha Factura</label>
                            <input type="date" class="form-control" id="dtpFechaFactura" name="dtpFechaFactura">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="" class="col-form-label"># Factura</label>
                            <input type="text" class="form-control" id="txtNumFact" name="txtNumFact">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="" class="col-form-label">Nombre Establecimiento</label>
                            <input type="text" class="form-control" id="txtNombreEst" name="txtNombreEst">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="" class="col-form-label">Monto</label>
                            <input type="text" class="form-control" id="txtMonto" name="txtMonto">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label for="" class="col-form-label">Concepto </label>
                            <textarea rows="2" cols="50" class="form-control" id="txtConcepto" name="txtConcepto"></textarea>
                            <input type="hidden" name="txtIdSolic" id="txtIdSolic">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <button id="btnAddDetalle" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                </div>
            </form>
              <table id="tblDetalleReintegro" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                <thead>
                <tr>
                  <th>ID</th>
                  <th>CENTRO COSTO</th>
                  <th>Cuenta Contable</th>
                  <th>Linea</th>
                  <th>Concepto</th>
                  <th>Fecha Factura</th>
                  <th>Monto</th>
		  <th>Factura</th>
		  <th>Establecimiento</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>CENTRO COSTO</th>
                  <th>Cuenta Contable</th>
                  <th>Linea</th>
                  <th>Concepto</th>
                  <th>Fecha Factura</th>
                  <th>Monto</th>
		  <th>Factura</th>
		  <th>Establecimiento</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>
               
                             
            </div>
            <div id="progresSave"></div>
            <div class="modal-footer">

                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div> 


<div class="modal fade" id="modalCRUD2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                 <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ingresar Solicitud</h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=" overflow-x: scroll; height:380px">
            <div style="width:100%">
                <img id="cargando" src="Views/img/cargando7.gif" style=" height: 150px;margin-left: auto;
                        margin-right: auto;
                        display: block;">
            </div>
            <form id="frmReintegro" name="frmReintegro" method="post"></form>
            <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Centro de Costo</label>
                            <input type="text" class="form-control" id="centroCosto" name="centroCosto" data-inputmask='"mask": "99-99-99"' data-mask>
                        </div>
                    </div>
                    <!-- 
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Cuenta Contable</label>
                            <input type="text" class="form-control" id="cuentaContable" name="cuentaContable" data-inputmask='"mask": "9-99-99-999-999"' data-mask>
                        </div> 
                    </div>  
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="" class="col-form-label"># Factura</label>
                            <input type="text" class="form-control" id="numFactura" name="numFactura">
                        </div> 
                    </div>   -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">Beneficiario</label>
                            <input type="text" class="form-control" id="nombreBeneficiario" name="nombreBeneficiario">
                        </div> 
                    </div> 
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="" class="col-form-label">Monto</label>
                            <input type="text" class="form-control" id="monto" name="monto">
                        </div> 
                    </div> 
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Fecha Solicitud</label>
                            <input type="date" class="form-control" id="fechaFact" name="fechaFact">
                        </div> 
                    </div> 
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="" class="col-form-label">Tipo Solicitud</label>
                            <select class="select2" id="cmbTipoSol" name="cmbTipoSol">
                            </select>
                        </div> 
                    </div> 
                    <div class="col-lg-3">
                        <label for="" class="col-form-label">Estado de Solicitud</label>
                        <select class="select2" id="cmbEstadoSol" name="cmbEstadoSol">
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="" class="col-form-label">Moneda</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rdbEsDol" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">Dolar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rdbEsDol" id="inlineRadio2" value="0">
                            <label class="form-check-label" for="inlineRadio2">Cordoba</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-12">    
                        <div class="form-group">
                        <label for="" class="col-form-label">Concepto </label>
                        <textarea rows="4" cols="50" class="form-control" id="txtConcepto" name="txtConcepto"></textarea>
                        </div>            
                    </div> 
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>
               
                             
            </div>
            <div id="progresSave"></div>
            <div class="modal-footer">
            <button type="button" id="btnGuardarRei" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div> 

<div class="modal fade" id="modalCRUD3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                 <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Actualizar Solicitud</h3> -
              <label id="lblSolicitud" for="">Solicitud</label>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=" overflow-x: scroll; height: 150px;">
            <form id="frmReintegroUpt" name="frmReintegroUpt" method="post"></form>
            <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Centro de Costo</label>
                            <input type="text" class="form-control" id="centroCostoUpt" name="centroCostoUpt" data-inputmask='"mask": "99-99-99"' data-mask>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Monto</label>
                            <input type="text" class="form-control" id="montoUpt" name="montoUpt">
                            <input type="hidden" name="idUpt" id="idUpt">
                        </div> 
                    </div>
            </div> 
                    
                </div>
                
            </div>
          </div>
        </div>
               
                             
            </div>
            <div id="progresSave"></div>
            <div class="modal-footer">
            <button type="button" id="btnActualizarRei" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div> 