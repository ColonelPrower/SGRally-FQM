<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><?php session_start();
    include('../lib/config.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
      $user=$_SESSION['usuario_id'];
      $sacaidadmin=mysqli_query($conn,"Select id from admins where id='$user'");
      if (mysqli_num_rows($sacaidadmin)==0)
	{
	print("No tiene privilegios de Administrador")and die();
        }
?>


<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">


  
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Gestion de usuarios</title></head><body>
<h1>Gesti&oacute;n de Usuarios</h1><a href="../login/registro.php">

Nuevo usuario</a><br>

<br>

Eliminar usuario<br>
<?php $consultausers=mysqli_query($conn,"Select usuario_id, usuario_nombre from usuarios");?>
<form enctype="multipart/form-data" method="post" action="borrauser.php" name="borrauser">
  <select name="usuarios">
  <option selected="selected" value="ninguno">elige un usuario</option>
      <?php while($sacauser=mysqli_fetch_array($consultausers)){
        echo("<option value='".$sacauser['usuario_id']."'>".$sacauser['usuario_nombre']."</option>");
        }?>

  
  </select>
  <br>
  <input name="Borrar" value="Borrar usuario" type="submit"><br>
</form>

<br>

Otorgar o Revocar permisos de Administrador<br>
<?php $consultausers=mysqli_query($conn,"Select usuario_id, usuario_nombre from usuarios");?>
<form enctype="multipart/form-data" method="post" action="controladmin.php" name="adminquitaopone">
<select name="usuarios">
<option selected="selected" value="ninguno">elige un usuario</option>
<?php while($sacauser=mysqli_fetch_array($consultausers)){
        echo("<option value='".$sacauser['usuario_id']."'>".$sacauser['usuario_nombre']."</option>");
        }?>
</select><br>
  <input name="permiso" value="concedido" type="radio">condeder <input name="permiso" value="revocado" type="radio">revocar<br>
  <input name="aceptar" value="Ok" type="submit"><br>
</form>

<h3>Administradores actuales</h3><br>
<?php $consultarad=mysqli_query($conn,"Select nombre from admins order by nombre asc");?>

<table style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td>
      <h3>Nombre de usuario
      </h3>
      </td>
    </tr>
     <?php while($sacarad=mysqli_fetch_array($consultarad)){
    echo("<tr>");
     echo("<td>".$sacarad['nombre']);
      echo("</td>");
    echo("</tr>");
     }?>
  </tbody>
</table>
<br>
<h3><br>
</h3>
<h3>Registro reciente de Actividades de Usuarios<br>
</h3>

<br>
<table style="text-align: left; width: 983px; height: 86px;" border="1" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td style="font-weight: bold;">
      <h3>Id</h3>
      </td>
      <td style="font-weight: bold;">
      <h3>Evento</h3>
      </td>
      <td style="font-weight: bold;">
      <h3>Fecha y hora</h3>
      </td>
    </tr>
    <?php $consultalog=mysqli_query($conn,"Select id, evento, fecha from log order by fecha desc limit 0, 50");?>
    <?php while($sacalog=mysqli_fetch_array($consultalog)){
        
    echo("<tr>");
      echo("<td>".$sacalog['id']);
      echo("</td>");
      echo("<td>".$sacalog['evento']);
      echo("</td>");
      echo("<td>".$sacalog['fecha']);
      echo("</td>");
      echo("</tr>");
      
        }?>
  </tbody>
</table>

<?php }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?></body></html>