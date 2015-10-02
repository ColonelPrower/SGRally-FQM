<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script para cambiar la contraseña del usuario.
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
<title>Cambiar contraseña</title>
</head>

<body>
<?php 
    session_start(); 
    include('../lib/config.php'); // incluímos los datos de conexión a la BD 
    if(isset($_SESSION['usuario_nombre'])) { // comprobamos que la sesión esté iniciada 
        if(isset($_POST['enviar'])) { 
            if($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) { 
                echo "Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a>"; 
            }else { 
                $usuario_nombre = $_SESSION['usuario_nombre']; 
                $usuario_clave = mysqli_real_escape_string($_POST["usuario_clave"]); 
                $usuario_clave = md5($usuario_clave); // encriptamos la nueva contraseña con md5 
                $sql = mysqli_query($conn,"UPDATE usuarios SET usuario_clave='".$usuario_clave."' WHERE usuario_nombre='".$usuario_nombre."'"); 
                if($sql) { 
                    echo "Contraseña cambiada correctamente."; 
                }else { 
                    echo "Error: No se pudo cambiar la contraseña. <a href='javascript:history.back();'>Reintentar</a>"; 
                } 
            } 
        }else { 
?> 
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post"> 
          <label>Nueva contrase&ntilde;a:</label><br /> 
            <input type="password" name="usuario_clave" maxlength="15" /><br /> 
            <label>Confirmar:</label><br /> 
            <input type="password" name="usuario_clave_conf" maxlength="15" /><br /> 
            <input type="submit" name="enviar" value="Enviar" /> 
</form> 
<?php 
        } 
    }else { 
        echo "Acceso denegado."; 
    } 
?>
</body>
</html>