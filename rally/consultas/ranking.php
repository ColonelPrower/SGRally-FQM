<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de generacion del ranking o clasificacion del Rally.
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
		<meta content="text/html; charset=UTF-8" http-equiv="content-type"><title>Ranking del Rally</title>
		<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
			<title>Ranking</title>
	</head>
		<body>
		<?php require_once("../lib/config.php"); 
		$consultaNivel1=mysqli_query($conn,"select * from ranking where num_equipo = any (select num_equipo from equipos where nivel = 1) order by aciertos desc, duracion asc ")or die("no se pudo consultar el ranking".mysqli_error($conn));
		$consultaNivel2=mysqli_query($conn,"select * from ranking where num_equipo = any (select num_equipo from equipos where nivel = 2) order by aciertos desc, duracion asc ")or die("no se pudo consultar el ranking".mysqli_error($conn));
		$consultaNivel3=mysqli_query($conn,"select * from ranking where num_equipo = any (select num_equipo from equipos where nivel = 3) order by aciertos desc, duracion asc ")or die("no se pudo consultar el ranking".mysqli_error($conn));

		if (mysqli_num_rows($consultaNivel1)==0)	
		{
		print("No hay equipos que hayan terminado en el nivel I");
		}
		else{?>
		<div style="text-align: center;">
			<h1>Ranking del rally nivel I</h1>
			<br>
			<table style="width: 552px; height: 36px; text-align: left; margin-left: auto; margin-right: auto;" border="1" cellpadding="2" cellspacing="2">
				<tbody>
					<tr>
						<td style="font-weight: bold; text-align: center;">Posición</td>
						<td style="font-weight: bold; text-align: center;">Equipo</td>
						<td style="font-weight: bold; text-align: center;">Nombre</td>
						<td style="font-weight: bold; text-align: center;">Aciertos</td>
						<td style="font-weight: bold; text-align: center;">Duración</td>
						<td style="font-weight: bold; text-align: center;">Fecha y hora de finalización</td>
					</tr>
					
					<?php $cuenta=0;
					while($filas=mysqli_fetch_array($consultaNivel1)){
					$equipo=$filas['num_equipo'];
					$cuenta=$cuenta+1;
					$nomequipo=mysqli_query($conn,"select nombre from equipos where num_equipo='$equipo'");
					$nombre=mysqli_fetch_array($nomequipo);
					echo("<tr>");
					echo("<td>".$cuenta."&deg"."</td>");
					echo("<td>".$equipo."</td>");
					echo("<td>".$nombre['nombre']."</td>");	
					echo("<td>".$filas['aciertos']."</td>");
					echo("<td>".$filas['duracion']."</td>");
					echo("<td>".$filas['fecha']."</td>");
					echo("</tr>");
					}
				
			}?>
				</tbody>
			</table>
		</div>
		<?php if (mysqli_num_rows($consultaNivel2)==0)	
		{
		print("No hay equipos que hayan terminado en el nivel 2");
		}
		else { ?>
		<div style="text-align: center;">
			<h1>Ranking del rally nivel II</h1>
			<table style="width: 552px; height: 36px; text-align: left; margin-left: auto; margin-right: auto;" border="1" cellpadding="2" cellspacing="2">
				<tbody>
					<tr>
						<td style="font-weight: bold; text-align: center;">Posición</td>
						<td style="font-weight: bold; text-align: center;">Equipo</td>
						<td style="font-weight: bold; text-align: center;">Nombre</td>
						<td style="font-weight: bold; text-align: center;">Aciertos</td>
						<td style="font-weight: bold; text-align: center;">Duración</td>
						<td style="font-weight: bold; text-align: center;">Fecha y hora de finalización</td>
					</tr>
					
					<?php $cuenta=0;
					while($filas=mysqli_fetch_array($consultaNivel2)){
					$equipo=$filas['num_equipo'];
					$cuenta=$cuenta+1;
					$nomequipo=mysqli_query($conn,"select nombre from equipos where num_equipo='$equipo'");
					$nombre=mysqli_fetch_array($nomequipo);
					echo("<tr>");
					echo("<td>".$cuenta."&deg"."</td>");
					echo("<td>".$equipo."</td>");
					echo("<td>".$nombre['nombre']."</td>");	
					echo("<td>".$filas['aciertos']."</td>");
					echo("<td>".$filas['duracion']."</td>");
					echo("<td>".$filas['fecha']."</td>");
					echo("</tr>");
					}
				
			}?>
				</tbody>
			</table>	
		</div>
			
		<?php if (mysqli_num_rows($consultaNivel3)==0)	
		{
		print("No hay equipos que hayan terminado en el nivel 2");
		}
		else { ?>
		<div style="text-align: center;">
			<h1>Ranking del rally nivel III</h1>
			<table style="width: 552px; height: 36px; text-align: left; margin-left: auto; margin-right: auto;" border="1" cellpadding="2" cellspacing="2">
				<tbody>
					<tr>
						<td style="font-weight: bold; text-align: center;">Posición</td>
						<td style="font-weight: bold; text-align: center;">Equipo</td>
						<td style="font-weight: bold; text-align: center;">Nombre</td>
						<td style="font-weight: bold; text-align: center;">Aciertos</td>
						<td style="font-weight: bold; text-align: center;">Duración</td>
						<td style="font-weight: bold; text-align: center;">Fecha y hora de finalización</td>
					</tr>
					
					<?php $cuenta=0;
					while($filas=mysqli_fetch_array($consultaNivel3)){
					$equipo=$filas['num_equipo'];
					$cuenta=$cuenta+1;
					$nomequipo=mysqli_query($conn,"select nombre from equipos where num_equipo='$equipo'");
					$nombre=mysqli_fetch_array($nomequipo);
					echo("<tr>");
					echo("<td>".$cuenta."&deg"."</td>");
					echo("<td>".$equipo."</td>");
					echo("<td>".$nombre['nombre']."</td>");	
					echo("<td>".$filas['aciertos']."</td>");
					echo("<td>".$filas['duracion']."</td>");
					echo("<td>".$filas['fecha']."</td>");
					echo("</tr>");
					}
				}?>
				</tbody>
			</table>
		</div>
		<?php mysqli_close($conn); ?>
	</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>