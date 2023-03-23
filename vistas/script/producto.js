var tabla;
function init(){
    limpiar();
    listar();

    
    $.post("../ajax/producto.php?op=selectproducto", function (e) {
        $("#producto").html(e);
        //$("#producto").selectpicker('refresh');


    } );
}

function verreporte(){
   // alert("Entro a ver el reporte");
    window.open('../reportes/rptproducto.php', '_blank');
}

function limpiar(){
        $("#idcategoria").val("");
        $("#categoria").val("");
        $("#descripcion").val("");
        $("#codigo1").val("");
        $("#odigo2").val("");
        $("#descripcion").val("");
        $("#idproveedor").val("");
        $("#costo").val("");
        $("#utilidad").val("");
        $("#venta").val("");
        $("#impuesto").val("");   
        $("#idecategoria").val("");  
}

function guardaryeditar(){

    var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/producto.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	         alert(datos);	          
	          
	         
	          tabla.ajax.reload();
              limpiar();
              $("#exampleModal").modal('hide');
	    }

	});

}
function activar(idproducto){
    
    
    Swal.fire({
        title: 'Esta seguro de activar el registro?',
        text: "Se activara el registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Anular!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.post("../ajax/producto.php?op=activar", {idproducto : idproducto}, function(e){
    //            alert(e);
    Swal.fire(
        'Anular',
        e,
        'success'
      )
                tabla.ajax.reload();
            });	
         
        }
      })
            
}
function desactivar(idproducto){

    Swal.fire({
        title: 'Esta seguro de anular el registro?',
        text: "Se anulara el registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Anular!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.post("../ajax/producto.php?op=desactivar", {idproducto : idproducto}, function(e){
                alert(e);
                tabla.ajax.reload();
            });	
          Swal.fire(
            'Anular',
            'El registro a sido anulado',
            'success'
          )
        }
      })

        
    }


	
function mostrar(idproducto){

    $("#exampleModal").modal('show');

    $.post("../ajax/producto.php?op=mostrar",{idproducto : idproducto}, function(data, status)
    {
        data = JSON.parse(data);
        $("#idproducto").val(data.idproducto);
        $("#codigo1").val(data.CODIGO1);
        $("#descripcion").val(data.DESCRIPCIOn);
        $("#idproveedor").val(data.idproveedor);
        $("#costo").val(data.COSTO);
        $("#precioVenta").val(data.PrecioVENTA);
        $("#impuesto").val(data.IMPUESTO);
        $("#unidades").val(data.UNIDADes);
        $("#categoria").val(data.idcategoria);
        
    });
}      

function listar(){
    
    tabla=$('#example1').dataTable(
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
                        url: '../ajax/producto.php?op=listar',
                        type : "get",
                        dataType : "json",						
                        error: function(e){
                            console.log(e.responseText);	
                        }
                    },
            "bDestroy": true,
            "iDisplayLength": 50,//Paginación
            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
        }).DataTable();
   //
}
init();