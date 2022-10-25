$(document).ready(function(){
    $('#cmbSucursal').load('Controller/obtenerSucursal.php');
})

$('#frmFact').submit(function(e){
    e.preventDefault();
});

$('#btnBuscar').click(()=>{
    let opcion = 'get'
    let documento = $('#txtDocumento').val()
    let sucursal = $('#cmbSucursal').val()
    let cliente = $('#cmbCliente').val()

    buscarFactura(opcion,documento,sucursal,cliente)
})

$(document).on("click",".btnMostrar",function(){
    $(".modal-header").css("background-color", "#4c8c4a");
    $(".modal-header").css("color", "white" );
    $('#modalCRUD').modal('show');
    fila=$(this).closest("tr");
    let codFactura = fila.find('td:eq(0)').text()
    let Cliente = fila.find('td:eq(2)').text()
    let sucursal = fila.find('td:eq(3)').text()
    let opcion = 'getID'

    buscarDetalleFactura(opcion,codFactura,sucursal,Cliente)
    
})

function buscarFactura(opcion,documento,codSucursal,CodCliente) {
    $('#tblFactura').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/factura.php",
            "method": 'GET', 
            "data":{opcion:opcion,documento:documento,codSucursal:codSucursal,CodCliente:CodCliente},
            "dataSrc":""
        },
        "columns":[
            {"data": "FACTURA"},
            {"data": "CODCLIENTE"},
            {"data": "Cliente"},
            {"data": "CODSUCURSAL"},
            {"data": "NOMBRESVENDEDOR"},
            {"data": "TIPOPAGO"},
            {"data": "SUBTOTAL"},
            {"data": "DESCUENTO"},
            {"data": "TOTALFACTURA"},
            {"data": "FECHAFACTURA"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnMostrar'><i class='material-icons'>Detalles</i></button> </div></div>"}
       ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existe el documento en la base de datos",
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



function buscarDetalleFactura(opcion,documento,codSucursal,CodCliente) {
    $('#tblDetalleFactura').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/factura.php",
            "method": 'GET', 
            "data":{opcion:opcion,documento:documento,codSucursal:codSucursal,CodCliente:CodCliente},
            "dataSrc":""
        },
        "columns":[
            {"data": "CODSUCURSAL"},
            {"data": "TipoFact"},
            {"data": "ARTICULO"},
            {"data": "NombreArticulo"},
            {"data": "CODCLIENTE"},
            {"data": "CANTIDAD"},
            {"data": "PRECIOUNITARIODOLAR"},
            {"data": "SUBTOTALDOLAR"},
            {"data": "TOTALDOLAR"},
            {"data": "LOTE"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnMostrar'><i class='material-icons'>Detalles</i></button> </div></div>"}
       ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existe el documento en la base de datos",
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