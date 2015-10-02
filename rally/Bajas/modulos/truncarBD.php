<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script para  la eliminacion de datos de tablas de la base de datos para crear una nueva base de datos o reparar errores de base de datos.
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
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<title>Equipo eliminado</title>
<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
require_once('../../lib/config.php');

?>

<h1 align="center">¡Base de datos eliminada   
<?php
if(isset($_POST['borrapreg'])){
$preguntas=$_POST['borrapreg'];	
if($preguntas=="on"){
echo(", preguntas");
mysqli_query($conn,"Truncate reactivos");
mysqli_query($conn,"Truncate tiemposreact")
}
}
if(isset($_POST['borraequipos'])){
$equipos=$_POST['borraequipos'];	
if($equipos=="on"){
echo(",equipos");
mysqli_query($conn,"Truncate equipos");
}
}
if(isset($_POST['borramesas'])){
$mesas=$_POST['borramesas'];	
if($mesas=="on"){
echo(",mesas");
mysqli_query($conn,"Truncate mesas");
}
}
if(isset($_POST['borraparti'])){
$parti=$_POST['borraparti'];	
if($parti=="on"){
echo(",participantes");
mysqli_query($conn,"Truncate participantes");
}
}
if(isset($_POST['borrarespuestas'])){
$resp=$_POST['borrarespuestas'];	
if($resp=="on"){
echo(",respuestas");
mysqli_query($conn,"Truncate resultados");
}
}
if(isset($_POST['borraranking'])){
$rank=$_POST['borraranking'];	
if($rank=="on"){
echo(",ranking");
mysqli_query($conn,"Truncate ranking");
}
}
if(isset($_POST['borrahistorial'])){
$hist=$_POST['borrahistorial'];	
if($hist=="on"){
echo(",historial");
mysqli_query($conn,"Truncate historial");
}
}
mysql_close($conn);
?> reestablecidos!!</h1>


</body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>