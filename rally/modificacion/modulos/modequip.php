<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de modificacion de equipo
    Copyright (C) 2013  Alejandro Ramirez Reyes, Cesar Eduardo Mendoza Valencia
	
    Este programa es software libre: usted puede redistribuirlo y / o modificarlo
    bajo los términos de la Licencia Pública General GNU publicada por
    la Fundación para el Software Libre, ya sea la versión 3 de la Licencia, o
    cualquier versión posterior.

    Este programa se distribuye con la esperanza de que sea útil,
    pero SIN NINGUNA GARANTÍA, incluso sin la garantía implícita de
    COMERCIALIZACIÓN o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. Consulte la
    GNU General Public License para más detalles.

	Debería haber recibido una copia de la Licencia Pública General de GNU
    junto con este programa. Si no es así, consulte <http://www.gnu.org/licenses/>
	
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>. -->
	
	<?php
    session_start();
    include('../../lib/config.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
	<title>Equipo modificado</title>
	<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>
<body>
	<br>
	<?php require_once('../../lib/config.php');
		$numequipo=$_POST['num_equipo'];
		$nombre=$_POST['nomeq'];
		$nivel=$_POST['niveq'];
		$representante=$_POST['miembros'];
		$calendario=$_POST['calen'];
		$fotoactual=$_POST['fotoarchivo'];
		$rutafoto="../../images/equipos/$fotoactual";
		//echo(" '".$rutafoto."' es la ruta '");
		if(isset($_FILES['fotoeq']['name'])){
			$fotoequipo=$_FILES['fotoeq']['name'];
			if($_FILES['fotoeq']['type']!=="image/jpeg" and $_FILES['fotoeq']['name']!==''){
			die("la imagen del equipo debe ser jpg o jpeg");
			}
			//echo("recibio el nombre de la foto");
		}
		 else{
			$fotoequipo='';
			//echo("no recibio el nombre de la foto");
		 }
		//echo("numero".$numequipo."deequipo");
		$nombrefoto=$calendario."eq".$numequipo.".jpg";
		
		
		if($fotoequipo!=''){
			if(file_exists($rutafoto)){
			unlink($rutafoto);
			move_uploaded_file($_FILES['fotoeq']['tmp_name'], "../../images/equipos/".$nombrefoto ) or die (" no se ha podido Cargar la Imagen ");
			//echo("imagen reemplazada");
			}
			else{
					move_uploaded_file($_FILES['fotoeq']['tmp_name'], "../../images/equipos/".$nombrefoto ) or die (" no se ha podido Cargar la Imagen ");
					//echo("imagen subida");
			}
		}
		
		mysqli_query($conn,"Update equipos set nombre='$nombre' , nivel='$nivel' , representante='$representante' , foto='$nombrefoto' , calendario='$calendario' where num_equipo='$numequipo'") or die("no se pudo modificar el equipo ".mysqli_error($conn));
		echo("Equipo Modificado");
		$resultado=$_SESSION['usuario_nombre']." modific&oacute el equipo ".$numequipo;
		$usuario_id = $_SESSION['usuario_id'];
                    mysqli_query($conn,"insert into log (usuario,evento) values('$usuario_id','$resultado')") or die("error al escribir en el log".mysqli_error($conn));
	?>
	
<?php mysqli_close($conn); ?></body>

</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>