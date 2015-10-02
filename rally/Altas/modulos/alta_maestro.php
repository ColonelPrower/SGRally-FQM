<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script para agregar un maestro encargado a la base de datos
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
	<title>Profesor Agregado</title>
	<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>
	
		<body>
		<?php 
			require_once('../../lib/config.php');
			$codigo=(string) $_POST['cod'];
			$nombre=$_POST['nom'];
			$materia=$_POST['mat'];
			$telefono=$_POST['tel'];
			$foto=$_FILES['foto']['name'];
			//Solo se aceptan formatos jpg jpeg
			if ($_FILES["foto"]["type"] !== "image/jpeg" and $_FILES['foto']['name']!==''){
			print("la foto debe ser .JPG o .JPEG ") and die() ;
			}
			$nombrefoto=$codigo.".jpg";
			if($foto!='')
			{
			move_uploaded_file($_FILES['foto']['tmp_name'], "../../images/maestros/".$nombrefoto ) or die (" no se ha podido Cargar la Imagen ");
			}
			mysqli_query($conn,"Insert into maestros values('$codigo','$nombre','$materia','$telefono','$nombrefoto')") or die("no se pudo insertar el nuevo profesor: ".mysqli_error($conn));
			echo("Profesor Agregado");
		
		mysqli_close($conn);
		?>
		</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>