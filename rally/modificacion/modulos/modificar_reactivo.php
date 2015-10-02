<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de modificacion de reactivos
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
	<html>
	<head>
		<title>Modificar Reactivo</title>
    <link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<center>
		<?php
		require_once('../../lib/config.php');

 		$fol=$_POST['fol'];
		$res=mysqli_query($conn,"select *from reactivos where folio='$fol'");
                $tiempo=mysqli_query($conn,"select * from tiemposreact where id_preg='$fol'");
		$hora=mysqli_fetch_array($tiempo);
		if ($row = mysqli_fetch_array($res))
		{
			?>
			<form action="modificacion.php" method="post" enctype="multipart/form-data >
  			<p align="center">Modificar Reactivo </p>
  			<p align="center"> Folio: <?php echo $row['folio'] ?>
  			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
				<P align="center">Descripci&oacute;n:
       		<textarea name="des" cols="40" id="des" ><?php echo $row['descripcion'] ?> </textarea>
			<table width='160px' height='120px' border="0" >
				<?php echo "<td>";
			
				if(file_exists("../../images/reactivos/".$row['foto_desc'])){
				echo("<img style='width: 150px; height: 150px;' src='../../images/reactivos/".$row['foto_desc']."'>");
				}
				else{
					echo("<img style='width: 150px; height: 150px;' src='../../images/reactivos/default.png'>");
				}
				echo("</td>");
					?>			</table>
			<P align="center">Opci&oacute;n A :
       	  	<textarea name="opca" cols="40" id="opca"><?php echo $row['opca'] ?> </textarea>
			<table width='150px' height='120px' border="0" >
	 		<?php echo "<td>";
			
				if(file_exists("../../images/reactivos/".$row['fotoa'])){
				echo("<img style='width: 150px; height: 150px;' src='../../images/reactivos/".$row['fotoa']."'>");
				}
				else{
					echo("<img style='width: 150px; height: 150px;' src='../../images/reactivos/default.png'>");
				}
				echo("</td>");
					?>
			
			</table>
			<P align="center">Opci&oacute;n B :
       	  	<textarea name="opcb" cols="40" id="opcb"><?php echo $row['opcb'] ?> </textarea>
			<table width='150px' height='120px' border="0" >
			<?php echo "<td>";
			
				if(file_exists("../../images/reactivos/".$row['fotob'])){
				echo("<img style='width: 150px; height: 150px;' src='../../images/reactivos/".$row['fotob']."'>");
				}
				else{
					echo("<img style='width: 150px; height: 150px;' src='../../images/reactivos/default.png'>");
				}
				echo("</td>");
		    ?>			
			</table>
			<P align="center">Opci&oacute;n C :
       	  	<textarea name="opcc" cols="40" id="opcc"><?php echo $row['opcc'] ?> </textarea>
			<table width='150px' height='120px' border="0" >
			<?php echo "<td>";
			
				if(file_exists("../../images/reactivos/".$row['fotoc'])){
				echo("<img style='width: 150px; height: 150px;' src='../../images/reactivos/".$row['fotoc']."'>");
				}
				else{
					echo("<img style='width: 150px; height: 150px;' src='../../images/reactivos/default.png'>");
				}
				echo("</td>");
					?>			</table>
  			<p align="center">Nivel:
      		<input name="lvl" type="text" id="lvl" value="<?php echo $row['nivel'] ?>" size="5" maxlength="5" />
   			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Respuesta:
				<select name="res">
				<option selected="selected" value="<?php echo $row['respuesta']?>"><?php echo $row['respuesta']?></option>	
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="C">C</o	ption>
				</select>
	   		&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Materia: 
				<select name="mat">
				<option selected="selected" value="<?php echo $row['materia']?>"><?php echo $row['materia']?></option>	
				<option value="matematicas">matematicas</option>
				<option value="quimica">quimica</option>
				<option value="fisica">fisica</option>
				</select>
  			<p align="center">Foto Descipci&oacute;n:
    		<input type="file" name="fotodes" />
			<p align="center">Foto Opci&oacute;n A:
    		<input type="file" name="fotoa"  />
			<p align="center">Foto Opci&oacute;n B:
    		<input type="file" name="fotob"  />
			<p align="center">Foto Opci&oacute;n C:
    		<input type="file" name="fotoc"  />
                <p align="center">Tiempo:
		<input name="minutos" type="text" value="<?php echo $hora['minutos']?>"  size="3" maxlength="2" />
		:
		<input name="segundos" type="text" value="<?php echo $hora['segundos']?>"  size="3" maxlength="2" /></p>
		
  			<p align="center"> 
  
    		<input name="fol" type="hidden" id="fol" value="<?php echo  $row['folio'] ?>" />
    		<input name="capturar" type="submit" id="capturar" value="Capturar" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</form>

			<?php
		} 
		else 
		{
			echo "<p>No existe el reactivo</p>";
		}
		?>
	<?php mysqli_close($conn); ?></body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>