$(document).ready(function(){
    $('#cmbSucursal').load('Controller/obtenerSucursal.php');
})

$('#frmFact').submit(function(e){
    e.preventDefault();
});

$('#btnBuscar').click(()=>{
    //fila=$(this).closest("tr");
    //let codOldVendedor = fila.find('td:eq(5)').text()
    let documento = $('#txtDiario').val()
    let opcion = "getVendedor"
    let sucursal = $('#cmbSucursal').val()

    buscarFacturaVendedor(opcion,documento,sucursal)
})

$(document).on("click",".btnMostrar",function(){
    $(".modal-header").css("background-color", "#4c8c4a");
    $(".modal-header").css("color", "white" );
    $('#modalCRUD').modal('show');
    fila=$(this).closest("tr");

    let codOldVendedor = fila.find('td:eq(5)').text()
    let sucursal = fila.find('td:eq(0)').text()
    let factura = fila.find('td:eq(1)').text()

    $('#cmbVendedor').load(`Controller/obtenerVendedores.php?codSucursal=${sucursal}`);
    $('#txtOldVendedor').val(codOldVendedor)
    $('#txtsucursal').val(sucursal)
    $('#txtFactura').val(factura)
})

$('#btnUpdateFact').click(()=>{
    let codVendedor = $('#cmbVendedor').val()
    let codOldVendedor = $('#txtOldVendedor').val()
    let factura =  $('#txtFactura').val()
    let sucursal = $('#txtsucursal').val()
    let opcion = 'getVendedor'

    let data = new FormData()

    data.append('codVendedor',codVendedor)
    data.append('codOldVendedor',codOldVendedor)

    alertify.confirm('Advertencia', '¿Seguro que desea actualizar el vendedor de esta Factura?', function(){ 
        $.ajax({
            url:`Controller/factura.php?opcion=put&documento=${factura}&codSucursal=${sucursal}`,
			method:"post",
            contentType: false,
            dataType: 'json',
            data:data,
			cache:false,
            processData: false,
            success:function(data){
                if(data===1) {
                    alertify.success('Registro actualizado con exito') 
                    buscarFacturaVendedor(opcion,factura,sucursal)
                } else {
                    alertify.alert("Error","Error al actualizar el registro");
					return false;
                }
            }
        })
    },
    function(){
        alertify.error('Operacion Cancelada')
    })
})

function buscarFacturaVendedor(opcion,documento,codSucursal) {
    $('#tblFactVendedor').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": `Controller/factura.php?opcion=${opcion}&documento=${documento}&codSucursal=${codSucursal}`,
            "method": 'GET', 
            //"data": data,
            "dataSrc":""
        },
        "columns":[
            {"data": "CODSUCURSAL"},
            {"data": "FACTURA"},
            {"data": "FECHAFACTURA"},
            {"data": "CODCLIENTE"},
            {"data": "CLIENTE"},
            {"data": "CODVENDEDOR"},
            {"data": "TIPOPAGO"},
            {"data": "SUBTOTAL"},
            {"data": "TOTALFACTURA"},
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