<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Pantalla de modificacion de un equipo
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
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Modificar Equipo</title>

<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once('../../lib/config.php');
$num=$_POST['numeq'];
$consulta=mysqli_query($conn,"Select * from equipos where num_equipo='$num'");
if (mysqli_num_rows($consulta)==0)
{
print("No existe el Equipo")and die();
}
$participantes=mysqli_query($conn,"select * from participantes where num_equipo='$num'");
$datoseq=mysqli_fetch_array($consulta);
$nomequipo=$datoseq['nombre'];
// echo("numerode".$num."equipo");
$nivequipo=$datoseq['nivel'];
$caleq=$datoseq['calendario'];
$foto=$datoseq['foto'];
$representante=$datoseq['representante'];
$sacarepre=mysqli_query($conn,"select nombre from participantes where codigo='$representante'");
$sacarep=mysqli_fetch_array($sacarepre);

?>
<h1 style="text-align: center;">Modificar el
equipo</h1>
<h1 style="text-align: center;"><?php echo $nomequipo ;?></h1>
<form method="post" action="modequip.php" name="modeq" enctype="multipart/form-data">
<table style="width: 434px; height: 190px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td>Nombre del equipo</td>
<td><input maxlength="50" size="51" name="nomeq" value="<?php echo($nomequipo) ?>"></td>
</tr>
<tr>
<td>Nivel</td>
<td><input maxlength="1" size="2" name="niveq" value="<?php echo($nivequipo) ?>"></td>
</tr>
<tr>
<td>Representante</td>
<td>
	<select name="miembros">
		<option value="<?php echo($representante)?>"><?php	echo ($sacarep['nombre'])?> - actual</option>
		<?php 
		while($miembros=mysqli_fetch_array($participantes)){
			echo("<option value='".$miembros['codigo']."'>".$miembros['nombre']."</option>");
		}
		?>
	</select>
</td>
</tr>
<tr>
<td>Calendario</td>
<td><input maxlength="5" size="6" name="calen" value="<?php echo($caleq) ?>"></td>
</tr>
<tr>
<td>Foto</td>
<td><?php 
// echo($foto."la fotito");
if(file_exists("../../images/equipos/".$foto)){
echo("<img style='width: 120px; height: 120px;' src='../../images/equipos/".$foto."'>");
}
else{
echo("<img style='width: 120px; height: 120px;' src='../../images/equipos/default.jpg'>");
}
?> <br>
<input type="file" name="fotoeq"  /></td>
</tr>
</tbody>
</table>
<div style="text-align: center;">
<input name="env" value="modificar" type="submit"><input name="num_equipo" value="<?php echo($num); ?>" type="hidden">
<input name="fotoarchivo" value="<?php echo((string)$foto)?>" type="hidden">
<br>
</div>
</form>
<h2 style="text-align: center;">Agregar otro participante
al equipo</h2>
<form method="post" action="addparti.php" name="agregarparti" enctype="multipart/form-data">
<table style="width: 200px; text-align: left; margin-left: auto; margin-right: auto;" border="0">
<tbody>
<tr>
<td>C&oacute;digo</td>
<td><input name="cod" id="cod" size="10" maxlength="9" type="text"></td>
</tr>
<tr>
<td>Nombre</td>
<td><input name="nombre" id="nombre" size="52" maxlength="50" type="text"></td>
</tr>
<tr>
<td>Tel&eacute;fono</td>
<td><input name="tel" id="tel" size="15" maxlength="15" type="text"></td>
</tr>
<tr>
<td>Carrera</td>
<td><input name="carr" id="carr" size="16" maxlength="15" type="text"></td>
</tr>
<tr>
<td>Semestre</td>
<td><input name="sem" id="sem" size="12" maxlength="10" type="text"></td>
</tr>
<tr>
<td>Foto <h6>*obligatorio</h6></td>
<td><input name="fotopar" id="fotopar" type="file"> </td>
</tr>
</tbody>
</table>
<p style="text-align: center;"> <input name="num_equipo" value="<?php echo($num); ?> " type="hidden"> <input name="enviar" id="enviar" value="Agregar" type="submit">&nbsp; </p>
</form>
<?php mysqli_close($conn); ?></body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>