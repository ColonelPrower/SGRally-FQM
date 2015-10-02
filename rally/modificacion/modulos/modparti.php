<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de modificacion de participantes de un equipo 
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
		<title>Participante modificado</title>
    <link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php require_once('../../lib/config.php'); 
		$codigo=$_POST['code'];
		$nombre=$_POST['nom'];
		$telefono=$_POST['tel'];
		$numequipo=$_POST['num'];
		$carrera=$_POST['car'];
		$semestre=$_POST['sem'];
		$nombredefoto=$_POST['nombrefoto'];
		
		$rutafoto="../../images/participantes/$nombredefoto";
		if(isset($_FILES['foto']['name'])){
			$fotopar=$_FILES['foto']['name'];
			if($_FILES['foto']['type']!=="image/jpeg" and $_FILES['foto']['name']!==''){
				die("La foto del participante debe ser jpg o jpeg");
			}
		}
		 else{
			$fotopar='';
		 }
		$nombrefoto=$codigo.".jpg";
		
		
		if($fotopar!=''){
			if(file_exists($rutafoto)){
			unlink($rutafoto);
			move_uploaded_file($_FILES['foto']['tmp_name'], "../../images/participantes/".$nombrefoto ) or die (" no se ha podido Cargar la Imagen ");
			//echo("imagen reemplazada");
			}
			else{
					move_uploaded_file($_FILES['foto']['tmp_name'], "../../images/participantes/".$nombrefoto ) or die (" no se ha podido Cargar la Imagen ");
					//echo("imagen subida");
			}
		}
		mysqli_query($conn,"Update participantes set  nombre='$nombre' , telefono='$telefono' , foto='$nombrefoto' , num_equipo='$numequipo' , carrera='$carrera' , semestre='$semestre' where codigo='$codigo'") or die("no se pudo modificar el equipo ".mysqli_error($conn));
		echo("participante modificado");
		?>
	<?php mysqli_close($conn); ?></body>

</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>