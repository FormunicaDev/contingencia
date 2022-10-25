<div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
              <div class="card-tools">
              
            </div>
                
                  <div class="row">
                      <div class="col-lg-2">
                          <div class="form-group">
                              <label for="" class="col-form-label">N.Documento</label>
                              <input type="text" class="form-control" placeholder="N# Documento" aria-label="Recipient's username" aria-describedby="basic-addon2" id="txtDocumento">
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                              <label for="" class="col-form-label">Cod. Sucursal</label>
                              <select class="form-control select2" id="cmbSucursal" name="cmbSucursal"> </select>
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                              <label for="" class="col-form-label">Cod. Cliente</label>
                              
                              <select class="form-control select2" id="cmbCliente" name="cmbCliente"> 

                              </select>
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
              <table id="tblDocumeneto" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Cod Cliente</th>
                  <th>Cliente</th>
                  <th>Cod Sucursal</th>
                  <th>Documento</th>
                  <th>Monto</th>
                  <th>Saldo Act</th>
                  <th>Plazo</th>
                  <th>Fecha</th>
                  <th>Vencimiento</th>
                  <th>Vencimiento V</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Cod Cliente</th>
                  <th>Cliente</th>
                  <th>Cod Sucursal</th>
                  <th>Documento</th>
                  <th>Monto</th>
                  <th>Saldo Act</th>
                  <th>Plazo</th>
                  <th>Fecha</th>
                  <th>Vencimiento</th>
                  <th>Vencimiento V</th>
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
              <h3 class="card-title">Actualizar Plazo de Vencimiento</h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=" overflow-x: scroll; height="250px"">
            <form id="frmDetalleRei" name="frmDetalleRei" method="post">
                <div class="row">
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="" class="col-form-label">Cliente:</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label id="lblCliente" style="color:green" for="" class="col-form-label"></label>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="" class="col-form-label">Plazo:</label>
                            <input type="hidden" name="txtPlazoOriginal" id="txtPlazoOriginal">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label id="lblPlazo" for="" style="color:green" class="col-form-label"></label>
                            
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Fecha Vencimiento:</label>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label id="lblFechaVencimiento" style="color:green" for="" class="col-form-label"></label>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">Nuevo Plazo (En días) </label>
                            <input class="form-control" type="number" min="0" name="txtNuevoPlazo" id="txtNuevoPlazo">
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
                <button id="btnUptPlazo" type="button" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div> 