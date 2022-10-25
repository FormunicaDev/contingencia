<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <div class="card-tools">
               <button ID="btnNuevaSol" type="button" class="btn btn-block btn-outline-success btn-sm" >Solicitudes</button>
            </div>
            <br><br>
            <div class="input-group mb-2">
               <input type="text" class="form-control" placeholder="Buscar" aria-label="Recipient's username" aria-describedby="basic-addon2" id="txtCliente">
               <div class="input-group-append">
                  <button class="btn btn-outline-secondary" id="btnBuscar" type="button">Buscar</button>
               </div>
            </div>
         </div>
         <!-- /.card-header -->
         <div class="card-body" style=" overflow-x: scroll; height:650px">
            <table id="tblClientes" class="table table-bordered table-striped" cellspacing="0" width="100%" >
               <thead>
                  <tr>
                     <th>Cod. Cliente</th>
                     <th>Nombres</th>
                     <th>Apellidos</th>
                     <th>Cedula</th>
                     <th>Telefono</th>
                     <th>Dirección</th>
                     <th>Sucursal</th>
                     <th>Vendedor Asignado</th>
                     <th>Plazo</th>
                     <th>Techo Credito</th>
                     <th>Acciones</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
               <tfoot>
                  <tr>
                     <th>Cod. Cliente</th>
                     <th>Nombres</th>
                     <th>Apellidos</th>
                     <th>Cedula</th>
                     <th>Telefono</th>
                     <th>Dirección</th>
                     <th>Sucursal</th>
                     <th>Vendedor Asignado</th>
                     <th>Plazo</th>
                     <th>Techo Credito</th>
                     <th>Acciones</th>
                  </tr>
               </tfoot>
            </table>
         </div>
         <!-- /.card-body -->
      </div>
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
                        <h3 class="card-title">Información del Cliente</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body" style=" overflow-x: scroll; height="250px"">
                     <form id="frmDetalleRei" name="frmDetalleRei" method="post">
                        <div class="row">
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Codigo</label>
                                 <input type="text" class="form-control" id="txtcodCliente" disabled name="txtcodCliente">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Nombres</label>
                                 <input type="text" class="form-control" id="txtNombres" name="txtNombres">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Apellidos</label>
                                 <input type="text" class="form-control" id="txtApellidos" name="txtApellidos">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Cedula</label>
                                 <input type="text" class="form-control" id="txtCedula" name="txtCedula" data-inputmask='"mask": "999-999999-9999a"' data-mask>
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Telefono</label>
                                 <input type="text" class="form-control" id="txtTelefono" name="txtTelefono">
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Sucursal</label>
                                 <input type="text" class="form-control" id="txtSucursal" name="txtSucursal" disabled>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-10">
                              <div class="form-group">
                                 <label for="" class="col-form-label">Dirección </label>
                                 <textarea rows="2" cols="50" class="form-control" id="txtDireccion" name="txtDireccion"></textarea>
                                 <input type="hidden" name="txtIdSolic" id="txtIdSolic">
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
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
         <button id="btnActualizarCliente" class="btn btn-success">Actualizar</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                     <h3 class="card-title">Solicitudes</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body" style=" overflow-x: scroll; height: 650px;">
                     <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" href="#references" role="tab" data-toggle="tab">-</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " href="#profile" role="tab" data-toggle="tab">Plazo</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Limite de Credito</a>
                        </li>
                     </ul>
                     <!-- Tab panes -->
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade" id="buzz">
                        <div style="width:100%">
                              <img id="cargandoC" src="Views/img/cargando7.gif" style=" height: 150px;margin-left: auto;
                                 margin-right: auto;
                                 display: block;">
                           </div>
                           <form id="frmReintegro" name="frmReintegro" method="post"></form>
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="" class="col-form-label">Cod. Sucursal</label>
                                    <select class="form-control select2" id="cmbSucursalSolC" name="cmbSucursalSolC"> </select>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="" class="col-form-label">Cod. Cliente</label>
                                    <select class="form-control select2" id="cmbClienteSolC" name="cmbClienteSolC"> </select>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="form-group">
                                    <label for="" class="col-form-label">Techo Credito</label>
                                    <input type="number" min="0" class="form-control" id="txtCreditoSol" name="txtCreditoSol">
                                 </div>
                              </div>
                              <div class="form-group" style="margin-top:35px;">
                                <button type="button" id="btnGuardarSolCredito" class="btn btn-success">Guardar</button>
                              </div>
                              <?php 
                                 $usuario = $_SESSION['Usuario'];
                                 $role = '7005';
                                 if($permisos->tienePermiso($usuario,$role,$conexion)) {
                                     echo '<div class="card-body" style=" overflow-x: scroll; height:500px">
                                         <input type="hidden" id="role" value="7005"></input>
                                         <table id="tblSolicitudesCredito" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                                             <thead>
                                             <tr>
                                                 <th>ID Solicitud</th>
                                                 <th>Cod. Cliente</th>
                                                 <th>Techo Credito</th>
                                                 <th>Estado</th>
                                                 <th>Usuario Solicitud</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             
                                             </tbody>
                                             <tfoot>
                                             <tr>
                                                <th>ID Solicitud</th>
                                                 <th>Cod. Cliente</th>
                                                 <th>Techo Credito</th>
                                                 <th>Estado</th>
                                                 <th>Usuario Solicitud</th>
                                             </tr>
                                             </tfoot>
                                         </table>
                                     </div>'; 
                                 }
                                 ?>
                              <?php 
                                 $usuario = $_SESSION['Usuario'];
                                 $role = '7006';
                                 if($permisos->tienePermiso($usuario,$role,$conexion)) {
                                     echo '<div class="card-body" style=" overflow-x: scroll; height:500px">
                                         <input type="hidden" id="role" value="7006"></input>
                                         <table id="tblSolicitudesCredito" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                                             <thead>
                                             <tr>
                                                 <th>ID Solicitud</th>
                                                 <th>Cod. Cliente</th>
                                                 <th>Techo Credito</th>
                                                 <th>Estado</th>
                                                 <th>Usuario Solicitud</th>
                                                 <th>Acciones</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             
                                             </tbody>
                                             <tfoot>
                                             <tr>
                                                 <th>ID Solicitud</th>
                                                 <th>Cod. Cliente</th>
                                                 <th>Techo Credito</th>
                                                 <th>Estado</th>
                                                 <th>Usuario Solicitud</th>
                                                 <th>Acciones</th>  
                                             </tr>
                                             </tfoot>
                                         </table>
                                     </div>'; 
                                 }
                                 ?>
                           </div>
                           <!-- /.card-body -->
                        </div> <!-- primer tab acaba -->
                        <div role="tabpanel" class="tab-pane fade" id="profile">
                           <div style="width:100%">
                              <img id="cargando" src="Views/img/cargando7.gif" style=" height: 150px;margin-left: auto;
                                 margin-right: auto;
                                 display: block;">
                           </div>
                           <form id="frmReintegro" name="frmReintegro" method="post"></form>
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="" class="col-form-label">Cod. Sucursal</label>
                                    <select class="form-control select2" id="cmbSucursalSol" name="cmbSucursalSol"> </select>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="" class="col-form-label">Cod. Cliente</label>
                                    <select class="form-control select2" id="cmbClienteSol" name="cmbClienteSol"> </select>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="form-group">
                                    <label for="" class="col-form-label">Plazo</label>
                                    <input type="number" min="0" class="form-control" id="txtPlazoSol" name="txtPlazoSol">
                                 </div>
                              </div>
                              <div class="form-group" style="margin-top:35px;">
                                <button type="button" id="btnGuardarSol" class="btn btn-success">Guardar</button>
                              </div>
                              <?php 
                                 $usuario = $_SESSION['Usuario'];
                                 $role = '7005';
                                 if($permisos->tienePermiso($usuario,$role,$conexion)) {
                                     echo '<div class="card-body" style=" overflow-x: scroll; height:500px">
                                         <input type="hidden" id="role" value="7005"></input>
                                         <table id="tblSolicitudes" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                                             <thead>
                                             <tr>
                                                 <th>ID Solicitud</th>
                                                 <th>Cod. Cliente</th>
                                                 <th>Plazo</th>
                                                 <th>Estado</th>
                                                 <th>Usuario Solicitud</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             
                                             </tbody>
                                             <tfoot>
                                             <tr>
                                             <th>ID Solicitud</
                                                 <th>Cod. Cliente</th>
                                                 <th>Plazo</th>
                                                 <th>Estado</th>
                                                 <th>Usuario Solicitud</th>
                                             </tr>
                                             </tfoot>
                                         </table>
                                     </div>'; 
                                 }
                                 ?>
                              <?php 
                                 $usuario = $_SESSION['Usuario'];
                                 $role = '7006';
                                 if($permisos->tienePermiso($usuario,$role,$conexion)) {
                                     echo '<div class="card-body" style=" overflow-x: scroll; height:500px">
                                         <input type="hidden" id="role" value="7006"></input>
                                         <table id="tblSolicitudes" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                                             <thead>
                                             <tr>
                                                 <th>ID Solicitud</th>
                                                 <th>Cod. Cliente</th>
                                                 <th>Plazo</th>
                                                 <th>Estado</th>
                                                 <th>Usuario Solicitud</th>
                                                 <th>Acciones</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             
                                             </tbody>
                                             <tfoot>
                                             <tr>
                                             <th>ID Solicitud</th>
                                                 <th>Cod. Cliente</th>
                                                 <th>Plazo</th>
                                                 <th>Estado</th>
                                                 <th>Usuario Solicitud</th>
                                                 <th>Acciones</th>  
                                             </tr>
                                             </tfoot>
                                         </table>
                                     </div>'; 
                                 }
                                 ?>
                           </div>
                           <!-- /.card-body -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade in active" id="references">Pantalla para realizar solicitudes de actualización</div>
                     </div>
                     <!-- finaliza tab -->
                  </div>
               </div>
            </div>
         </div>
         <div id="progresSave"></div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>