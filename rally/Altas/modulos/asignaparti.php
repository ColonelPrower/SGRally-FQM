<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Formulario para agregar participantes al equipo recien creado
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" /><title>Asignar Participantes</title>

<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php require_once('../../lib/config.php');
$nombre=$_POST['nom'];
$nivel= $_POST['lvl'];
$calen=$_POST['cal'];
$foto=$_FILES['fotoeq']['name'];
if ($_FILES["fotoeq"]["type"] !== "image/jpeg" and $_FILES['fotoeq']['name']!==''){
print("la imagen debe ser .JPG o .JPEG ") and die();
}
//Se saca el ultimo equipo registrado ignorando los que han sido borrados si hubiera
$sacacuenta=mysqli_query($conn,"select max(num_equipo) as cuenta from equipos");//max(num_equipo)
$cuenta=mysqli_fetch_array($sacacuenta);
$numcuenta=$cuenta['cuenta']+1;
//echo("$numcuenta");
$nombrefoto='sinfoto.jpg';//si no quiere poner foto
$hora=date("H:i:s");
$fecha=date("Y-m-d");
if($foto != ''){//si el usuario quiere poner foto
$nombrefoto=$calen."eq".$numcuenta.".jpg";//ej 2012Aeq2.jpg
move_uploaded_file($_FILES['fotoeq']['tmp_name'], "../../images/equipos/".$nombrefoto ) or die (" no se ha podido Cargar la Imagen ");
}
mysqli_query ($conn,"INSERT INTO equipos (nombre, nivel, fecha_reg, foto, calendario, hora_reg) values ('$nombre','$nivel','$fecha','$nombrefoto','$calen','$hora')") or die("error al insertar el equipo ".mysqli_error($conn));
mysqli_close($conn);
?>
<h1 align="center"> Agregar participantes del equipo</h1>
<p align="center"></p><form action="asignarep.php" method="post" enctype="multipart/form-data">
<table border="0" width="200">
<tbody>
<tr>
<td>C&oacute;digo</td>
<td><input name="cod" id="cod" size="10" maxlength="9" type="text" /></td>
</tr>
<tr>
<td>Nombre</td>
<td><input name="nombre" id="nombre" size="52" maxlength="50" type="text" /></td>
</tr>
<tr>
<td>Tel&eacute;fono</td>
<td><input name="tel" id="tel" size="15" maxlength="15" type="text" /></td>
</tr>
<tr>
<td>Carrera</td>
<td><input name="carr" id="carr" size="16" maxlength="15" type="text" /></td>
</tr>
<tr>
<td>Semestre</td>
<td><input name="sem" id="sem" size="12" maxlength="10" type="text" /></td>
</tr>
<tr>
<td>Foto</td>
<td><input name="fotopar" id="fotopar" type="file" accept="image/jpeg, image/jpg"/> *obligatorio</td>
</tr>
</tbody>
</table>
<p> <input name="num_equipo" value="<?php echo($numcuenta); ?> " type="hidden" /> <input name="enviar" id="enviar" value="Enviar" type="submit" /> <input name="borrar" id="borrar" value="Borrar formulario" type="reset" /> </p>
</form>

</body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>