$(document).ready(function(){
    let IDSol = ''
    $('#cargando').hide()
    listarReintegro(IDSol)
})

$('#btnNuevaSolRei').click(()=>{
    $(".modal-header").css("background-color", "#4c8c4a");
    $(".modal-header").css("color", "white" );
    $('#modalCRUD2').modal('show');

    $('#cmbTipoSol').load('Controller/obtenerTipoPago.php?opcion=1');
    $('#cmbEstadoSol').load('Controller/obtenerEstadoSolicitud.php'); 
})

$('#frmReintegro').submit(function(e){
    e.preventDefault();
});

$('#btnBuscar').click(()=>{
    let IdSol = $('#txtSolicitud').val()
    listarReintegro(IdSol);
})

$(document).on("click",".btnMostrar",function(){
    $(".modal-header").css("background-color", "#4c8c4a");
    $(".modal-header").css("color", "white" );
    $('#modalCRUD').modal('show');
    
    fila=$(this).closest("tr");
    IDSol= parseInt(fila.find('td:eq(0)').text());
    $('#exampleModalLabel').text('Solicitud # '+IDSol)
    $('#txtIdSolic').val(IDSol)
    limpiarCampos()
    listarDetalleReintegro(IDSol)
   
});

$('#btnGuardarRei').click(()=>{
    var data = new FormData($('#frmReintegro')[0]);
    console.log(data)
    $.ajax({
        url: "Controller/reintegro.php?opcion=post&IDSol=",
        type: 'POST',
        contentType: false,
        dataType: 'json',
        data: data,
        processData: false,
        beforeSend: function () {
          $('#cargando').show();
          $('#btnGuardarRei').text('Guardando...');
        },
        success: function (data) {
          if (data != "2") {
            Swal.fire(
                'Solicitud #'+data,
                'Registro Creado con Exito!',
                'success'
              )
            $('#cargando').hide();
            $('#btnGuardarRei').text('Guardar');
            listarReintegro(data);
            limpiarCampos
            return false;
    
          } else {
            alertify.error("Error al registrar");
            $('#cargando').hide();
            $('#btnGuardarRei').text('Guardar');
            return false;
          }
        }
      });
})

$(document).on("click",".btnDelete",function(){
  console.log('click delete')
  fila=$(this).closest("tr");
  let IDSol= parseInt(fila.find('td:eq(0)').text());
  let CentroCosto = fila.find('td:eq(1)').text();
  let Linea = parseInt(fila.find('td:eq(3)').text());
  let Monto= fila.find('td:eq(6)').text();

  alertify.confirm('Alerta','¿Seguro que desea eliminar la linea '+Linea+' de la solicitud '+IDSol, function(){ 
    $.ajax({
      url: `Controller/reintegroDetalle.php?opcion=delete&IDSol=${IDSol}&Linea=${Linea}&CentroCosto=${CentroCosto}&Monto=${Monto}`,
      type: 'GET',
      contentType: false,
      dataType: 'json',
      //data: data,
      processData: false,
      success: function (data) {
        if (data == "1") {
          alertify.success('Ok') 
          listarDetalleReintegro(IDSol);
          return false;
  
        } else {
          alertify.error("Error al eliminar la linea "+Linea);
          return false;
        }
      }
    })
    
  }, function(){ 
    alertify.error('Se cancelo la operación')
  })
})
  

$('#btnAddDetalle').click(()=>{
    var data = new FormData();
    data.append('centroCosto',$('#centroCosto').val())
    data.append('cuentaContable',$('#cuentaContable').val())
    data.append('dtpFechaFactura',$('#dtpFechaFactura').val())
    data.append('txtNumFact',$('#txtNumFact').val())
    data.append('txtNombreEst',$('#txtNombreEst').val())
    data.append('txtMonto',$('#txtMonto').val())
    data.append('txtConcepto',$('#txtConcepto').val())
    data.append('txtIdSolic',$('#txtIdSolic').val())
    let IdSolicitud = $('#txtIdSolic').val()
    $.ajax({
        url: "Controller/reintegroDetalle.php?opcion=post&IDSol=",
        type: 'POST',
        contentType: false,
        dataType: 'json',
        data: data,
        processData: false,
        beforeSend: function () {
          $('#btnAddDetalle').text('Guardando...');
        },
        success: function (data) {
          console.log(data)
          if (data == "1") {
            Swal.fire(
                'Enhonabuena',
                'Registro Creado con Exito!',
                'success'
              )
            $('#btnAddDetalle').text('Guardar');
            listarDetalleReintegro(IdSolicitud);
            limpiarCampos
            return false;
    
          } else if(data == "2") {
            alertify.error("Error al registrar");
            $('#btnAddDetalle').text('Guardar');
            return false;
          } else {
            alertify.error("La suma de todos los items supera al monto ingresado en la solicitud por "+data);
            $('#btnAddDetalle').text('Guardar');
            return false;
          }
        }
    })
})

$(document).on("click",".btnEditarSol",function(){
  $(".modal-header").css("background-color", "#4c8c4a");
  $(".modal-header").css("color", "white" );
  $('#modalCRUD3').modal('show');
  fila=$(this).closest("tr");
  let IDSol= parseInt(fila.find('td:eq(0)').text());
  let CeCo = fila.find('td:eq(1)').text();
  let Monto = fila.find('td:eq(4)').text();

  

  $('#lblSolicitud').text(IDSol);
  $('#centroCostoUpt').val(CeCo)
  $('#montoUpt').val(Monto);
  $('#idUpt').val(IDSol)
})

$('#btnActualizarRei').click(()=>{
  let IdSol=$('#idUpt').val()
  let Ceco=$('#centroCostoUpt').val()
  let Monto=$('#montoUpt').val();

  let data = new FormData();
  data.append('CentroCosto',Ceco)
  data.append('Monto',Monto)

  $.ajax({
        url: `Controller/reintegro.php?opcion=put&IDSol=${IdSol}`,
        type: 'POST',
        contentType: false,
        dataType: 'json',
        data: data,
        processData: false,
        success: function (data) {
          console.log(data)
          if (data == "1") {
            Swal.fire(
                'Enhonabuena',
                'Registro Actualizado con Exito!',
                'success'
              )
            listarReintegro(IdSol);
            
            return false;
    
          } else {
            alertify.error("Error al actualizar la solicitud");
            return false;
          }
        }
  })
})

function listarReintegro(IDSol) {
    let opcion = "get"
    $('#tblReintegro').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/reintegro.php",
            "method": 'GET', 
            "data":{opcion:opcion,IDSol:IDSol},
            "dataSrc":""
        },
        "columns":[
            {"data": "IdSolicitud"},
            {"data": "CENTRO_COSTO"},
            {"data": "Concepto"},
            {"data": "FechaSolicitud"},
            {"data": "Monto"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnEditarSol'><i class='material-icons'>Editar</i></button><button class='btn btn-success btn-sm btnMostrar'><i class='material-icons'>Detalles</i></button> </div></div>"}
       ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existen solicitudes en la base de datos",
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

function listarDetalleReintegro(IDSol) {
    let opcion = "get"
    $('#tblDetalleReintegro').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/reintegroDetalle.php",
            "method": 'GET', 
            "data":{opcion:opcion,IDSol:IDSol},
            "dataSrc":""
        },
        "columns":[
            {"data": "IdSolicitud"},
            {"data": "CENTRO_COSTO"},
            {"data": "Cuenta_Contable"},
            {"data": "Linea"},
            {"data": "Concepto"},
            {"data": "FechaFactura"},
            {"data": "Monto"},
	    {"data": "Factura"},
	    {"data": "Establecimiento"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button id='btnDelete' class='btn btn-danger btn-sm btnDelete'><i class='material-icons'>Anular</i></button></div></div>"}
       ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existen solicitudes en la base de datos",
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

function limpiarCampos() {
  $('#centroCosto').val('')
  $('#cuentaContable').val('')
  $('#txtNumFact').val('')
  $('#txtNombreEst').val('')
  $('#txtMonto').val('')
  $('#txtConcepto').val('')
  $('#nombreBeneficiario').val('')
  $('#monto').val('')
  $('#cmbEstadoSol').val('')
}