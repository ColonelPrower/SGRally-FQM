<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script para mandar a la base de datos la respuesta del equipo.
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
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Pregunta contestada</title>
<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1 align="center"> Has contestado la pregunta <br>
continua a la siguiente mesa </h1>
<br>
<?php require_once('../lib/config.php');
//recibimos las materias para evitar que se borre la configuracion
$fis=$_POST['fisica'];
$quim=$_POST['quimica'];
$mates=$_POST['matematicas'];
//recibimos las demas variables del formulario
$folio=$_POST['folioform'];
$mesa=$_POST['mesa'];
$equipo=$_POST['equipo'];
$iniunix=$_POST['iniciounix'];
$nivel=$_POST['nivelp'];
$respuesta=$_POST['opciones'];
$respcorrecta=$_POST['resp'];
$correcta="";
//recibimos la variable del folio del resultado
$folioresu=$_POST['folioresultado'];
//echo("respuesta ".$respuesta.", correcta ".$respcorrecta);
//creamos las variables de tiempo
$tiempofin=date("H:i:s");
$timefinunix=time();
$duracionseg=$timefinunix - $iniunix;//esta es la duracion pero en segundos
//iniciamos un proceso para convertir los segundos de la duracion
//a horas:minutos:segundos
$segundos=$duracionseg;
$horas=$segundos/3600; //salen las horas
$segundos=$segundos%3600; //sobrante
$minutos=$segundos/60;//salen minutos
$segundos=$segundos%60;//sobrante y salen segundos
//duracion en formato h:m:s
$duracion=(integer)$horas.":".(integer)$minutos.":".(integer)$segundos;
//sacamos si la respuesta fue correcta o no
if(strcasecmp($respuesta, $respcorrecta)==0){
$correcta="SI";
}
else{
$correcta="NO";
}
echo("<p>Tu Respuesta es: </p>");
if ($correcta=="SI"){
echo("<p>Correcta!</p>");
}
if ($correcta=="NO"){
echo("<p>incorrecta</p>");
}

//actualizamos el registro
//echo("el equipo es:".$equipo." la pregunta es la numero:".$folio);
mysqli_query($conn,"update resultados set respuesta='$respuesta', correcta='$correcta', hora_fin='$tiempofin', duracion='$duracion' where num_equipo='$equipo' and pregunta='$folio' and folio='$folioresu' ");
//echo("update resultados set respuesta='$respuesta', correcta='$correcta', hora_fin='$tiempofin', duracion='$duracion' where num_equipo='$equipo' and pregunta='$folio'")
mysqli_close($conn);?>
<form method="post" action="bienvenidopreg.php" name="ok">
<input name="mesa" value="<?php echo($mesa) ?>" type="hidden"><input name="lvl" value="<?php echo($nivel)?>" type="hidden"><input name="fisica" value="<?php echo($fis) ?>" type="hidden"><input name="quimica" value="<?php echo($quim) ?>" type="hidden"><input name="matematicas" value="<?php  echo($mates) ?>" type="hidden"><br><div style="text-align: center;"><input value="OK" name="ok" type="submit"><br>
</div></form>
</body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>