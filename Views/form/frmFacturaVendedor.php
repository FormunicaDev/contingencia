<div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
              <div class="card-tools">
              
            </div>
                
                  <div class="row">
                      <div class="col-lg-2">
                          <div class="form-group">
                              <label for="" class="col-form-label">N. Factura</label>
                              <input type="text" class="form-control" placeholder="N# Factura" aria-label="Recipient's username" aria-describedby="basic-addon2" id="txtDiario">
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
              <table id="tblFactVendedor" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                <thead>
                <tr>
                  <th>Cod Sucursal</th>
                  <th>Factura</th>
                  <th>Fecha Factura</th>
                  <th>CodCliente</th>
                  <th>Cliente</th>
                  <th>Cod Vendedor</th>
                  <th>Tipo Pago</th>
                  <th>Subtotal</th>
                  <th>Total Factura</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Cod Sucursal</th>
                  <th>Factura</th>
                  <th>Fecha Factura</th>
                  <th>CodCliente</th>
                  <th>Cliente</th>
                  <th>Cod Vendedor</th>
                  <th>Tipo Pago</th>
                  <th>Subtotal</th>
                  <th>Total Factura</th>
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
              <h3 class="card-title">actualizar codigo de Vendedor asociado a la factura</h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=" overflow-x: scroll; height="250px"">
            <form id="frmDetalleRei" name="frmDetalleRei" method="post">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Vendedor</label>
                            <select class="form-control select2" id="cmbVendedor" name="cmbVendedor"> </select>
                            <input type="hidden" id="txtOldVendedor">
                            <input type="hidden" id="txtsucursal">
                            <input type="hidden" id="txtFactura">
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
            <button type="button" class="btn btn-success" id="btnUpdateFact" data-dismiss="modal">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div> 