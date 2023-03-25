
<?php
require('header.php');
?>
            
<div class="content-wrapper">

    <!-- Input addon -->
    <div class="card card-info">
        <div class="row">
            <div class="col-4">
                
            </div>
        </div>
      
        <div class="card-header">
            <h3 class="card-title">Registro de Categorias</h3>
        </div>
        <div class="card-body">
            <div>
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Agendar cita
                </button>
                <button type="button" class="btn btn-warning" onclick="verreporte2();" data-toggle="modal" data-target="#exampleModal">
                    Ver reporte
                </button> 
                </div><br>
                
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Opciones</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>apellido</th>
                        <th>telefono</th>
                        <th>correo</th>
                        <th>hora</th>
                        <th>fecha</th>
                        <th>mensaje</th>
                        <th>estado</th>
                        
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
            <!-- /input-group -->
        </div>
        <!-- /.card-body -->
        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk-circle-arrow-right"></i>Guardar</button>
        </div>

    </div>



</div>


<?php
require('footer.php');
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" name="formulario" id="formulario">

                    <div class="form-group row">
                        <div class="col-md-6">
                        <input type="hidden" name="idcontacto" id="idcontacto" class="form-control" value="" />
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" aria-hidden="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" aria-hidden="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Telefono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" aria-hidden="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Correo:</label>
                            <input type="text" class="form-control" id="correo" name="correo" aria-hidden="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Hora:</label>
                            <input type="time" class="form-control" id="hora" name="hora" aria-hidden="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" aria-hidden="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Mensaje:</label>
                            <input type="text" class="form-control" id="mensaje" name="mensaje" aria-hidden="true">
                        </div>
                        <div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="guardaryeditar();" class="btn btn-primary">Enviar</button>
                            <button type="button" onclick="limpiar();" class="btn btn-warning">Limpiar</button>
                        </div>
<br><br>

                        </div>
                       
                </form>
               
            </div>
            
        </div>
    </div>
    <script type="text/javascript" src="script/categorias.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
