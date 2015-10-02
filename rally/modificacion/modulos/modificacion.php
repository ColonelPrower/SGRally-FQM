<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de modificacion de un reactivo
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
		<title>Modificar Reactivo</title>
    <link href="../../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<center>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<?php
		require_once('../../lib/config.php');
	
 		$fol=$_POST['fol'];
 		$des=$_POST['des'];
                $min=$_POST['minutos'];
                $seg=$_POST['segundos'];
		if(isset($_FILES['fotodes']['name'])){
		$fotodes=$_FILES['fotodes']['name'];
			if($_FILES['fotodes']['type']!=="image/jpeg"){
			die("la imagen de la descripcion debe ser jpg o jpeg");
			}
		}
		else{
			$fotodes='';
		}
		if(isset($_FILES['fotoa']['name'])){
 		$fotoopca=$_FILES['fotoa']['name'];
			if($_FILES['fotoa']['type']!=="image/jpeg"){
			die("la imagen de la opcionA debe ser jpg o jpeg");
			}
		}
		else{
			$fotoopca='';
		}
		if(isset($_FILES['fotob']['name'])){
				$fotoopcb=$_FILES['fotob']['name'];
				if($_FILES['fotob']['type']!=="image/jpeg"){
			die("la imagen de la opcion B debe ser jpg o jpeg");
			}
		}
		else{
			$fotoopcb='';
		}
		if(isset($_FILES['fotoc']['name'])){
			$fotoopcc=$_FILES['fotoc']['name'];
			if($_FILES['fotoc']['type']!=="image/jpeg"){
			die("la imagen de la opcion C debe ser jpg o jpeg");
			}
		}
		else{
			$fotoopcc='';
		}
		$opca=$_POST['opca'];
		$opcb=$_POST['opcb'];
		$opcc=$_POST['opcc'];
		
		
 		$lvl=$_POST['lvl'];
		$res=$_POST['res'];
		$mat=$_POST['mat'];
 		
			$nombrefotodes=$fol."des.jpg";
			$nombrefotoa=$fol."opca.jpg";
			$nombrefotob=$fol."opcb.jpg";
			$nombrefotoc=$fol."opcc.jpg";
			
		if($fotodes!='')
		{
			move_uploaded_file($_FILES['fotodes']['tmp_name'], "../../images/reactivos/".$nombrefotodes ) or die (" no se ha podido Cargar la Imagen ");
		}
		if($fotoopca!='')
		{
			move_uploaded_file($_FILES['fotoa']['tmp_name'], "../../images/reactivos/".$nombrefotoa ) or die (" no se ha podido Cargar la Imagen ");
		}
		if($fotoopcb!='')
		{
			move_uploaded_file($_FILES['fotob']['tmp_name'], "../../images/reactivos/".$nombrefotob ) or die (" no se ha podido Cargar la Imagen ");
		}
		if($fotoopcc!='')
		{
			move_uploaded_file($_FILES['fotoc']['tmp_name'], "../../images/reactivos/".$nombrefotoc ) or die (" no se ha podido Cargar la Imagen ");
		}
  
 		$registro=mysqli_query($conn,"select *from reactivos where folio='$fol'");
 		if($reg=mysqli_fetch_array($registro))
		{
			$reg=mysqli_query($conn,"update reactivos set descripcion='$des',foto_desc='$nombrefotodes',opca='$opca',opcb='$opcb',opcc='$opcc',fotoa='$nombrefotoa',fotob='$nombrefotob',fotoc='$nombrefotoc', respuesta ='$res',nivel='$lvl',materia='$mat' where folio='$fol'") or die("Error en la modificacion de datos".mysqli_error($conn));
                        $mod=mysqli_query($conn,"update tiemposreact set minutos='$min', segundos='$seg' where id_preg=$fol");
			echo "<p> El Reactivo ha sido modificado</p>";
			$resultado=$_SESSION['usuario_nombre']." modific&oacute el reactivo numero ".$fol;
			$usuario_id = $_SESSION['usuario_id'];
                    mysqli_query($conn,"insert into log (usuario, evento) values('$usuario_id','$resultado')") or die("error al escribir en el log".mysqli_error($conn));
	}
	else echo "Error";
 

		?>

		</center>
	<?php mysqli_close($conn); ?></body>
</html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>