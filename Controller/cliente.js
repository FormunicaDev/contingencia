let codCliente = ''
let opcion = 'get'
$(document).ready(function(){
    listarClientes(opcion,codCliente)
    $('#cargando').hide()
    $('#cargandoC').hide()
})

$('#btnBuscar').click(()=>{
    codCliente = $('#txtCliente').val()
    opcion = 'getById'
    listarClientes(opcion,codCliente)
     
})

$('#btnNuevaSol').click(()=> {
    $(".modal-header").css("background-color", "#4c8c4a");
    $(".modal-header").css("color", "white" );
    $('#modalCRUD2').modal('show');

    $('#cmbSucursalSol').load('Controller/obtenerSucursal.php')
    $('#cmbSucursalSolC').load('Controller/obtenerSucursal.php')

    let role = $('#role').val()
    console.log(role)
    if(role === '7005') {
        listarSolicitudesPlazo()
        listarSolicitudesTecho()
    } if(role === '7006') {
        listarSolicitudesPlazoAdmin()
        listarSolicitudesTechoAdmin()
    }
    

})

$('#cmbSucursalSol').on('change',function(){
    $('#cmbClienteSol').load(`Controller/obtenerCliente.php?codSucursal=${this.value}`)
})

$('#cmbSucursalSolC').on('change',function(){
    $('#cmbClienteSolC').load(`Controller/obtenerCliente.php?codSucursal=${this.value}`)
})

$('#btnGuardarSol').click(()=>{
    let plazo = $('#txtPlazoSol').val()
    let codCliente = $('#cmbClienteSol').val()
    $('#cargando').show()

    let data = new FormData()
    data.append('plazo',plazo)
    data.append('codCliente',codCliente)

    $.ajax({
        url: `Controller/cliente.php?opcion=post&codCliente=${codCliente}`,
        type: 'POST',
        contentType: false,
        dataType: 'json',
        data: data,
        processData: false,
        success: function (data) {
            if (data != "2") {
              Swal.fire(
                  'Cliente '+codCliente,
                  'Se ingreso la solicitud con exito!',
                  'success'
                )
                $('#modalCRUD2').modal('hide');
                $('#cargando').hide()
              return false;
      
            } else {
              alertify.error("Error al actualizar el plazo");
              $('#cargando').hide()
              return false;
            }
          }
    })
})

$('#btnGuardarSolCredito').click(()=>{
    let techoCredito = $('#txtCreditoSol').val()
    let codCliente = $('#cmbClienteSolC').val()
    $('#cargandoC').show()

    let data = new FormData()
    data.append('techoCredito',techoCredito)
    data.append('codCliente',codCliente)

    $.ajax({
        url: `Controller/cliente.php?opcion=postCredito&codCliente=${codCliente}`,
        type: 'POST',
        contentType: false,
        dataType: 'json',
        data: data,
        processData: false,
        success: function (data) {
            if (data != "2") {
              Swal.fire(
                  'Cliente '+codCliente,
                  'Se ingreso la solicitud con exito!',
                  'success'
                )
                $('#modalCRUD2').modal('hide');
                $('#cargandoC').hide()
              return false;
      
            } else {
              alertify.error("Error al actualizar el Techo de credito");
              $('#cargandoC').hide()
              return false;
            }
          }
    })
})

$('#frmCliente').submit(function(e){
    e.preventDefault();
});

$(document).on("click",".btnAprobar",function(){
    fila=$(this).closest("tr");
    let IdSolicitud = fila.find('td:eq(0)').text()
    let codCliente = fila.find('td:eq(1)').text()
    let Plazo = fila.find('td:eq(2)').text()
    let aprobacion = 1

    let data = new FormData()

    data.append('plazo',Plazo)
    data.append('aprobacion',aprobacion)
    data.append('IdSolicitud',IdSolicitud)

    alertify.confirm('Advertencia', '¿Seguro que desea aprobar esta solicitud?', function(){ 
        $.ajax({
            url:`Controller/cliente.php?opcion=putSol&codCliente=${codCliente}`,
			method:"POST",
            contentType: false,
            dataType: 'json',
            data:data,
			cache:false,
            processData: false,
            success:function(data){
                if(data===1) {
                    alertify.success('Solicitud aprobada con exito!') 
                    listarSolicitudesPlazoAdmin()
                } else {
                    alertify.alert("Error","Error al procesar la solicitud");
					return false;
                }
            }
        })
        
    }
    ,function(){ 
        alertify.error('Operacion Cancelada')
    });
    
})

$(document).on("click",".btnAprobarCredito",function(){
    fila=$(this).closest("tr");
    let IdSolicitud = fila.find('td:eq(0)').text()
    let codCliente = fila.find('td:eq(1)').text()
    let TechoCredito = fila.find('td:eq(2)').text()
    let aprobacion = 1

    let data = new FormData()

    data.append('techoCredito',TechoCredito)
    data.append('aprobacion',aprobacion)
    data.append('IdSolicitud',IdSolicitud)

    alertify.confirm('Advertencia', '¿Seguro que desea aprobar esta solicitud?', function(){ 
        $.ajax({
            url:`Controller/cliente.php?opcion=putSolTecho&codCliente=${codCliente}`,
			method:"POST",
            contentType: false,
            dataType: 'json',
            data:data,
			cache:false,
            processData: false,
            success:function(data){
                if(data===1) {
                    alertify.success('Solicitud aprobada con exito!') 
                    listarSolicitudesTechoAdmin()
                } else {
                    alertify.alert("Error","Error al procesar la solicitud");
					return false;
                }
            }
        })
        
    }
    ,function(){ 
        alertify.error('Operacion Cancelada')
    });
    
})

$(document).on("click",".btnRechazar",function(){
    fila=$(this).closest("tr");
    let IdSolicitud = fila.find('td:eq(0)').text()
    let codCliente = fila.find('td:eq(1)').text()
    let Plazo = fila.find('td:eq(2)').text()
    let aprobacion = 2

    let data = new FormData()

    data.append('plazo',Plazo)
    data.append('aprobacion',aprobacion)
    data.append('IdSolicitud',IdSolicitud)
    
    alertify.confirm('Advertencia', '¿Seguro que desea rechazar esta solicitud?', function(){ 
        $.ajax({
            url:`Controller/cliente.php?opcion=putSol&codCliente=${codCliente}`,
			method:"POST",
            contentType: false,
            dataType: 'json',
            data:data,
			cache:false,
            processData: false,
            success:function(data){
                if(data===1) {
                    alertify.success('Solicitud rechazada con exito!') 
                    listarSolicitudesPlazoAdmin()
                } else {
                    alertify.alert("Error","Error al procesar la solicitud");
					return false;
                }
            }
        })
        
    }
    ,function(){ 
        alertify.error('Operacion Cancelada')
    });
})

$(document).on("click",".btnRechazarCredito",function(){
    fila=$(this).closest("tr");
    let IdSolicitud = fila.find('td:eq(0)').text()
    let codCliente = fila.find('td:eq(1)').text()
    let TechoCredito = fila.find('td:eq(2)').text()
    let aprobacion = 2

    let data = new FormData()

    data.append('techoCredito',TechoCredito)
    data.append('aprobacion',aprobacion)
    data.append('IdSolicitud',IdSolicitud)
    
    alertify.confirm('Advertencia', '¿Seguro que desea rechazar esta solicitud?', function(){ 
        $.ajax({
            url:`Controller/cliente.php?opcion=putSolTecho&codCliente=${codCliente}`,
			method:"POST",
            contentType: false,
            dataType: 'json',
            data:data,
			cache:false,
            processData: false,
            success:function(data){
                if(data===1) {
                    alertify.success('Solicitud rechazada con exito!') 
                    listarSolicitudesTechoAdmin()
                } else {
                    alertify.alert("Error","Error al procesar la solicitud");
					return false;
                }
            }
        })
        
    }
    ,function(){ 
        alertify.error('Operacion Cancelada')
    });
})

$(document).on("click",".btnUpt",function(){
    $(".modal-header").css("background-color", "#4c8c4a");
    $(".modal-header").css("color", "white" );
    $('#modalCRUD').modal('show');
    fila=$(this).closest("tr");

    let codCliente = fila.find('td:eq(0)').text()
    let nombreCliente = fila.find('td:eq(1)').text()
    let apellidoCliente = fila.find('td:eq(2)').text()
    let cedula = fila.find('td:eq(3)').text()
    let telefono = fila.find('td:eq(4)').text()
    let sucursal = fila.find('td:eq(6)').text()
    let direccion = fila.find('td:eq(5)').text()

    $('#txtcodCliente').val(codCliente)
    $('#txtNombres').val(nombreCliente)
    $('#txtApellidos').val(apellidoCliente)
    $('#txtCedula').val(cedula)
    $('#txtTelefono').val(telefono)
    $('#txtSucursal').val(sucursal)
    $('#txtDireccion').val(direccion)
})

$('#btnActualizarCliente').click(()=>{
    let codCliente = $('#txtcodCliente').val()
    let nombreCliente = $('#txtNombres').val()
    let apellidoCliente = $('#txtApellidos').val()
    let cedula = $('#txtCedula').val()
    let telefono = $('#txtTelefono').val()
    let sucursal = $('#txtSucursal').val()
    let direccion = $('#txtDireccion').val()
    let opcion = 'put'

    let data = new FormData()
    data.append('nombre',nombreCliente)
    data.append('apellido',apellidoCliente)
    data.append('cedula',cedula)
    data.append('telefono',telefono)
    data.append('direccion',direccion)

    alertify.confirm('Advertencia', '¿Seguro que desea actualizar los datos del Cliente?', function(){ 
        $.ajax({
            url:`Controller/cliente.php?opcion=put&codCliente=${codCliente}`,
			method:"POST",
            contentType: false,
            dataType: 'json',
            data:data,
			cache:false,
            processData: false,
            success:function(data){
                if(data===1) {
                    alertify.success('Registro actualizado con exito') 
                    listarClientes('get',codCliente)
                } else {
                    alertify.alert("Error","Error al actualizar el registro");
					return false;
                }
            }
        })
        
    }
    ,function(){ 
        alertify.error('Operacion Cancelada')
    });

})

function listarClientes (opcion,codCliente) {
    
    $('#tblClientes').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/cliente.php",
            "method": 'GET', 
            "data":{opcion:opcion,codCliente:codCliente},
            "dataSrc":""
        },
        "columns":[
            {"data": "CODCLIENTE"},
            {"data": "NOMBRESCLIENTE"},
            {"data": "APELLIDOSCLIENTE"},
            {"data": "CEDULA"},
            {"data": "TELEFONO1"},
            {"data": "DIRECCION"},
            {"data": "SUCURSAL"},
            {"data": "CODVENDEDOR"},
            {"data": "PLAZODIAS"},
            {"data": "TECHOCREDITO"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnUpt'><i class='material-icons'>Editar</i></div></div>"}
       ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existe el cliente en la base de datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoEmpty": "Mostrando 0 de 0 de 0 registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
}

function listarSolicitudesPlazo() {
    let opcion = 'getSol'
    let codCliente = ''
    let role = 9005

    $('#tblSolicitudes').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/cliente.php",
            "method": 'GET', 
            "data":{opcion:opcion,codCliente:codCliente,role:role},
            "dataSrc":""
        },
        "columns":[
            {"data": "Id"},
            {"data": "codCliente"},
            {"data": "Plazo"},
            {
                "data": "Estado",
                "render": function (data, type) {
                  if (type === 'display') {
                    if(data === 'Ingresado') {
                        nameClass = 'badge badge-info'
                    } if (data === 'Aprobado') {
                        nameClass = 'badge badge-success'
                    } if(data === 'Rechazado') {
                        nameClass = 'badge badge-danger'
                    }
                    
                    return '<span class="' + nameClass + '">' + data + '</span>';
                  }
                  return data;
                }
          
            },
            {
                "data": "UsuarioSolicitud",
                "render":function (data,type) {
                    if(type === 'display') {
                        nameClass = 'badge badge-warning'
                        return '<span class="' + nameClass + '">' + data + '</span>';
                    }
                    return data
                }
            },
         ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existe el cliente en la base de datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoEmpty": "Mostrando 0 de 0 de 0 registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
}

function listarSolicitudesTecho() {
    let opcion = 'getSolTecho'
    let codCliente = ''
    let role = 9005

    $('#tblSolicitudesCredito').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/cliente.php",
            "method": 'GET', 
            "data":{opcion:opcion,codCliente:codCliente,role:role},
            "dataSrc":""
        },
        "columns":[
            {"data": "Id"},
            {"data": "codCliente"},
            {"data": "TechoCredito"},
            {
                "data": "Estado",
                "render": function (data, type) {
                  if (type === 'display') {
                    if(data === 'Ingresado') {
                        nameClass = 'badge badge-info'
                    } if (data === 'Aprobado') {
                        nameClass = 'badge badge-success'
                    } if(data === 'Rechazado') {
                        nameClass = 'badge badge-danger'
                    }
                    
                    return '<span class="' + nameClass + '">' + data + '</span>';
                  }
                  return data;
                }
          
            },
            {
                "data": "UsuarioSolicitud",
                "render":function (data,type) {
                    if(type === 'display') {
                        nameClass = 'badge badge-warning'
                        return '<span class="' + nameClass + '">' + data + '</span>';
                    }
                    return data
                }
            },
         ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existe el cliente en la base de datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoEmpty": "Mostrando 0 de 0 de 0 registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
}


function listarSolicitudesPlazoAdmin() {
    let opcion = 'getSol'
    let codCliente = ''
    let role = 9006
          
    $('#tblSolicitudes').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/cliente.php",
            "method": 'GET', 
            "data":{opcion:opcion,codCliente:codCliente,role:role},
            "dataSrc":""
        },
        "columns":[
            {"data": "Id"},
            {"data": "codCliente"},
            {"data": "Plazo"},
            {
                "data": "Estado",
                "render": function (data, type) {
                  if (type === 'display') {
                    if(data === 'Ingresado') {
                        nameClass = 'badge badge-info'
                    } if (data === 'Aprobado') {
                        nameClass = 'badge badge-success'
                    } if(data === 'Rechazado') {
                        nameClass = 'badge badge-danger'
                    }
                    
                    return '<span class="' + nameClass + '">' + data + '</span>';
                  }
                  return data;
                }
          
            },
            {
                "data": "UsuarioSolicitud",
                "render":function (data,type) {
                    if(type === 'display') {
                        nameClass = 'badge badge-warning'
                        return '<span class="' + nameClass + '">' + data + '</span>';
                    }
                    return data
                }
            },
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnAprobar'><i class='material-icons'>Aprobar</i></button> <button class='btn btn-danger btn-sm btnRechazar'><i class='material-icons'>Rechazar</i></button> </div></div>"}
         ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existe el cliente en la base de datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoEmpty": "Mostrando 0 de 0 de 0 registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
}

function listarSolicitudesTechoAdmin() {
    let opcion = 'getSolTecho'
    let codCliente = ''
    let role = 9006
          
    $('#tblSolicitudesCredito').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/cliente.php",
            "method": 'GET', 
            "data":{opcion:opcion,codCliente:codCliente,role:role},
            "dataSrc":""
        },
        "columns":[
            {"data": "Id"},
            {"data": "codCliente"},
            {"data": "TechoCredito"},
            {
                "data": "Estado",
                "render": function (data, type) {
                  if (type === 'display') {
                    if(data === 'Ingresado') {
                        nameClass = 'badge badge-info'
                    } if (data === 'Aprobado') {
                        nameClass = 'badge badge-success'
                    } if(data === 'Rechazado') {
                        nameClass = 'badge badge-danger'
                    }
                    
                    return '<span class="' + nameClass + '">' + data + '</span>';
                  }
                  return data;
                }
          
            },
            {
                "data": "UsuarioSolicitud",
                "render":function (data,type) {
                    if(type === 'display') {
                        nameClass = 'badge badge-warning'
                        return '<span class="' + nameClass + '">' + data + '</span>';
                    }
                    return data
                }
            },
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnAprobarCredito'><i class='material-icons'>Aprobar</i></button> <button class='btn btn-danger btn-sm btnRechazarCredito'><i class='material-icons'>Rechazar</i></button> </div></div>"}
         ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existe el cliente en la base de datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoEmpty": "Mostrando 0 de 0 de 0 registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis","refresh"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
}
