<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Formulario de configuracion de los reactivos que se generaran en la mesa.
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
    include('../lib/config.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html" http-equiv="content-type"><title>Configurar Preguntas</title>

<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
</head><body>
<h1 style="text-align: left;">Configurar Preguntas</h1>
<br>
<div style="text-align: left;">
<form method="post" action="bienvenidopreg.php" target="_new" name="confpreg">Escoja de la lista el n&uacute;mero de la mesa que
corresponde.<br>
<?php
 require_once('../lib/config.php');
$consulta1=mysqli_query($conn,"Select * from mesas") or die("error en las tablas de las mesas ".mysqli_error($conn));
// genera la lista de las mesas
if($row=mysqli_fetch_array($consulta1))
{
	echo ("<select name='mesa'>");
	do {
		 echo("<option value='".$row['num_mesa']."'>");
		 echo($row['num_mesa']."</option>"); 
		}
		while($row=mysqli_fetch_array($consulta1));
	echo("</select>");
}	
	?>
<br>
Teclee el nivel de participantes que contestar&aacute;n en esta mesa<input maxlength="2" name="lvl" value="1"><br>
<br>
Seleccione las materias que se preguntar&aacute;n.<br>
<input name="fisica" type="checkbox" value="si">F&iacute;sica<br>
<input name="quimica" type="checkbox" value="si">Qu&iacute;mica
<br>
<input name="matematicas" type="checkbox" value="si">Matem&aacute;ticas<br>
<br>
<input name="configurar" value="Aceptar configuración" type="submit"></form>
</div>
<?php mysqli_close($conn); ?>
</body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>