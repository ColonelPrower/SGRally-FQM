<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de consulta de datos del rally de un año en especifico
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Historial</title>
</head>

<body>
<?php
require_once('../../lib/config.php');
$anio=$_POST['anio'];

$consulta=mysqli_query($conn,"Select * from historial where year(fecha)='$anio'") or die("No se pudo consultar el historial ".mysqli_error($conn));


?>
<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col">Equipo</th>
    <th scope="col">nombre</th>
    <th scope="col">C&oacute;digo del Representante</th>
    <th scope="col">Duraci&oacute;n</th>
    <th scope="col">Aciertos</th>
    <th scope="col">Fecha</th>
  </tr>
  <?php
  while($row=mysqli_fetch_array($consulta)){
	  echo("<tr>");
	  echo("<td>".$row['num_equipo']."</td>");
	  echo("<td>".$row['nombre']."</td>");
	  echo("<td>".$row['representante']."</td>");
	  echo("<td>".$row['duracion']."</td>");
	  echo("<td>".$row['aciertos']."</td>");
	  echo("<td>".$row['fecha']."</td>");
	  echo("</tr>");
  }?>
</table>
<?php mysqli_close($conn); ?>
</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>