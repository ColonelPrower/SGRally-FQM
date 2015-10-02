<!-- Sistema de Administracion de Rally de Conocimientos de Fisica, Quimica y Matematicas
    Script de generacion de pregunta aleatoria con funcion "cuenta atras" 
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
    include('../lib/config.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Pregunta</title>

<link href="../plantilla/estilos/paginas.css" rel="stylesheet" type="text/css">
    
    <script type="text/javascript">
function redireccion() //funcion para redirigir cuando se acabe el tiempo
	{ 
		document.getElementById('acaba').click();
		//window.location ="http://www.google.com"; 
                      }
var s=0; //segundos
var m=0; //minutos
var t=false;

function unafuncion(id){
	return document.getElementById(id);
}
function acabo(){
			alert("Se terminó el tiempo");
		}

function startTemporizador(minu,sec){
	s=sec;
	m=minu;
	if(t){//si acabo el tiempo
		unafuncion('mensaje').innerHTML="Se acabó tu tiempo";
		redireccion();
		}
		else{//si no a acabado el tiempo
			if(s==0 && m>0){//si hay minutos y no hay segundos ej 01:00
				s=59;
				m--;
			}
			else{
				s--;
			}
			
			if(s==0 && m==0){//si s es igual a cero acabo el tiempo
				t=true;
					}

			contar_tc=setTimeout('startTemporizador(m,s)',1000);
			unafuncion('segundos').innerHTML=s;//imprime segundos
			unafuncion('minutos').innerHTML=m;//imprime minutos
			//unafuncion('debug1').innerHTML="minuto vale"+m;
			//unafuncion('debug2').innerHTML="segundo vale"+s;
			}
}// a continuacion se imprime el temporizador
</script>
    
</head>
<body>
<?php 
//atencion: aunque dice copia este es el modulo que si funciona y esta en el sistema
require_once('../lib/config.php');
//obtener las variables de los parametros, la mesa y el equipo
$quim=$_POST['quim'];
$mates=$_POST['mat'];
$fisic=$_POST['fis'];
$lvl=$_POST['lvl'];
$mesa=$_POST['mesa'];
$equipo=$_POST['eq'];
$materias="";
$tiempoini=date("H:i:s");
$iniciounix=time();//utiliza la hora unix la cual son los segundos desde 1/01/1970 para restarlos con otro para sacar la duracion


// construir una consulta
$comando="Select count(*) as cuenta from reactivos where nivel='$lvl'";
//si existe al menos una materia checada.
if($quim=='si' or $mates=='si' or $fisic=='si'){
	$comando=$comando." and(";
//existen 2 materias solamente checadas?
	if($quim=='si' and $mates=='si' and $fisic=='no'){$materias=" materia='matematicas' or materia='quimica' ";$comando=$comando.$materias;}
	if($mates=='si' and $fisic=='si' and $quim=='no'){$materias=" materia='matematicas' or materia='fisica' ";$comando=$comando.$materias;}		
	if($fisic=='si' and $quim=='si' and $mates=='no'){$materias=" materia='fisica' or materia='quimica'";$comando=$comando.$materias;	}
//existen las 3 materias?
	if($quim=='si' and $mates=='si' and $fisic=='si'){$materias=" materia='fisica' or materia='quimica' or materia='matematicas' ";$comando=$comando.$materias;}
//existen una materia solamente?
	if($quim=='si' and $mates=='no' and $fisic=='no'){$materias=" materia='quimica' ";$comando=$comando.$materias;}
	if($quim=='no' and $mates=='si' and $fisic=='no'){$materias=" materia='matematicas' ";$comando=$comando.$materias;}
	if($quim=='no' and $mates=='no' and $fisic=='si'){$materias=" materia='fisica' ";$comando=$comando.$materias;}
//cerramos el and de la consulta
	$comando=$comando.")";
}

//sacamos la cuenta de reactivos generado anteriormente foliotemp es un campo temporal que nos permitira re-enumerar 
//la lista de las preguntas con un numero autoincrementable
$listarpreg="SELECT @rownum:=@rownum+1 foliotemp,descripcion,foto_desc,opca,opcb,opcc,fotoa,fotob,fotoc,respuesta,materia,folio,nivel 
FROM reactivos , (SELECT @rownum:=0) R 
where nivel='$lvl'";
if ($materias!==""){//si hay materias
	$listarpreg=$listarpreg." and(".$materias.")";
}

$consulta=mysqli_query($conn,$comando);
$cuenta=mysqli_fetch_array($consulta);
//si no hay preguntas mata el php
if($cuenta['cuenta']==0){
print("¡¡NO HAY PREGUNTAS REGISTRADAS!!")and die();
}
//genera el folio aleatorio de la pregunta, si el que sale fue borrado, se repite
else{
do{
$pregrandom=rand(1,$cuenta['cuenta']);
$consulpreg=mysqli_query($conn,$listarpreg);//alt "select * from reactivos where folio=$pregrandom"
$generapreg=mysqli_fetch_array($consulpreg);

// de las preguntas listadas y filtradas sacamos la pregunta aleatoria
	do{
		$temporal=$generapreg['foliotemp'];
		// echo("<br> temporal es igual a ".$temporal);
		// echo("hola aqui se esta eligiendo la pregunta XDXD <br> el numero aleatorio es ".$pregrandom."<br>");
	if($temporal==$pregrandom){
		$desc=$generapreg['descripcion'];
		$fotodesc=$generapreg['foto_desc'];
		$opa=$generapreg['opca'];
		$opb=$generapreg['opcb'];
		$opc=$generapreg['opcc'];
		$fotoa=$generapreg['fotoa'];
		$fotob=$generapreg['fotob'];
		$fotoc=$generapreg['fotoc'];
		$respuesta=$generapreg['respuesta'];
		$mat=$generapreg['materia'];
		$folio=$generapreg['folio'];
		$niv=$generapreg['nivel'];
		// echo("la encontró!!");
	}
	}
	while($generapreg=mysqli_fetch_array($consulpreg));
}	
while(mysqli_num_rows($consulpreg)==0);
//echo("<br> la consulta fue ".$listarpreg);
}

//finalmente generamos un registro del equipo con la hora de inicio
$iniciaequipo=mysqli_query($conn,"Insert into resultados (pregunta,num_equipo,num_mesa,hora_ini) values('$folio','$equipo','$mesa','$tiempoini')") or die("no se pudo iniciar el equipo ".mysqli_error($conn));
//saca el ultimo folio insertado para evitar duplicados y actualizaciones erroneas en el siguiente formulario donde inserta la pregunta
$sacafolio=mysqli_query($conn,"select max(folio) as folio from resultados") or die("no se pudo sacar el ultimo folio ".mysqli_error($conn));
$folioresu=mysqli_fetch_array($sacafolio);
?>
<?php //generamos la pregunta ya que salio un folio existente
$foliopregunta=$folio;
//echo("folio pregunta".$foliopregunta." folio".$folio);
//generamos rutas de imagenes de default
$rutadesc="../images/reactivos/".$fotodesc;
$rutaopca="../images/reactivos/".$fotoa;
$rutaopcb="../images/reactivos/".$fotob;
$rutaopcc="../images/reactivos/".$fotoc;
//si  existen los archivos cambia a imagen original
 if(!file_exists($rutadesc)){
		//echo("existe foto");
	$rutadesc="../images/reactivos/default.png";
	}
 if(!file_exists($rutaopca)){
		//echo("existe foto a");
	$rutaopca="../images/reactivos/default.png";

	}
 if(!file_exists($rutaopcb)){
		//echo("existe foto b");
	$rutaopcb="../images/reactivos/default.png";

	}
 if(!file_exists($rutaopcc)){
		//echo("existe foto c");
		$rutaopcc="../images/reactivos/default.png";

	}
	
?>
<?php $tiempo=mysqli_query($conn,"select * from tiemposreact where id_preg='$foliopregunta'") or die("error al sacar el reloj de la bd ".mysqli_error);
        echo ("tiempo");
        $reloj=mysqli_fetch_array($tiempo);
        $minutos=$reloj['minutos'];
        $segundos=$reloj['segundos'];//sacamos los minutos y segundos del reloj?>
        <!-- inicio del reloj -->
        <script type="text/javascript">startTemporizador(<?php echo $minutos ?>,<?php echo $segundos ?>)</script>
        <table border="1">
	  <tbody>
	    <tr><td>
	  <table border="0">
	  <tbody>
	    <tr>
	      <td>
		<div id="minutos">0</div>
	      </td>
	      <td>:
	      </td>
	      <td>
		<div id="segundos">0</div>
	      </td>
	      </tr>
	  </tbody>
	  </table>
	    <div id="mensaje"> </div>
	    </td></tr>
	    
	  </tbody>
	</table>
	  <div id="debug1"> </div>
	  <div id="debug2"> </div>
        <!-- fin reloj-->
        
<h1 align="center">Esta es tu pregunta</h1>
<form method="post" action="preguntacontestada.php" name="pregunta">
<input name="folioresultado" value="<?php echo($folioresu['folio']); ?>" type="hidden">
<input name="folioform" value="<?php echo($foliopregunta)?>" type="hidden">
<input name="mesa" value="<?php echo($mesa)?>" type="hidden">
<input name="equipo" value="<?php echo($equipo)?>" type="hidden">
<input name="iniciounix" value="<?php echo($iniciounix)?>" type="hidden">
<!--acarreamos las materias para evitar perder la configuracion-->
<input name="quimica" value="<?php echo($quim)?>" type="hidden">
<input name="fisica" value="<?php echo($fisic)?>" type="hidden">
<input name="matematicas" value="<?php echo($mates)?>" type="hidden">
<input name="nivelp" value="<?php echo($niv)?>" type="hidden">
<input name="resp" value="<?php echo($respuesta)?>" type="hidden">
<table style="width: 100%; height: 164px; text-align: left; margin-left: auto; margin-right: auto;" border="2" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td>nivel:<?php echo($niv) ?></td>
<td>materia:<?php echo($mat) ?></td>
</tr>
<tr>
<td><br><?php echo($desc) ?><img style="width: 300px; height: 300px;" src="<?php echo $rutadesc ?>"></td>
<td>&nbsp;</td></tr>
<tr><td><input name="opciones" type="radio" value="X" checked > Selecciona una opción </td><td></td></tr>
<tr>
<td> <input name="opciones" value="A" type="radio"><?php echo($opa) ?></td>
<td><img style="width: 100%; height: 100%;" src="<?php echo $rutaopca ?>"></td>
</tr>
<tr>
<td><input name="opciones" value="B" type="radio"><?php echo($opb) ?></td>
<td><img style="width: 100%; height: 100%;" src="<?php echo $rutaopcb?>"></td>
</tr>
<tr>
<td><input name="opciones" value="C" type="radio"><?php echo($opc) ?></td>
<td><img style="width: 100%; height: 100%;" src="<?php echo $rutaopcc ?>"></td>
</tr>
</tbody>
</table>
<br>
<input name="enviar" id="acaba" type="submit" value="Contestar">
</form>
<?php mysqli_close($conn); ?>
</body></html>
<?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>