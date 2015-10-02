<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de Recuperacion de contraseña Requiere funcion mail() de PHP 
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
<title>Recuperar contraseña</title>
</head>

<body>

<?php 
    include('../lib/config.php'); // incluímos los datos de acceso a la BD 
    if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos del formulario 
        if(empty($_POST['usuario_nombre'])) { 
            echo "No ha ingresado el usuario. <a href='javascript:history.back();'>Reintentar</a>"; 
        }else { 
            $usuario_nombre = mysqli_real_escape_string($_POST['usuario_nombre']); 
            $usuario_nombre = trim($usuario_nombre); 
            $sql = mysqli_query($conn,"SELECT usuario_nombre, usuario_clave, usuario_email FROM usuarios WHERE usuario_nombre='".$usuario_nombre."'"); 
            if(mysqli_num_rows($sql)) { 
                $row = mysqli_fetch_assoc($sql); 
                $num_caracteres = "10"; // asignamos el número de caracteres que va a tener la nueva contraseña 
                $nueva_clave = substr(md5(rand()),0,$num_caracteres); // generamos una nueva contraseña de forma aleatoria 
                $usuario_nombre = $row['usuario_nombre']; 
                $usuario_clave = $nueva_clave; // la nueva contraseña que se enviará por correo al usuario 
                $usuario_clave2 = md5($usuario_clave); // encriptamos la nueva contraseña para guardarla en la BD 
                $usuario_email = $row['usuario_email']; 
                // actualizamos los datos (contraseña) del usuario que solicitó su contraseña 
                mysqli_query($conn,"UPDATE usuarios SET usuario_clave='".$usuario_clave2."' WHERE usuario_nombre='".$usuario_nombre."'"); 
                // Enviamos por email la nueva contraseña 
                $remite_nombre = "Sistema de Gestion del rally"; // Tu nombre o el de tu página 
                $remite_email = $correo; // tu correo 
                $asunto = "Recuperación de contraseña"; // Asunto (se puede cambiar) 
                $mensaje = "Se ha generado una nueva contraseña para el usuario <strong>".$usuario_nombre."</strong>. La nueva contraseña es: <strong>".$usuario_clave."</strong>."; 
                $cabeceras = "From: ".$remite_nombre." <".$remite_email.">rn"; 
                $cabeceras = $cabeceras."Mime-Version: 1.0n"; 
                $cabeceras = $cabeceras."Content-Type: text/html"; 
                $enviar_email = mail($usuario_email,$asunto,$mensaje,$cabeceras); 
                if($enviar_email) { 
                    echo "La nueva contraseña ha sido enviada al email asociado al usuario ".$usuario_nombre."."; 
                }else { 
                    echo "No se ha podido enviar el email. <a href='javascript:history.back();'>Reintentar</a>"; 
                } 
            }else { 
                echo "El usuario <strong>".$usuario_nombre."</strong> no está registrado. <a href='javascript:history.back();'>Reintentar</a>"; 
            } 
        } 
    }else { 
	
?> 
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"> 
        <label>Usuario:</label><br /> 
        <input type="text" name="usuario_nombre" /><br /> 
        <input type="submit" name="enviar" value="Enviar" /> 
    </form> 
<?php 

    } 
?>

</body>
</html>