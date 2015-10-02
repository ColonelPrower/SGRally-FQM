<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de modificacion de participantes
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
    along with this program.  If not, see <http://www.gnu.org/licenses/>. --><?php
    session_start();
    include('../../lib/config.php'); // inclu�mos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesi�n
    if(isset($_SESSION['usuario_nombre'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html;"><title>Modificar Participante</title>
<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once('../../lib/config.php');
		$codigo=$_POST['codigo'];
		$consulta=mysqli_query($conn,"Select * from participantes where codigo=$codigo") or die ("error al consultar el participante".mysqli_error($conn));
		if (mysqli_num_rows($consulta)==0)
		{
			print("No existe el Equipo")and die();
		}
		$parti=mysqli_fetch_array($consulta);
		
		
?>





<h1 style="text-align: center;">Modificando a&nbsp;</h1>
<h1 style="text-align: center;"><?php echo($parti['nombre']) ?></h1>
<form enctype="multipart/form-data" method="post" action="./modparti.php" name="modpart">
<table style="width: 100px; text-align: left; margin-left: auto; margin-right: auto;" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td>C&oacute;digo</td>
<td><input disabled="disabled" value="<?php echo($parti['codigo']) ?>" maxlength="9" size="10" name="cod"></td>
</tr>
<tr>
<td>Nombre</td>
<td><input maxlength="50" size="30" name="nom" value="<?php echo($parti['nombre']) ?>"></td>
</tr>
<tr>
<td>Tel&eacute;fono</td>
<td><input maxlength="15" size="16" name="tel" value="<?php echo($parti['telefono']) ?>"></td>
</tr>
<tr>
<td>N&uacute;mero de equipo</td>
<td><input maxlength="2" size="3" name="num" value="<?php echo($parti['num_equipo'])?>"></td>
</tr>
<tr>
<td>Carrera</td>
<td><input maxlength="15" size="16" name="car" value="<?php echo($parti['carrera']) ?>"></td>
</tr>
<tr>
<td>Semestre</td>
<td><input maxlength="10" size="11" name="sem" value="<?php echo($parti ['semestre']) ?>"></td>
</tr>
<tr>
<td>Foto</td>
<td><img style="border: 0px solid ; width: 120px; height: 120px;" alt="" src="../../images/participantes/<?php echo($parti['foto'])?>"><br>
<input name="foto" type="file"></td>
</tr>
</tbody>
</table>
<input name="nombrefoto" value="<?php echo($parti['foto'])?>" type="hidden">
<input name="code" value="<?php echo($parti['codigo']) ?>" type="hidden">
<div style="text-align: center;"><input name="enviarmod" value="Modificar" type="submit"><br>
</div>
</form>
<?php mysqli_close($conn); ?></body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>