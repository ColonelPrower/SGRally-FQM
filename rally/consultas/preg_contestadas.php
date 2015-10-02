<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de Consulta de  reactivos contestados.
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
		<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
		<title>Reactivos Contestados</title>
	</head>
	<body>
	<?php 
		require_once('../lib/config.php');
		$consulta=mysqli_query($conn,"Select * from resultados")or die("no se pudo consultar la base de datos ".mysqli_error($conn));
		
	?>
		<h1 style="text-align: center;">Reactivos Contestados</h1>
		<p> x significa que no contest&oacute;</p>
		<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
		<tbody>
			<tr>
				<td style="font-weight: bold;">Folio Pregunta</td>
				<td style="font-weight: bold;">Equipo</td>
				<td style="font-weight: bold;">Mesa</td>
				<td style="font-weight: bold;">Respuesta</td>
				<td style="font-weight: bold;">&iquest;Respuesta correcta?</td>
				<td style="font-weight: bold;">Hora de Inicio</td>
				<td style="font-weight: bold;">Hora de Término</td>
				<td style="font-weight: bold;">Duración</td>
			</tr>
			<?php 
				while($row=mysqli_fetch_array($consulta)){
					$equipo=$row['num_equipo'];
					$consulta2=mysqli_query($conn,"Select nombre from equipos where num_equipo='$equipo'") or die("no se pudo obtener el nombre de los equipos".mysqli_error($conn));
					$row2=mysqli_fetch_array($consulta2);
					echo("<tr>");
					echo("<td>".$row['pregunta']."</td>");
					echo("<td>".$row2['nombre']."</td>");
					echo("<td>".$row['num_mesa']."</td>");
					echo("<td>".$row['respuesta']."</td>");
					echo("<td>".$row['correcta']."</td>");
					echo("<td>".$row['hora_ini']."</td>");
					echo("<td>".$row['hora_fin']."</td>");
					echo("<td>".$row['duracion']."</td>");
					echo("</tr>");
				}
			mysqli_close($conn);?>
		</tbody>
		</table>
	</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>