var tabla;
function init() {
    limpiar();
    listar();
}
function limpiar() {
    $("#idcontacto").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#telefono").val("");
    $("#correo").val("");
    $("#hora").val("");
    $("#fecha").val("");
    $("#mensaje").val("");


}

function verreporte2(){
    // alert("Entro a ver el reporte");
     window.open('../reportes/rptcategorias.php', '_blank');
  }

function guardaryeditar() {

    var formData = new FormData($("#formulario")[0]);
    console.log(formData)
    $.ajax({
        url: "../ajax/categoria.php?op=guardaryeditar",
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

function activar(idcontacto) {
    Swal.fire({
        title: 'Esta seguro de activar el contacto?',
        text: "Se activara el contacto",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Activar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../ajax/categoria.php?op=activar", { idcontacto: idcontacto }, function (e) {
                Swal.fire('Anular', e ,'success')
                tabla.ajax.reload();
            });
        }
    })

}
function desactivar(idcontacto) {

    Swal.fire({
        title: 'Esta seguro de anular el contacto?',
        text: "Se anulara el contacto",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Anular!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../ajax/categoria.php?op=desactivar", { idcontacto: idcontacto }, function (e) {  
                Swal.fire('Anular', e ,'success')  
                tabla.ajax.reload();
            });
        }
    })
}





function mostrar(idcontacto) {

    $("#exampleModal").modal('show');

    $.post("../ajax/categoria.php?op=mostrar", { idcontacto: idcontacto }, function (data, status) {
        data = JSON.parse(data);
        $("#idcontacto").val(data.idcontacto);
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#telefono").val(data.telefono);
        $("#correo").val(data.correo);
        $("#hora").val(data.hora);
        $("#fecha").val(data.fecha);
        $("#mensaje").val(data.mensaje);
       
        
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
                url: '../ajax/categoria.php?op=listar',
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