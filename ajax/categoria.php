<?php

require_once "../modulo/ejecutarSQL.php";

$contacto=new ejecutarSQL();


$idcontacto=isset($_POST["idcontacto"])? limpiarCadena($_POST["idcontacto"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$correo=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$telefono=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$fecha=isset($_POST["hora"])? limpiarCadena($_POST["hora"]):"";
$hora=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$lugar=isset($_POST["mensaje"])? limpiarCadena($_POST["mensaje"]):"";



switch ($_GET["op"]){
    case 'guardaryeditar':
        $ms = "Registro el contacto";

        if (empty($idcontacto))
        {
            $sql = "INSERT INTO `contacto`(`nombre`, `apellido`, `telefono`, `correo`, `hora`,`fecha`,`mensaje`,`condicion`) 
                VALUES ('$nombre','$apellido', '$telefono', '$correo', '$hora', '$fecha','$mensaje',1)";

        } else {

            $sql = "UPDATE `contacto` set `idcontacto`='$idcontacto',`nombre`='$nombre', `apellido`='$apellido', `telefono`='$telefono',
             `correo`='$correo', `hora`='$hora', `fecha`='$fecha',`mensaje`='$mensaje' WHERE idcontacto = '$idcontacto'";

            $ms = "Edito el Registro de el contacto";
          
        }
        $respuesta = $contacto->insertar($sql);
        echo $respuesta ? $ms : "El contacto no se pudo ingresar";     
break;
    
case 'mostrar':
    
$sql="SELECT * FROM `contacto` WHERE idcontacto=".$idcontacto;
$respuesta=$contacto->mostrar($sql);
echo json_encode($respuesta);

break;

case 'activar':
    $sql = "update `contacto` set condicion=1 WHERE idcontacto=".$idcontacto;
    $respuesta = $contacto->insertar($sql);
    echo $respuesta ? "Se activo el contacto" : "El contacto no se pudo ingresar";     
        
    break;

case 'desactivar':
    $sql="update `contacto` set condicion=0 WHERE idcontacto=".$idcontacto;
    $respuesta = $contacto->insertar($sql);
    echo $respuesta ? "Se desactivo el contacto" : "El contacto no se pudo ingresar";     

    break;

    case 'listar':
            $rspta=$contacto->listar("select * from  contacto");
            //Vamos a declarar un array
            $data= Array();
   
            while ($reg=$rspta->fetch_object()){
                $data[]=array(
                    "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcontacto.')"><i class="fas fa-edit"></i>Editar</button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcontacto.')"><i class="fas fa-times"></i>Anular</button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idcontacto.')"><i class="fa fa-pencil">Editar</i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idcontacto.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->idcontacto,
                        "2"=>$reg->nombre,
                    "3"=>$reg->apellido,
                    "4"=>$reg->telefono,
                    "5"=>$reg->correo,
                    "6"=>$reg->hora,
                    "7"=>$reg->fecha,
                    "8"=>$reg->mensaje,
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