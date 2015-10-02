<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de comprobacion del usuario al hacer login
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
<title></title>
</head>

<body><?php 
    session_start(); 
    include('../lib/config.php'); 
    if(isset($_POST['enviar'])) { // comprobamos que se hayan enviado los datos del formulario 
        // comprobamos que los campos usuarios_nombre y usuario_clave no estén vacíos 
        if(empty($_POST['usuario_nombre']) || empty($_POST['usuario_clave'])) { 
            echo "El usuario o la contraseña no han sido ingresados. <a href='javascript:history.back();'>Reintentar</a>"; 
        }else { 
            // "limpiamos" los campos del formulario de posibles códigos maliciosos 
            $usuario_nombre = mysqli_real_escape_string($conn,$_POST['usuario_nombre']); 
            $usuario_clave = mysqli_real_escape_string($conn,$_POST['usuario_clave']); 
            $usuario_clave = md5($usuario_clave); 
            // comprobamos que los datos ingresados en el formulario coincidan con los de la BD 
            $sql = mysqli_query($conn,"SELECT usuario_id, usuario_nombre, usuario_clave FROM usuarios WHERE usuario_nombre='".$usuario_nombre."' AND usuario_clave='".$usuario_clave."'")or die("error en sql:".mysqli_error($conn)); 
            if($row = mysqli_fetch_array($sql)) { 
                $_SESSION['usuario_id'] = $row['usuario_id']; // creamos la sesion "usuario_id" y le asignamos como valor el campo usuario_id 
                $_SESSION['usuario_nombre'] = $row["usuario_nombre"]; // creamos la sesion "usuario_nombre" y le asignamos como valor el campo usuario_nombre 
                header("Location: ../index.php"); 
            }else { ?> 
                Error, <a href="acceso.php">Reintentar</a>  
<?php 
            } 
        } 
    }else { 
        header("Location: acceso.php"); 
    } 
?>
</body>
</html>