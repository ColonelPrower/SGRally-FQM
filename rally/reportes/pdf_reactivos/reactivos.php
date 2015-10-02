<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<?php session_start();
    include('../../lib/config.php'); // incluímos los datos de acceso a la BD(este exclusivo para pruebas del reporte)
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>
  
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Lista de Reactivos</title>

</head><body>
<?php $consulta=mysqli_query($conn,"Select * from reactivos order by folio asc");
?>
<h1 style="text-align: center; font-family: Helvetica,Arial,sans-serif;">Lista de Reactivos</h1>

<table style="text-align: left; width: 100%; font-family: Helvetica,Arial,sans-serif;" border="1" cellpadding="1" cellspacing="1">

  <tbody>
    <tr>
      <td style="font-weight: bold;">Folio</td>
      <td style="font-weight: bold;">Descripci&oacute;n</td>
      <td style="font-weight: bold;">Opci&oacute;n A</td>
      <td style="font-weight: bold;">Opci&oacute;n B</td>
      <td style="font-weight: bold;">Opci&oacute;n C</td>
      <td style="font-weight: bold;">Respuesta</td>
      <td style="font-weight: bold;">Nivel</td>
      <td style="font-weight: bold;">Materia</td>
    </tr>
<?php while($fila=mysqli_fetch_array($consulta)){
	echo("<tr>");
	echo("<td>".$fila['folio']."</td>");
	echo("<td>".$fila['descripcion']);
	if(file_exists("../../images/reactivos/".$fila['foto_desc'])){
		
	echo("<br><a href='../../images/reactivos/".$fila['foto_desc']."' target=_blank><img src='../../images/reactivos/".$fila['foto_desc']."'></a>"."</td>");
	}
	else{
		
		echo("</td>");
	}
	echo("<td>".$fila['opca']);
	if(file_exists("../../images/reactivos/".$fila['fotoa'])){
		
	echo("<br><a href='../../images/reactivos/".$fila['fotoa']."' target=_blank><img WIDTH=80% HEIGHT=80% src='../../images/reactivos/".$fila['fotoa']."'></a>"."</td>");
	}
	else{
		
		echo("</td>");
	}
	echo("<td>".$fila['opcb']);
	if(file_exists("../../images/reactivos/".$fila['fotob'])){
		
	echo("<br><a href='../../images/reactivos/".$fila['fotob']."' target=_blank><img WIDTH=80% HEIGHT=80% src='../../images/reactivos/".$fila['fotob']."'></a>"."</td>");
	}
	else{
		
		echo("</td>");
	}
	echo("<td>".$fila['opcc']);
	if(file_exists("../../images/reactivos/".$fila['fotoc'])){
		
	echo("<br><a href='../../images/reactivos/".$fila['fotoc']."' target=_blank><img WIDTH=80% HEIGHT=80% src='../../images/reactivos/".$fila['fotoc']."'></a>"."</td>");
	}
	else{
		
		echo("</td>");
	}
	echo("<td>".$fila['respuesta']."</td>");
	echo("<td>".$fila['nivel']."</td>");
	echo("<td>".$fila['materia']."</td>");
	echo("</tr>");
}
?>
  </tbody>
</table>

<?php mysqli_close($conn); ?><?php }else {
        echo "Sin autorizacion!!";
    }
?>
</body></html>