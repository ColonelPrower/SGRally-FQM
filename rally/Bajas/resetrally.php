<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script para la reinicializacion del rally y solucion de problemas de base de datos.
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
         $user=$_SESSION['usuario_id'];
      $sacaidadmin=mysqli_query($conn,"Select id from admins where id='$user'");
        if (mysqli_num_rows($sacaidadmin)==0)
	{
	print("No tiene privilegios de Administrador")and die();
        }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>REINICIAR RALLY</title>

<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1 align="center">Reiniciar Rally</h1>
Reiniciar el rally reestablece los n&uacute;meros de equipo, los
participantes, los resultados y los datos de las mesas, esta
opci&oacute;n borrar&aacute; todo el contenido de la base de datos de los
componentes seleccionados; y no
podr&aacute; ser recuperado autom&aacute;ticamente, use esta opci&oacute;n si experimenta
problemas o el n&uacute;mero de los equipos llega a 99 o m&aacute;s, se recomienda
hacer reportes PDF. <br>
<br>
<div style="text-align: center;">
<form method="post" action="./modulos/backuprally.php" name="truncar">
    <input name="borrapreg" type="checkbox">Borrar los Reactivos<br>
    <input name="borraequipos" type="checkbox">Borrarlos Equipos<br>
    <input name="borraparti" type="checkbox">Borrar los Participantes<br>
    <input name="borramesas" type="checkbox">Borrar las Mesas<br>
    <input name="borrarespuestas" type="checkbox">Borrar las Respuestas<br>
    <input name="borraranking" type="checkbox">Borrar el Ranking<br>
    <input name="borrahistorial" type="checkbox">Borrar el historial guardado<br>
    <input value="REINICIAR LOS ELEMENTOS SELECCIONADOS" type="submit"><br>
    
</form>
</div>
</body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>