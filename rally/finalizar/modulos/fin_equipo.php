<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de finalizacion del equipo.
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
<html>
	<head>
		<title>Fin de Recorrido</title>
    <link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>

	<body>
	<?php
		require_once('../../lib/config.php');
		$equipo=$_POST['equipo'];	
		//consulta para obtener la suma de la duracion de preguntas correctas e incorrectas
		$consultaduracion=mysqli_query($conn,"SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( duracion ) ) ) as duracion FROM resultados WHERE num_equipo='$equipo' ") or die ("Error en la consulta de la duracion ".mysqli_error($conn));
		//consulta para obtener el numero de aciertos
		$consultaaciertos=mysqli_query($conn,"SELECT  count(correcta) as aciertos FROM resultados WHERE correcta='SI' and num_equipo='$equipo' ".mysqli_error($conn));
		//obtener duracion
		$obtduracion=mysqli_fetch_array($consultaduracion);
		$duracion=$obtduracion['duracion'];
		//obtener aciertos
		$obtaciertos=mysqli_fetch_array($consultaaciertos);
		$aciertos=$obtaciertos['aciertos'];
		echo($aciertos." aciertos");
		
		
		//insertamos el registro
		mysqli_query($conn,"insert into ranking (num_equipo, duracion, aciertos) values('$equipo', '$duracion','$aciertos')") or die("no se pudo registrar el ranking del equipo".mysqli_error($conn));
		echo "<p> El equipo a finalizado</p>";
		$resultado=$_SESSION['usuario_nombre']." finalizo el equipo ".$equipo;
		$usuario_id = $_SESSION['usuario_id'];
                    mysqli_query($conn,"insert into log (usuario,evento) values('$usuario_id','$resultado')") or die("error al escribir en el log".mysqli_error($conn));
		?>
	</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>