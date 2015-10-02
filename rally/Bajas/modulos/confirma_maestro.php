<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de confirmacion para la eliminacion en la base de datos, de un profesor encargado
    Copyright (C) 2013  Alejandro Ramirez Reyes, Cesar Eduardo Mendoza Valencia
	
    Este programa es software libre: usted puede redistribuirlo y / o modificarlo
����bajo los t�rminos de la Licencia P�blica General GNU publicada por
����la Fundaci�n para el Software Libre, ya sea la versi�n 3 de la Licencia, o
����cualquier versi�n posterior.

����Este programa se distribuye con la esperanza de que sea �til,
����pero SIN NINGUNA GARANT�A, incluso sin la garant�a impl�cita de
����COMERCIALIZACI�N o IDONEIDAD PARA UN PROP�SITO PARTICULAR. Consulte la
����GNU General Public License para m�s detalles.

	Deber�a haber recibido una copia de la Licencia P�blica General de GNU
����junto con este programa. Si no es as�, consulte <http://www.gnu.org/licenses/>
	
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
    include('../../lib/config.php'); // inclu�mos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesi�n
    if(isset($_SESSION['usuario_nombre'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>confirmar profesor</title>
<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once('../../lib/config.php');
$codigo=(string)$_POST['codigo'];

$consulta=mysqli_query($conn,"select * from maestros where codigo='$codigo'");

if (mysqli_num_rows($consulta)==0)
{
print("No existe el maestro")and die();
}
$filas=mysqli_fetch_array($consulta);

?>
<h1 align="center">�Desea borrar este profesor?</h1>
<br>
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2"><tbody>
			<tr>
				<td style="font-weight: bold;">C&oacute;digo</td>
				<td style="font-weight: bold;">Nombre</td>
				<td style="font-weight: bold;">Tel&eacute;fono</td>
				<td style="font-weight: bold;">Materia</td>
				<td style="font-weight: bold;">Foto</td>
			</tr>
			
			<?php echo("<tr>"."<td>".$filas['codigo']."</td>");
				echo("<td>".$filas['nombre']."</td>");
				echo("<td>".$filas['telefono']."</td>");
				echo("<td>".$filas['materia']."</td>");
				echo("<td>");
				if(file_exists("../../images/maestros/".$filas['foto'])){
					echo("<img style='width: 250px; height: 250px;' src='../../images/maestros/".$filas['foto']."'>");
				}
				else{
						echo("<img style='width: 250px; height: 250px;' src='../../images/maestros/default.jpg'>");
				}
				echo("</td>");
				echo("</tr>");
			?>
			
		</tbody>
		</table><br>
		<div style="text-align: center;">
		<form method="post" action="maestro_eliminado.php">
		<input name="cod" value="<?php echo($filas['codigo']) ?>" type="hidden">
		<input name="fot" value="<?php echo($filas['foto']) ?>" type="hidden">
		<input value="Borrar" type="submit">
		</form></div>
<?php mysqli_close($conn); ?>
</body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>