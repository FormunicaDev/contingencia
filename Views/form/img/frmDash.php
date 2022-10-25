<div class="card card-primary">
    <div class="card-header" style="background: rgb(0,200,210);">
        <h3 class="card-title">Información de ventas</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>

    </div>
    <!-- /.aca van los tres cuadros, clientes, icrm y Switch -->
    <div class="card-body">
      <!-- /.card -->
            <div class="row">
              <div class="col-md-12">
                <!-- icrm LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Ingresos canal distribuidores</h3>

                    <div class="card-tools">
                      
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header contenido -->
                  <div class="card-body p-0">
                     <div  class="row">
                      <canvas id="chartBarraVentas" ></canvas>                     
                    
                    </div> 
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->


         <!-- /.col checkbox -->  
<div class="col-md-6">
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-warning">
                  <div class="card-header">
                    <h3 class="card-title"></h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header contenido de clientes -->
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group" style="text-align: center; line-height: 30px;height: 110px">
                            <label style="color: white">-------</label>
                            <h3 style="" id="lblPagoA"></h3>
                            <label>Pagos <?php echo date('Y') ?></label>

                          </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- termina card pagos 2020 -->
<div class="col-md-6">
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-warning">
                  <div class="card-header">
                    <h3 class="card-title"></h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header contenido de clientes -->
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group" style="text-align: center; line-height: 30px;height: 110px">
                            <label style="color: white">-------</label>
                            <h3 style="" id="lblVentasA"></h3>
                            <label>Ventas <?php echo date('Y') ?></label>
                          </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

    </div>


    <!-- /.card-body -->
    <div class="col-sm-12">
        <div id="respuesta"></div>
    </div>

    
</div>


