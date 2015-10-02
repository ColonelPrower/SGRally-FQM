<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Formulario de Consulta de un equipo
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=ISO-8859-1" http-equiv="Content-Type"  />
	<title> Consultar Equipo</title>
	<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1 align="center"> Consultar un Equipo </h1>
<?php require_once('../lib/config.php');
$listaequipos= mysqli_query($conn,"Select * from equipos order by num_equipo");
?>
<form id="form1" name="form1" method="post" action="./modulos/detallesequipo.php">
<p align="center">Inserta el n&uacute;mero del equipo <input name="equipo" type="text" />
</p>
<p align="center"> <input name="enviar1" id="enviar1" value="consultar" type="submit" />
</p>
</form>
<form id="form2" name="form2" method="post" action="./modulos/detallesequipo.php">
<p align="center">Elige un equipo de la lista<?php if($row=mysqli_fetch_array($listaequipos))
{
echo ("<select name='equipo'>");
do {
echo("<option value='".$row['num_equipo']."'>");
echo($row['nombre']."</option>"); }
while($row=mysqli_fetch_array($listaequipos));
echo("</select>");
}
?>
</p>
<p align="center"> <input name="enviar2" id="enviar2" value="consultar" type="submit" />
</p>
</form>
<?php mysqli_close($conn); ?>
</body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>