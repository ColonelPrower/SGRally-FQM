<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de confirmacion para la eliminacion de la base de datos de un equipo.
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
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Confirmar Borrado</title>
    <link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">

</head>
<body>
<h1 align="center">¿Desea borrar este equipo con todos sus
integrantes?</h1>
<br>
<?php require_once('../../lib/config.php');
$numequipo=$_POST['borrareq'];
$consulta=mysqli_query($conn,"select * from equipos where num_equipo=$numequipo") or die ("el equipo no existe".mysqli_error($conn));

if (mysqli_num_rows($consulta)==0)
{
print("No existe el Equipo")and die();
}

$campo=mysqli_fetch_array($consulta);
$consultados=mysqli_query($conn,"select nombre,codigo from participantes where num_equipo=$numequipo");
$campodos=mysqli_fetch_array($consultados);
$lider=$campo['representante'];
$sacarep=mysqli_query($conn,"select nombre from participantes where codigo='$lider'");
$repre=mysqli_fetch_array($sacarep);
?>
<br>
<br>
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td><b>numero del equipo</b></td>
<td><b>Nombre</b></td>
<td><b>Nivel</b></td>
<td><b>Representante</b></td>
<td><b>Fecha de Registro</b></td>
<td><b>Hora de Registro</b></td>
<td><b>Calendario</b></td>
<td><b>Foto</b></td>
</tr>
<?php echo(
"<tr>"
."<td>".$campo['num_equipo']."</td>"
."<td>".$campo['nombre']."</td>"
."<td>".$campo['nivel']."</td>"
."<td>".$repre['nombre']."</td>"
."<td>".$campo['fecha_reg']."</td>"
."<td>".$campo['hora_reg']."</td>"
."<td>".$campo['calendario']."</td>");
echo("<td>");
if(file_exists("../../images/equipos/".$campo['foto'])){
					echo("<img style='width: 250px; height: 250px;' src='../../images/equipos/".$campo['foto']."'>");
				}
				else{
						echo("<img style='width: 250px; height: 250px;' src='../../images/equipos/default.jpg'>");
				}
				echo("</td>");
				echo("</tr>");
?>
</tbody>
</table>
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td><b>Participante</b></td>
<td><b>Codigo</b></td>
</tr>
<?php do{
echo ("<tr>");
echo ("<td>".$campodos['nombre']."</td>");
echo ("<td>".$campodos['codigo']."</td>");
echo ("</tr>");
}
while($campodos= mysqli_fetch_array($consultados));
?>
</tbody>
</table>
<br>
<div style="text-align: center;">
<form method="post" action="equipoeliminado.php" name="borrar">
<input value="<?php echo($numequipo)?>" name="noequipo" type="hidden">
<input value="Borrar" align="center" type="submit"></form>
</div>
<?php mysqli_close($conn); ?>
</body></html><?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>