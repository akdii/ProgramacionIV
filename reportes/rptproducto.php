
<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();



//Inlcuímos a la clase PDF_MC_Table
require('PDF_MC_Table.php');
 
//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();
 
//Agregamos la primera página al documento pdf
$pdf->AddPage();

 
//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;

$pdf->image('logo.jpg',15,2,-600); 

//Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá

$pdf->SetFont('Arial','B',30);

$pdf->SetFont('Arial','B',30);

$pdf->Cell(60,10,'',80,0,'C');

$pdf->Cell(50,5,'INSA C.V',15,900,'C');
$pdf->Ln(10);

 
$pdf->Ln(10);
 
$pdf->SetFont('Arial','B',12);

$pdf->SetFont('Arial','B',12);
$pdf->Ln(10);
$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE CITAS',1,0,'C');


 
$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'id',1,0,'C',1);
$pdf->Cell(15,6,'Nombre',1,0,'C',1);
$pdf->Cell(25,6,'Apellido',1,0,'C',1);
$pdf->Cell(35,6,'Correo',1,0,'C',1);
$pdf->Cell(20,6,'Telefono',1,0,'C',1);
$pdf->Cell(20,6,'Fecha',1,0,'C',1);
$pdf->Cell(20,6,'Hora',1,0,'C',1);
$pdf->Cell(20,6,'Lugar',1,0,'C',1);

 
$pdf->Ln(6);
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modulo/ejecutarSQL.php";

$categoria=new ejecutarSQL();

$rspta = $categoria->listar("SELECT * FROM `cita_cliente` where condicion=1");

//Table with 20 rows and 4 columns
//codigo,producto,costo,precioventa,unidades,impuesto,totalinventario
$pdf->SetWidths(array(10,15,25,35,20,20,20,20,20));



while($reg= $rspta->fetch_object())
{  
    $nombre = $reg->Apellido;
   
 	$pdf->SetFont('Arial','',7); 
    $pdf->Row(array($reg->idcliente,$reg->Nombre,utf8_decode($nombre),$reg->Correo,$reg->Telefono,$reg->Fecha,$reg->Hora,$reg->Lugar));
}




//Mostramos el documento pdf
$pdf->Output();

?>
<?php



ob_end_flush();
?>

