<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script para la eliminacion de un reactivo en la base de datos.
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
    along with this program.  If not, see <http://www.gnu.org/licenses/>. --><?php
    session_start();
    include('../../lib/config.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>
<html>
	<head>
		<title>Eliminar Reactivo</title>
		<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<center>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<?php
		require_once('../../lib/config.php');
		
		$fol=$_POST['fol'];
 		$rutafotodes="../../images/reactivos/".$_POST['foto_desc'];
		$rutafotoa="../../images/reactivos/".$_POST['fotoa'];
		$rutafotob="../../images/reactivos/".$_POST['fotob'];
		$rutafotoc="../../images/reactivos/".$_POST['fotoc'];
				
		$registro=mysqli_query($conn,"select *from reactivos where folio='$fol'");

		if($reg=mysqli_fetch_array($registro))
		{
			$registro=mysqli_query($conn,"delete from reactivos where folio='$fol'")or die("Error en la eliminacion ".mysqli_error($conn));
                        mysqli_query($conn,"delete from tiemposreact where id_preg='$fol'");
                        
		if(file_exists($rutafotodes)){
		$dodes = unlink($rutafotodes);
		}
			if(file_exists($rutafotoa)){
			$doa = unlink("$rutafotoa");
			}
			if(file_exists($rutafotob)){
			$dob = unlink("$rutafotob");
			}
			if(file_exists($rutafotoc)){
			$doc = unlink("$rutafotoc");
			}
			echo "<p> El reactivo ha sido eliminado </p>";
			$resultado=$_SESSION['usuario_nombre']." elimin&oacute el reactivo numero ".$fol;
			$usuario_id = $_SESSION['usuario_id'];
                    mysqli_query($conn,"insert into log (usuario , evento) values('$usuario_id','$resultado')") or die("error al escribir en el log".mysqli_error($conn));
		}
		else
		{
			echo "<p>Reactivo no existente</p>";
		}		
		mysqli_close($conn);

		?></center>
	</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>