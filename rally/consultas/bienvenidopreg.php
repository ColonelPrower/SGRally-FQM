<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Pantalla de bienvenida  para contestar un reactivo.
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
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Bienvenido</title>

<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
</head><body>
<?php 
$mesa=$_POST['mesa'];
$niv=$_POST['lvl'];
//checkboxes
$fisica='no';
$quimica='no';
$matematicas='no';
if(isset($_POST['fisica'])){
$fisica=$_POST['fisica'];}
if(isset($_POST['quimica'])){
$quimica=$_POST['quimica'];}
if(isset($_POST['matematicas'])){
$matematicas=$_POST['matematicas'];}
//fin checkboxes	
?>
<h1 style="text-align: center;">
Bienvenido a</h1><h1 style="text-align: center;">
la </h1><h1 style="text-align: center;">
mesa</h1><h1 style="text-align: center;">
<?php echo($mesa)?></h1>
<br>
<form method="post" action="generarpreguntacop.php" name="genpreg">
<input name="mesa" value="<?php echo($mesa) ?>" type="hidden">
<input name="lvl" value="<?php echo($niv) ?>" type="hidden">
<input name="fis" value="<?php echo($fisica) ?>" type="hidden"> 
<input name="quim" value="<?php echo($quimica) ?>" type="hidden">
<input name="mat" value="<?php echo($matematicas) ?>" type="hidden">
<br><div style="text-align: center;">
teclea el N&uacute;mero de tu equipo <b>Si se omite, se te anular&aacute; tu respuesta</b> <br><input name="eq" type="text">
<br>
<input name="generarpreg" value="Generar Pregunta" type="submit"></div></form>

</body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>