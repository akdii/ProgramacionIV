var tabla;
function init() {
    limpiar();
    listar();
}
function limpiar() {
    $("#idcontacto").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#correo").val("");
    $("#telefono").val("");
    $("#fecja").val("");
    $("#hora").val("");
    $("#lugar").val("");


}

function verreporte(){
   // alert("Entro a ver el reporte");
    window.open('../reportes/rptproducto.php', '_blank');
 }
  

function guardaryeditar() {

    var formData = new FormData($("#formulario")[0]);
    console.log(formData)
    $.ajax({
        url: "../ajax/cita.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            Swal.fire('Agregar','El registro a sido agregado','success');

            tabla.ajax.reload();
            limpiar();
            $("#productoModal").modal('hide');
        }
    });

}

function activar(idcliente) {
    Swal.fire({
        title: 'Esta seguro de activar el cliente?',
        text: "Se activara el cliente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Activar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../ajax/cita.php?op=activar", { idcliente: idcliente }, function (e) {
                Swal.fire('Anular', e ,'success')
                tabla.ajax.reload();
            });
        }
    })

}
function desactivar(idcliente) {

    Swal.fire({
        title: 'Esta seguro de anular el cliente?',
        text: "Se anulara el cliente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Anular!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../ajax/cita.php?op=desactivar", { idcliente: idcliente }, function (e) {  
                Swal.fire('Anular', e ,'success')  
                tabla.ajax.reload();
            });
        }
    })
}





function mostrar(idcliente) {

    $("#exampleModal").modal('show');

    $.post("../ajax/cita.php?op=mostrar", { idcliente: idcliente }, function (data, status) {
        data = JSON.parse(data);
        $("#idcliente").val(data.idcliente);
        $("#nombre").val(data.Nombre);
        $("#apellido").val(data.Apellido);
        $("#correo").val(data.Correo);
        $("#telefono").val(data.Telefono);
        $("#fecha").val(data.Fecha);
        $("#hora").val(data.Hora);
        $("#lugar").val(data.Lugar);
       
        
    });
}

function listar() {

    tabla = $('#example1').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
            "ajax":
            {
                url: '../ajax/cita.php?op=listar',
                type: "get",
                dataType: "json",
                error: function (e) {
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 25,//Paginación
            "order": [[0, "desc"]]//Ordenar (columna,orden)
        }).DataTable();
    //
}
init();