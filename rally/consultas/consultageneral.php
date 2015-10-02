<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de consulta general de Equipos.
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
<head><meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
	<title>Equipos registrados</title>
	<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once('../lib/config.php'); 
$consulta=mysqli_query($conn,"Select * from equipos order by num_equipo asc");
?>
	<h1 style="text-align: center;">Equipos Registrados</h1>
	<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
	<tbody>
	<tr>
		<td style="font-weight: bold;">N&uacute;mero del equipo</td>
		<td style="font-weight: bold;">Nombre del equipo</td>
		<td style="font-weight: bold;">Nivel del equipo</td>
		<td style="font-weight: bold;">Representante</td>
		<td style="font-weight: bold;">Fecha de registro</td>
		<td style="font-weight: bold;">Hora de registro</td>
		<td style="font-weight: bold;">Calendario</td>
		<td style="font-weight: bold;">Imagen del equipo</td>
	</tr>
<?php 
while($fila=mysqli_fetch_array($consulta)){
	$repre=$fila['representante'];
	$consulta2=mysqli_query($conn,"select nombre from participantes where codigo='$repre'") or die("error al sacar el representante ".mysqli_error($conn));
	$rep=mysqli_fetch_array($consulta2);
	echo("<tr>");
	echo("<td>".$fila['num_equipo']."</td>");
	echo("<td>".$fila['nombre']."</td>");
	echo("<td>".$fila['nivel']."</td>");
	echo("<td>".$rep['nombre']."</td>");
	echo("<td>".$fila['fecha_reg']."</td>");
	echo("<td>".$fila['hora_reg']."</td>");
	echo("<td>".$fila['calendario']."</td>");
	//si existe foto del equipo
	if(file_exists("../images/equipos/".$fila['foto'])){
	echo("<td><img style='width: 120px; height: 120px;' src='../images/equipos/".$fila['foto']."'>"."</td>");
	}
	else{
		echo("<td><img style='width: 120px; height: 120px;' src='../images/equipos/default.jpg'>"."</td>");
	}
	echo("</tr>");
}
?>
	</tbody>
	</table>
	<?php mysqli_close($conn) ?>
</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>