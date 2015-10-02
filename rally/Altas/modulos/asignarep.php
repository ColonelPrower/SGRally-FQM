<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Formulario para agregar un representante al equipo 
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
    include('../../lib/config.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Asignar Representante</title>
<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p>
  <?php
  require_once('../../lib/config.php');
$codigo=(string)$_POST['cod'];//se rellena con ceros por que el formulario recorta los codigos que empiezan con cero y tambien rellena los menores a 9 caracteres
$nombre=$_POST['nombre'];
$telefono=(string)$_POST['tel'];
$carrera=$_POST['carr'];
$semestre=$_POST['sem'];
$fotoparti=$_FILES['fotopar']['name'];
if ($_FILES["fotopar"]["type"] !== "image/jpeg" and $_FILES['fotopar']['name']!==''){
print ("la imagen debe ser .JPG o .JPEG ") and die(); 
}
$numequipo=$_POST['num_equipo'];

$nombrefoto=$codigo.".jpg";
move_uploaded_file($_FILES['fotopar']['tmp_name'], "../../images/participantes/".$nombrefoto ) or die (" no se ha podido Cargar la Imagen o no se eligio una");

mysqli_query($conn,"insert into participantes values('$codigo','$nombre','$telefono','$numequipo','$carrera','$semestre','$nombrefoto')") or die ("no se pudo insertar el participante ".mysqli_error($conn));
//echo("se agrego el participante")

?> 
  </p>
<p><a href="javascript:history.back(1)">Agregar otro participante</a></p>
<h1 align="center"> Elige un representante</h1>
<form action="equipocreado.php" method="post">
<?php //se obtienen los participantes actuales
$sacaparticipantes=mysqli_query($conn,"select * from participantes where num_equipo=$numequipo") or die("error al filtrar los participantes del equipo".mysqli_error($conn));
if($row=mysqli_fetch_array($sacaparticipantes))
{
	echo ("<select name='miembros'>");
	do {
		 echo("<option value='".$row['codigo']."'>");
		 echo($row['nombre']."</option>"); 
		}
		while($row=mysqli_fetch_array($sacaparticipantes));
	echo("</select>");

}

?>
<?php mysqli_close($conn); ?>
<input name="numeroequipo" type="hidden" value="<?php echo($numequipo)?>" />
<input name="enviar" type="submit" value="Asignar Representante" />
</form>



</body>

</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>