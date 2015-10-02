<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script PHP para la creacion de reactivos a la base de datos
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
<html>
	<head>
		<title>Alta Reactivo</title>
                
    <link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<?php
		require_once('../../lib/config.php');
		$folio=mysqli_query ($conn,"SELECT AUTO_INCREMENT as folio FROM INFORMATION_SCHEMA.TABLES
                                    WHERE table_schema = 'prally'
                                    AND table_name = 'reactivos'");
		$fol=mysqli_fetch_array($folio);
		$fo=$fol['folio'];
                $minutos=$_POST['minutos'];
                $segundos=$_POST['segundos'];
		//$num_mesa=$_POST['num'];
		$descripcion=$_POST['des'];
		$fotodes=$_FILES['fotodes']['name'];
		if ($_FILES["fotodes"]["type"] !== "image/jpeg" and $_FILES['fotodes']['name']!==''){
		print("la imagen de descripcion debe ser .JPG o .JPEG ") and die() ;
		}
		$opciona=$_POST['opa'];
		$opcionb=$_POST['opb'];
		$opcionc=$_POST['opc'];
		
		$fotoopca=$_FILES['fotoa']['name'];
		//Solo se aceptan formatos jpg jpeg
		if ($_FILES["fotoa"]["type"] !== "image/jpeg" and $_FILES['fotoa']['name']!==''){
		print("la imagen de la opcion A debe ser .JPG o .JPEG ") and die() ;
		}
		$fotoopcb=$_FILES['fotob']['name'];
		if ($_FILES["fotob"]["type"] !== "image/jpeg" and $_FILES['fotob']['name']!==''){
		print("la imagen de la opcion B debe ser .JPG o .JPEG ") and die() ;
		}
		$fotoopcc=$_FILES['fotoc']['name'];
		if ($_FILES["fotoc"]["type"] !== "image/jpeg" and $_FILES['fotoc']['name']!==''){
		print("la imagen de la opcion C debe ser .JPG o .JPEG ") and die() ;
		}
		$respuesta=$_POST['res'];
		$nivel= $_POST['lvl'];
		$materia=$_POST['mat'];
		

		
		echo("El reactivo numero "."$fo"." fue registrado.");
		$nombrefotodes=$fo."des.jpg";
		$nombrefotoa=$fo."opca.jpg";
		$nombrefotob=$fo."opcb.jpg";
		$nombrefotoc=$fo."opcc.jpg";
		
		if($fotodes!='')
		{
			move_uploaded_file($_FILES['fotodes']['tmp_name'], "../../images/reactivos/".$nombrefotodes ) or die (" no se ha podido Cargar la Imagen ");
		}
		if($fotoopca!='')
		{
			move_uploaded_file($_FILES['fotoa']['tmp_name'], "../../images/reactivos/".$nombrefotoa ) or die (" no se ha podido Cargar la Imagen ");
		}
		if($fotoopcb!='')
		{
			move_uploaded_file($_FILES['fotob']['tmp_name'], "../../images/reactivos/".$nombrefotob ) or die (" no se ha podido Cargar la Imagen ");
		}
		if($fotoopcc!='')
		{
			move_uploaded_file($_FILES['fotoc']['tmp_name'], "../../images/reactivos/".$nombrefotoc ) or die (" no se ha podido Cargar la Imagen ");
		}
		
		mysqli_query ($conn,"INSERT INTO reactivos (descripcion, foto_desc, opca, opcb, opcc, fotoa, fotob, fotoc, respuesta, nivel, materia) values ('$descripcion','$nombrefotodes','$opciona','$opcionb','$opcionc','$nombrefotoa','$nombrefotob','$nombrefotoc','$respuesta','$nivel','$materia')") or die("error al insertar el equipo ".mysqli_error($conn));
                mysqli_query ($conn,"insert into tiemposreact values('$fo','$minutos','$segundos')") or die("no se pudo insertar el tiempo del reactivo".mysqli_error($conn));
		$resultado=$_SESSION['usuario_nombre']." registr&oacute el nuevo reactivo numero ".$fo;
		$usuario_id = $_SESSION['usuario_id'];
                    mysqli_query($conn,"insert into log (usuario, evento) values('$usuario_id','$resultado')") or die("error al escribir en el log".mysqli_error($conn));
		
		
?>
<p><a href="javascript:history.back(1)">Agregar otra pregunta </a></p>
<?php mysqli_close($conn); ?>
</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>
