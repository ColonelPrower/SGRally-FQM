
<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de configuracion del Sistema. no se edite a menos de lo que se esta haciendo, puede dejar
	el sistema inutilizable o con errores.
    Copyright (C) 2013-2015  Alejandro Ramirez Reyes, Cesar Eduardo Mendoza Valencia
	
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
//Archivo de conexion a la base de datos y zona horaria
//si se va a usar en otro pais o zona horaria cambie la funcion date_default_timezone_set
//al parametro de la zona info aqui http://www.php.net/manual/en/timezones.america.php
date_default_timezone_set("America/Mexico_City");
 header("Content-type: text/html; charset=ISO-8859-1");
 $correo="correo@rally.com";
$servidorsql= "localhost";//escribe aqui el nombre del servidor de mysql
$basededatos= "prally";//NO MODIFICAR EL NOMBRE DE LA BASE DE DATOS A MENOS QUE SABE LO QUE ESTA HACIENDO, ESTE DEBE SER IGUAL AL DEL GESTOR DE BASE DE DATOS
$nombredeusuario= "root";//escribe aqui el nombre de usuario de la base de datos
$contrasena= "";//escribe la contraseña de la base de datos, en blanco y sin espacios si no tiene contraseña
$conn = new mysqli($servidorsql, $nombredeusuario, $contrasena, $basededatos);
if ($conn->connect_errno) {
    printf("Falló la conexión a la Base de datos: %s\n", $conn->connect_error);
    die();
}
//$conn = mysqli_connect("$servidorsql","$nombredeusuario","$contrasena") or die ("error en la conexion a la base de datos".mysqli_error($conn));
//mysqli_select_db("$basededatos", $conn) or die ("error en la eleccion de la base de datos".mysqli_error($conn));
?>
