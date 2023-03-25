<?php

if (strlen(session_id()) < 1) 
  session_start();
require_once "../modulo/ejecutarSQL.php";

$categoria=new ejecutarSQL();


$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$clave=isset($_POST["password"])? limpiarCadena($_POST["password"]):"";

switch ($_GET["op"]){


    case 'permisos':
    
        	
		$rspta = $categoria->listar("select * from permisos ");
      
            
		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados =$categoria->listar("SELECT * FROM `detalleusuarios` where idusuario=".$id);

		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}
            echo '<li> Inicio </li>';
            
		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermisos,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermisos.'">'.$reg->permisos.'</li>';
				}
	
               
		break;

    
    case 'guardaryeditar':
                $ms="Registro la categoria";


        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}

$sql1="";
                if (empty($idcategoria))
                {
                    $sql=" INSERT INTO `usuarios`( `login`, `nombre`, `clave`, `correo`, `imagen`, `condicion`) VALUES ('$login','$nombre','$clave','$correo','$imagen',1)";
                  

                         
                }else
                
                {
                    $sql="Update `categoria` set `categoria`='$nombre', descripcion='$descripcion' where idcategoria='$idcategoria'";
                $ms="Edito el Registro de la categoria";
                  


                }
                $respuesta=$categoria->insertar($sql);

                $perx=$_POST["permiso"];

                $i=0;

                while ($i < count($perx)){
$sql="INSERT INTO `detalleusuarios`( `idusuario`, `permiso`) VALUES ( (select max(idusuario) from usuarios)  , '$perx[$i]' )";
$respuesta=$categoria->insertar($sql);
                    $i++;
                }


                 echo $respuesta ? $ms :   $sql1."El usuario no fue registrado";     
              


    break;
case 'mostrar':
    
$sql="SELECT * FROM `categoria` WHERE idcategoria=".$idcategoria;
$respuesta=$categoria->mostrar($sql);
echo json_encode($respuesta);



break;
case 'activar':
    $sql="update `categoria` set condicion=1 WHERE idcategoria=".$idcategoria;
    $respuesta=$categoria->insertar($sql);
    echo $respuesta ? "Se activo  la categoria" : "La categoria no se pudo ingresar";     
              

    break;
case 'desactivar':
    $sql="update `categoria` set condicion=0 WHERE idcategoria=".$idcategoria;
    $respuesta=$categoria->insertar($sql);
    echo $respuesta ? "Se desactivo la categoria" : "La categoria no se pudo ingresar";     
              

    break;
    case 'verificar':
        $logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];
        $xs="select * from usuarios where login='".$logina."' and nombre='".$clavea."'";
	    $inf=0;
        $_SESSION['bandera']="";
        
        $valores=array();
        $_SESSION['categoriap']=100;
      //  $rspta1=$categoria->listar("SELECT d.permiso FROM `detalleusuario` d inner join  usuario u on d.idusuario=u.idusuario where  u.login='".$logina."' and u.clave='".$clavea."'");

  /*     while ($reg1=$rspta1->fetch_object()){
           // array_push($valores,$reg1->permiso);
           echo $reg1->permiso;
            if ($reg1->permiso==="1")
                     $_SESSION['categoriap']=1:

        }*/
       



        $rspta=$categoria->listar("select * from usuarios where login='".$logina."' and clave='".$clavea."'");
        while ($reg=$rspta->fetch_object()){
            $_SESSION['bandera']="1";
            $idx=$reg->idusuario;
            $_SESSION['login1']=$reg->login;
            $_SESSION['nombre1']=$reg->nombre;
            $_SESSION['imagen']=$reg->imagen;
            $inf=1;


        }
        $inf=$inf." ".$idx;
        $rspta=$categoria->listar("select * from  `detalleusuarios` where idusuario=".$idx);
        while ($reg=$rspta->fetch_object()){
            array_push($valores,$reg->permiso);
            //$_SESSION['categoriap']=$reg->permiso;
        

        }
        in_array(1,$valores) ? $_SESSION['categoriap']=1:$_SESSION['categoriap']=0;
        in_array(2,$valores) ? $_SESSION['prodinsert']=1:$_SESSION['prodinsert']=0;
        in_array(3,$valores) ? $_SESSION['prodedit']=1:$_SESSION['prodedit']=0;
        in_array(4,$valores) ? $_SESSION['prodanular']=1:$_SESSION['prodanular']=0;
        
        echo json_encode(  $inf);

    break;
        case 'listar':
            $rspta=$categoria->listar("select * from  usuarios order by nombre desc");
            //Vamos a declarar un array
            $data= Array();
   
            while ($reg=$rspta->fetch_object()){
                $data[]=array(
                    "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')">Editar</button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')">Anular</button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil">Editar</i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->login,
                        "2"=>$reg->nombre,
                    "3"=>'<img src=../files/usuarios/'.$reg->imagen.' width=36 height=36 >',
                    "4"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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