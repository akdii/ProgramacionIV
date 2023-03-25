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

$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);
$pdf->Cell(30,6,'',0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,6,'rtn',1,0,'C',1);
$pdf->Cell(25,6,'telefono',1,0,'C',1);
$pdf->Cell(40,6,'direccion',1,0,'C',1);
$pdf->Cell(25,6,'fecha',1,0,'C',1);


 
$pdf->Ln(6);
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modulo/ejecutarSQL.php";

$categoria=new ejecutarSQL();

$rspta = $categoria->listar("SELECT * FROM `empresa` where condicion=1");

//Table with 20 rows and 4 columns
//codigo,producto,costo,precioventa,unidades,impuesto,totalinventario
$pdf->SetWidths(array(25,25,40,25));

$pdf->Cell(30,6,'',0,0,'C');

while($reg= $rspta->fetch_object())
{  
    $nombre = $reg->rtn;
 
 	$pdf->SetFont('Arial','',7); 
    $pdf->Row(array(utf8_decode($nombre),$reg->telefono,$reg->direccion,$reg->vence));
}
 
$pdf->SetFont('Arial','B',12);

$pdf->SetFont('Arial','B',12);
$pdf->Ln(10);
$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE CONTACTOS',1,0,'C');


 
$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'id',1,0,'C',1);
$pdf->Cell(15,6,'nombre',1,0,'C',1);
$pdf->Cell(15,6,'apellido',1,0,'C',1);
$pdf->Cell(20,6,'telefono',1,0,'C',1);
$pdf->Cell(20,6,'correo',1,0,'C',1);
$pdf->Cell(20,6,'hora',1,0,'C',1);
$pdf->Cell(20,6,'fecha',1,0,'C',1);
$pdf->Cell(20,6,'mensaje',1,0,'C',1);

 
$pdf->Ln(6);
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modulo/ejecutarSQL.php";

$categoria=new ejecutarSQL();

$rspta = $categoria->listar("SELECT * FROM `contacto` where condicion=1");

//Table with 20 rows and 4 columns
//codigo,producto,costo,precioventa,unidades,impuesto,totalinventario
$pdf->SetWidths(array(10,15,15,20,20,20,20,20,20));



while($reg= $rspta->fetch_object())
{  
    $Nombre = $reg->apellido;
   
 	$pdf->SetFont('Arial','',7); 
    $pdf->Row(array($reg->idcontacto,$reg->nombre,utf8_decode($Nombre),$reg->telefono,$reg->correo,$reg->hora,$reg->fecha,$reg->mensaje));
}




//Mostramos el documento pdf
$pdf->Output();

?>
<?php



ob_end_flush();
?>
