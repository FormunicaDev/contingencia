<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <div class="card-tools">
            </div>
            <div class="row">
               <div class="col-lg-2">
                  <div class="form-group">
                     <label for="" class="col-form-label">N. Diario</label>
                     <input type="text" class="form-control" placeholder="N# Diario" aria-label="Recipient's username" aria-describedby="basic-addon2" id="txtDiario">
                  </div>
               </div>
               <div class="col-lg-3">
                  <div class="form-group">
                     <label for="" class="col-form-label">Cod. Sucursal</label>
                     <select class="form-control select2" id="cmbSucursal" name="cmbSucursal"> </select>
                  </div>
               </div>
               <div class="col-lg-2">
                  <div class="form-group" style="margin-top:35px;">
                     <button  id="btnBuscar" class="btn btn-success">Buscar</button>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.card-header -->
         <div class="card-body" style=" overflow-x: scroll; height:650px">
            <table id="tblDiario" class="table table-bordered table-striped" cellspacing="0" width="100%" >
               <thead>
                  <tr>
                     <th>No. Consecutivo</th>
                     <th>Cod Sucursal</th>
                     <th>Efectivo Cordoba</th>
                     <th>Efectivo Dolar</th>
                     <th>Cheque Cordoba</th>
                     <th>Cheque Dolar</th>
                     <th>Otros</th>
                     <th>Tipo Cambio</th>
                     <th>Retencion</th>
                     <th>Otros Dolar</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
               <tfoot>
                  <tr>
                     <th>No. Consecutivo</th>
                     <th>Cod Sucursal</th>
                     <th>Efectivo Cordoba</th>
                     <th>Efectivo Dolar</th>
                     <th>Cheque Cordoba</th>
                     <th>Cheque Dolar</th>
                     <th>Otros</th>
                     <th>Tipo Cambio</th>
                     <th>Retencion</th>
                     <th>Otros Dolar</th>
                     <th></th>
                  </tr>
               </tfoot>
            </table>
         </div>
         <!-- /.card-body -->
      </div>
   </div>
</div>
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl" style="max-width: 1450px!important;" role="document">
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
                        <h3 class="card-title">Detalle del Diario</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body" style=" overflow-x: scroll; height="250px"">
                     <form id="frmDetalleReis" name="frmDetalleReis" method="post">
                        <div class="row" id="crear">
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Banco Emisor</label>
                                 <select class="form-control select2" id="cmbBancoEmisor" name="cmbBancoEmisor"> </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Banco Receptor</label>
                                 <select class="form-control select2" id="cmbBancoReceptor" name="cmbBancoReceptor"> </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Tipo de Pago</label>
                                 <select class="form-control select2" id="cmbTipoPago" name="cmbTipoPago"> </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Fecha Cierre</label>
                                 <input type="date" class="form-control" id="dtpFechaCierre" name="dtpFechaCierre">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label"># Diario</label>
                                 <input type="text" disabled class="form-control" id="txtNumDiario" name="txtNumDiario">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Nombre Cliente</label>
                                 <input type="text" class="form-control" id="txtNombreCliente" name="txtNombreCliente">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Monto</label>
                                 <input type="text" class="form-control" id="txtMonto" name="txtMonto">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Documento</label>
                                 <input type="text" class="form-control" id="txtDocumento" name="txtDocumento">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label"># Deposito</label>
                                 <input type="text" class="form-control" id="txtDeposito" name="txtDeposito">
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <label for="" class="col-form-label">Moneda</label>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" id="rdbEsDol" name="rdbEsDol"value="dol">
                                 <label class="form-check-label" for="rdbEsDol">Dolar</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" id="rdbEsCor" name="rdbEsDol"  value="cor">
                                 <label class="form-check-label" for="rdbEsCor">Cordoba</label>
                              </div>
                              <button id="btnAddDetalle" class="btn btn-success">Agregar</button>
                           </div>
                        </div>
                     </form>
                        <div class="row" id="editar">
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label"># Diario</label>
                                 <input type="text" disabled class="form-control" id="txtNumDiarioEdit" name="txtNumDiario">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label"> Linea</label>
                                 <input type="text" disabled class="form-control" id="txtLineaDiarioEdit" name="txtLineaDiario">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Nombre Cliente</label>
                                 <input type="text" class="form-control" id="txtNombreClienteEdit" name="txtNombreCliente">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Monto C$</label>
                                 <input type="text" class="form-control" id="txtMontoCorEdit" name="txtMonto">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Monto $</label>
                                 <input type="text" class="form-control" id="txtMontoDolEdit" name="txtMonto">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Documento</label>
                                 <input type="text" disabled class="form-control" id="txtDocumentoEdit" name="txtDocumento">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label"># Deposito</label>
                                 <input type="text" disabled class="form-control" id="txtDepositoEdit" name="txtDeposito">
                                 <input type="hidden" name="txtSucursalEdit" id="txtSucursalEdit">
                                 <input type="hidden" id="txtTipoPagoEdit">
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <button id="btnUptDetalle" style="margin-top:35px;" class="btn btn-success">Actualizar</button>
                              <button id="btnCancelarUpt" style="margin-top:35px;" class="btn btn-secondary">Cancelar</button>
                           </div>
                        </div>
                     <table id="tblDetalleDiario" class="table table-bordered table-striped display" cellspacing="0" width="100%" >
                        <thead>
                           <tr>
                              <th>Linea</th>
                              <th>Cod Sucursal</th>
                              <th>No. Consecutivo</th>
                              <th>Tipo Pago</th>
                              <th>Banco Emisor</th>
                              <th>No. Documento</th>
                              <th>Cliente</th>
                              <th>Banco Receptor</th>
                              <th>No. Deposito</th>
                              <th>M. Cordoba</th>
                              <th>M.Dolar</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>Linea</th>
                              <th>Cod Sucursal</th>
                              <th>No. Consecutivo</th>
                              <th>Tipo Pago</th>
                              <th>Banco Emisor</th>
                              <th>No. Documento</th>
                              <th>Cliente</th>
                              <th>Banco Receptor</th>
                              <th>No. Deposito</th>
                              <th>M. Cordoba</th>
                              <th>M.Dolar</th>
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
<div class="modal fade" id="modalUpt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl" style="max-width: 1350px!important;" role="document">
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
                        <h3 class="card-title">Detalle del Diario</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body" style=" overflow-x: scroll; height="250px"">
                     <form id="frmDetalleRei" name="frmDetalleRei" method="post">
                        <div class="row">
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Efectivo Cordoba</label>
                                 <input type="text" class="form-control" id="txtEF" name="txtEF">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Efectivo Dolar</label>
                                 <input type="text" class="form-control" id="txtEFD" name="txtEFD">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Cheque Cordoba</label>
                                 <input type="text" class="form-control" id="txtCheq" name="txtCheq">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Cheque Dolar</label>
                                 <input type="text" class="form-control" id="txtCheqD" name="txtCheqD">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Otros Cordoba</label>
                                 <input type="text" class="form-control" id="OtrosC" name="OtrosC">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Otros Dolar</label>
                                 <input type="text" class="form-control" id="txtOtrosD" name="txtOtrosD">
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Retención</label>
                                 <input type="text" class="form-control" id="txtRetencion" name="txtRetencion">
                                 <input type="hidden" class="form-control" id="txtDiario">
                                 <input type="hidden" class="form-control" id="txtSuc">
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <!-- /.card-body -->
               </div>
            </div>
         </div>
      </div>
      <div id="progresSave"></div>
      <div class="modal-footer">
         <button id="btnActualizarDiario" class="btn btn-success">Actualizar</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
   </div>
</div>
</div>