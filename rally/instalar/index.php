<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de instalacion del Sistema. (Respaldo) se recomienda quitarlo de este lugar para reforzar seguridad
	SOLO PARA PROBLEMAS CON INGRESO AL SISTEMA.
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
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Registro</title>

  
</head><body>
<h1 style="text-align: center;">
Configuracion inicial del Sistema Gestor del Rally</h1>
<div style="text-align: center;">Para&nbsp; poder utilizar el sistema
de administracion del Rally de conocimientos de F&iacute;sica , Qu&iacute;mica y Matem&aacute;ticas es nesesario crear un usuario Administrador, este
podr&aacute; crear y eliminar usuarios registrados normales ademas puede
asignar mas administradores<?php include('../lib/config.php'); // incluimos el archivo de conexión a la Base de Datos 
    if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos desde el formulario 
        // creamos una función que nos parmita validar el email 
        function valida_email($correo) { 
            if (preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $correo)) return true; 
            else return false; 
        } 
        // Procedemos a comprobar que los campos del formulario no estén vacíos 
        $sin_espacios = count_chars($_POST['usuario_nombre'], 1); 
        if(!empty($sin_espacios[32])) { // comprobamos que el campo usuario_nombre no tenga espacios en blanco 
            echo "El campo <em>usuario_nombre</em> no debe contener espacios en blanco. <a href='javascript:history.back();'>Reintentar</a>"; 
        }elseif(empty($_POST['usuario_nombre'])) { // comprobamos que el campo usuario_nombre no esté vacío 
            echo "No haz ingresado tu usuario. <a href='javascript:history.back();'>Reintentar</a>"; 
        }elseif(empty($_POST['usuario_clave'])) { // comprobamos que el campo usuario_clave no esté vacío 
            echo "No haz ingresado contraseña. <a href='javascript:history.back();'>Reintentar</a>"; 
        }elseif($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) { // comprobamos que las contraseñas ingresadas coincidan 
            echo "Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a>"; 
        }elseif(!valida_email($_POST['usuario_email'])) { // validamos que el email ingresado sea correcto 
            echo "El email ingresado no es válido. <a href='javascript:history.back();'>Reintentar</a>"; 
        }else { 
            // "limpiamos" los campos del formulario de posibles códigos maliciosos 
            $usuario_nombre = mysqli_real_escape_string($conn, $_POST['usuario_nombre']); 
            $usuario_clave = mysqli_real_escape_string($conn, $_POST['usuario_clave']); 
            $usuario_email = mysqli_real_escape_string($conn, $_POST['usuario_email']); 
            // comprobamos que el usuario ingresado no haya sido registrado antes 
            $sql = mysqli_query($conn,"SELECT usuario_nombre FROM usuarios WHERE usuario_nombre='".$usuario_nombre."'"); 
            if(mysqli_num_rows($sql) > 0) { 
                echo "El nombre usuario elegido ya ha sido registrado anteriormente. <a href='javascript:history.back();'>Reintentar</a>"; 
            }else { 
                $usuario_clave = md5($usuario_clave); // encriptamos la contraseña ingresada con md5 
                // ingresamos los datos a la BD 
                $reg = mysqli_query($conn,"INSERT INTO usuarios (usuario_nombre, usuario_clave, usuario_email, usuario_freg) VALUES ('".$usuario_nombre."', '".$usuario_clave."', '".$usuario_email."', NOW())"); 
		$ides= mysqli_query($conn,"select max(usuario_id) as id from usuarios");//sacamos el id del usuario ingresado para convertirlo en administrador
		$sacaid=mysqli_fetch_array($ides);
                if($reg) { 
					$adm= mysqli_query($conn,"insert into admins (id,nombre) values ('".$sacaid['id']."', '".$usuario_nombre."')");
                    echo "Datos ingresados correctamente <a href='borrar.php'> haga click aqui </a> para borrar los archivos de instalacion ."; 
		    
                }else { 
                    echo "ha ocurrido un error y no se registraron los datos."; 
                } 
            } 
        } 
    }else { 
?></div>

<div style="text-align: center;">
<form action="<?php echo($_SERVER['PHP_SELF'])?>" method="post"> <label>Usuario:</label><br />
  <input name="usuario_nombre" maxlength="15" type="text" /><br />
  <label>Contrase&ntilde;a:</label><br />
  <input name="usuario_clave" maxlength="15" type="password" /><br />
  <label>Confirmar Contrase&ntilde;a:</label><br />
  <input name="usuario_clave_conf" maxlength="15" type="password" /><br />
  <label>Email:</label><br />
  <input name="usuario_email" maxlength="50" type="text" /><br />
  <input name="enviar" value="Registrar" type="submit" /> <input value="Borrar" type="reset" /> </form>
</div>

<?php } 
?>
</body></html>