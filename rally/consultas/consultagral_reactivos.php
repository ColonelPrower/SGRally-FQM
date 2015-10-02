<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de consulta general de los reactivos
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
	header("Content-type: text/html; charset=ISO-8859-1");
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"><title>Lista de Reactivos</title>

<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
</head><body>
<?php 
$consulta=mysqli_query($conn,"Select * from reactivos order by folio asc");
?>

<h1 style="text-align: center;">Lista de Reactivos</h1>
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="font-weight: bold;">Folio</td>
<td style="font-weight: bold;">Descripci&oacute;n</td>
<td style="font-weight: bold;">Opci&oacute;n A</td>
<td style="font-weight: bold;">Opci&oacute;n B</td>
<td style="font-weight: bold;">Opci&oacute;n C</td>
<td style="font-weight: bold;">Respuesta</td>
<td style="font-weight: bold;">Nivel</td>
<td style="font-weight: bold;">Materia</td>
</tr>
<?php 
while($fila=mysqli_fetch_array($consulta)){
	echo("<tr>");
	echo("<td>".$fila['folio']."</td>");
	echo("<td>".$fila['descripcion']);
	if(file_exists("../images/reactivos/".$fila['foto_desc'])){
		
	echo("<a href='../images/reactivos/".$fila['foto_desc']."' target=_blank><img style='width: 120px; height: 120px;' src='../images/reactivos/".$fila['foto_desc']."'></a>"."</td>");
	}
	else{
		
		echo("</td>");
	}
	echo("<td>".$fila['opca']);
	if(file_exists("../images/reactivos/".$fila['fotoa'])){
		
	echo("<a href='../images/reactivos/".$fila['fotoa']."' target=_blank><img style='width: 120px; height: 120px;' src='../images/reactivos/".$fila['fotoa']."'></a>"."</td>");
	}
	else{
		
		echo("</td>");
	}
	echo("<td>".$fila['opcb']);
	if(file_exists("../images/reactivos/".$fila['fotob'])){
		
	echo("<a href='../images/reactivos/".$fila['fotob']."' target=_blank><img style='width: 120px; height: 120px;' src='../images/reactivos/".$fila['fotob']."'></a>"."</td>");
	}
	else{
		
		echo("</td>");
	}
	echo("<td>".$fila['opcc']);
	if(file_exists("../images/reactivos/".$fila['fotoc'])){
		
	echo("<a href='../images/reactivos/".$fila['fotoc']."' target=_blank><img style='width: 120px; height: 120px;' src='../images/reactivos/".$fila['fotoc']."'></a>"."</td>");
	}
	else{
		
		echo("</td>");
	}
	echo("<td>".$fila['respuesta']."</td>");
	echo("<td>".$fila['nivel']."</td>");
	echo("<td>".$fila['materia']."</td>");
	echo("</tr>");
}
?>

</tbody>
</table>
<?php mysqli_close($conn); ?></body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>