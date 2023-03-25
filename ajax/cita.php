<?php

require_once "../modulo/ejecutarSQL.php";

$cita_cliente=new ejecutarSQL();


$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$hora=isset($_POST["hora"])? limpiarCadena($_POST["hora"]):"";
$lugar=isset($_POST["lugar"])? limpiarCadena($_POST["lugar"]):"";



switch ($_GET["op"]){
    case 'guardaryeditar':
        $ms = "Registro el cliente";

        if (empty($idcliente))
        {
            $sql = "INSERT INTO `cita_cliente`(`Nombre`, `Apellido`, `Correo`, `Telefono`, `Fecha`,`Hora`,`Lugar`,`condicion`) 
                VALUES ('$nombre','$apellido', '$correo', '$telefono', '$fecha', '$hora','$lugar',1)";

        } else {

            $sql = "UPDATE `cita_cliente` set `idcliente`='$idcliente',`Nombre`='$nombre', `Apellido`='$apellido', `Correo`='$correo',
             `Telefono`='$telefono', `Fecha`='$fecha', `Hora`='$hora',`Lugar`='$lugar' WHERE idcliente = '$idcliente'";

            $ms = "Edito el Registro de el contacto";
          
        }
        $respuesta = $cita_cliente->insertar($sql);
        echo $respuesta ? $ms : "El cliente no se pudo ingresar";     
break;
    
case 'mostrar':
    
$sql="SELECT * FROM `cita_cliente` WHERE idcliente=".$idcliente;
$respuesta=$cita_cliente->mostrar($sql);
echo json_encode($respuesta);

break;

case 'activar':
    $sql = "update `cita_cliente` set condicion=1 WHERE idcliente=".$idcliente;
    $respuesta = $cita_cliente->insertar($sql);
    echo $respuesta ? "Se activo el cliente" : "El cliente no se pudo ingresar";     
        
    break;

case 'desactivar':
    $sql="update `cita_cliente` set condicion=0 WHERE idcliente=".$idcliente;
    $respuesta = $cita_cliente->insertar($sql);
    echo $respuesta ? "Se desactivo el cliente" : "El cliente no se pudo ingresar";     

    break;

    case 'listar':
            $rspta=$cita_cliente->listar("select * from  cita_cliente");
            //Vamos a declarar un array
            $data= Array();
   
            while ($reg=$rspta->fetch_object()){
                $data[]=array(
                    "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fas fa-edit"></i>Editar</button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcliente.')"><i class="fas fa-times"></i>Anular</button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil">Editar</i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idcliente.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->idcliente,
                        "2"=>$reg->Nombre,
                    "3"=>$reg->Apellido,
                    "4"=>$reg->Correo,
                    "5"=>$reg->Telefono,
                    "6"=>$reg->Fecha,
                    "7"=>$reg->Hora,
                    "8"=>$reg->Lugar,
                    "9"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
                    '<span class="label bg-red">Desactivado</span>'
                    );
            }
            $results = array(
                "sEcho"=>1, //Información para el datatables
                "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                "aaData"=>$data);
            echo json_encode($results);
   
       break;
        break;
}
?>