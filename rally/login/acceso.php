<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Pantalla de acceso al sistema.
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
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login al sistema gestor de Rally</title>
</head>

<body>
<?php 
    session_start(); 
    include('../lib/config.php'); 
    if(empty($_SESSION['usuario_nombre'])) { // comprobamos que las variables de sesión estén vacías         
?> 
        <form action="comprobar.php" method="post"> 
            <label>Usuario:</label><br /> 
            <input type="text" name="usuario_nombre" /><br /> 
            <label>Contrase&ntilde;a:</label><br /> 
            <input type="password" name="usuario_clave" /><br /> 
            <input type="submit" name="enviar" value="Ingresar" /> 
        </form>          
<a href="recuperar_contrasena.php"	> Recuperar contrase&ntilde;a</a>
<?php 
    }else { 
?> 
<p>Hola <strong><?=$_SESSION['usuario_nombre']?></strong> |<a href="../index.php">ir al inicio</a> | <a href="logout.php">Salir</a></p> 
<?php 
    } 
?>
</body>
</html>