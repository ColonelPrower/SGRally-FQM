<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de confirmacion para la eliminacion de un reactivo en la base de datos
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
		<title>Eliminar Reactivo</title>
		<link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<center>
		<?php
		require_once("../../lib/config.php");

 		$fol=$_POST['fol'];
		$res=mysqli_query($conn,"select *from reactivos where folio='$fol'");
		$tiempo=mysqli_query($conn,"select * from tiemposreact where id_preg='$fol'");
		$hora=mysqli_fetch_array($tiempo);
		
		if ($row = mysqli_fetch_array($res))
		{
				//generamos rutas de imagenes de default
				$rutadesc="../../images/reactivos/".$row['foto_desc'];
				$rutaopca="../../images/reactivos/".$row['fotoa'];
				$rutaopcb="../../images/reactivos/".$row['fotob'];
				$rutaopcc="../../images/reactivos/".$row['fotoc'];
				//si  existen los archivos cambia a imagen original
				if(!file_exists($rutadesc)){
				//echo("existe foto");
					$rutadesc="../../images/reactivos/default.gif";
				}
				if(!file_exists($rutaopca)){
				//echo("existe foto a");
					$rutaopca="../../images/reactivos/default.gif";

				}		
				if(!file_exists($rutaopcb)){
				//echo("existe foto b");
				$rutaopcb="../../images/reactivos/default.gif";
				}
				if(!file_exists($rutaopcc)){
				$rutaopcc="../../images/reactivos/default.gif";
				}
		?>

		<form action="eliminacion.php" method="post" enctype="multipart/form-data">
  		<p align="center"><h1>Eliminar Reactivo</h1></p>
  		<p align="center"> Folio: <?php echo $row['folio'] ?>
  		&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
  		<P align="center">Descripci&oacute;n:
       	<textarea name="des" cols="40" id="des" disabled><?php echo $row['descripcion'] ?> </textarea>
		<table width='150px' height='120px' border="0" >
	 	<?php echo "<td><img src='$rutadesc' width='150px' height='120px'/> </td>";?>
		</table>
		<P align="center">Opci&oacute;n A :
       	<textarea name="opca" cols="40" id="opca" disabled><?php echo $row['opca'] ?> </textarea>
		<table width='150px' height='120px' border="0" >
	 	<?php echo "<td><img src='$rutaopca' width='150px' height='150px'/> </td>";?>
		</table>
		<P align="center">Opci&oacute;n B :
       	<textarea name="opcb" cols="40" id="opcb" disabled><?php echo $row['opcb'] ?> </textarea>
		<table width='150px' height='120px' border="0" >
	 	<?php echo "<td><img src='$rutaopcb' width='150px' height='150px'/> </td>";?>
		</table>
		<P align="center">Opci&oacute;n C :
       	<textarea name="opcc" cols="40" id="opcc" disabled><?php echo $row['opcc'] ?> </textarea>
		<table width='150px' height='120px' border="0" >
	 	<?php echo "<td><img src='$rutaopcc' width='150px' height='150px'/> </td>";?>
		</table>
		<p align="center">Nivel:
      	<input name="lvl" type="text" id="lvl" value="<?php echo $row['nivel'] ?>" disabled size="5" maxlength="5" />
   		&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Respuesta: 
       	<input name="res" type="text" id="res" value="<?php echo $row['respuesta'] ?>" disabled size="5" 	maxlength="5" />
	   	&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Materia: 
       	<input name="mat" type="text" id="mat" value="<?php echo $row['materia'] ?>" disabled size="5" 	maxlength="5" />
    	</p>
		<p align="center">Tiempo:
		<input name="minutos" type="text" value="<?php echo $hora['minutos']?>" disabled size="3" maxlength="2" />
		:
		<input name="segundos" type="text" value="<?php echo $hora['segundos']?>" disabled size="3" maxlength="2" /></p>
		<p align="center">
  		<input name="Eliminar" type="submit" id="eliminar" value="Eliminar" />
  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   		<input name="fol" type="hidden" id="fol" value="<?php echo  $row['folio'] ?>" />
		<input name="foto_desc" type="hidden" id="foto_desc" value="<?php echo $row['foto_desc'] ?>" />
		<input name="fotoa" type="hidden" id="fotoa" value="<?php echo $row['fotoa'] ?>" />
		<input name="fotob" type="hidden" id="fotob" value="<?php echo $row['fotob'] ?>" />
		<input name="fotoc" type="hidden" id="fotoc" value="<?php echo $row['fotoc'] ?>" />
  	  	</form>
		<?php
		} 
		else 
		{
			echo "<p>No existe el reactivo</p>";
		}
		mysqli_close($conn);
		?>
	</body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>