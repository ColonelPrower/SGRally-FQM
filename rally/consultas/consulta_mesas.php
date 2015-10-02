<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de Consulta de Estaciones o mesas con su profesor encargado
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
    include('../lib/config.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
		<title>Lista de las mesas</title>
    <link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<?php require_once("../lib/config.php"); 
	$consulta=mysqli_query($conn,"Select num_mesa,maestro from mesas")or die("no se pudieron consultar las mesas".mysqli_error($conn));
	if (mysqli_num_rows($consulta)==0)
	{
	print("No existen mesas")and die();
	}
		?>
		<h1 style="text-align: center;">Listado de las Mesas</h1>
		<table style="width: 400px; text-align: left; margin-left: auto; margin-right: auto;" border="1" cellpadding="2" cellspacing="2">
			<tbody>
			<tr>
				<td style="font-weight: bold;">N&uacute;mero de la Mesa</td>
				<td style="font-weight: bold;">Profesor encargado</td>
			</tr>
			<?php while($filas=mysqli_fetch_array($consulta)){
				$maestro=$filas['maestro'];
				$profesor=mysqli_query($conn,"select nombre from maestros where codigo='$maestro'");
				$prof=mysqli_fetch_array($profesor);
				echo("<tr>");
				echo("<td>".$filas['num_mesa']."</td>");
				echo("<td>".$prof['nombre']."</td>");	
				echo("</tr>");
			}?>
			</tbody>
		</table>
		<?php mysqli_close($conn); ?>
	</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>