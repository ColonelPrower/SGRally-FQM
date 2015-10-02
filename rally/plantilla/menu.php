<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><?php session_start();
    include('../lib/config.php');
?>


  
  <script type="text/javascript" src="estilos/jquery.js"> </script>
  
  <script type="text/javascript">
$(document).ready(function() {
//muestra y oculta los menus
$('ul li:has(ul)').hover(
function(e)
{
$(this).find('ul').css({display:"block"});
},
function(e)
{
$(this).find('ul').css({display:"none"});
}
);
});
  </script>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>menu</title>
  

  
  
  <link href="estilos/menu.css" rel="stylesheet" type="text/css" />

  
  <style type="text/css">
body {
background-color: #007AAB;
background-image: url(imagenes/fondo_menu.jpg);
background-repeat: repeat-y;
}
  </style><!-- Start css3menu.com HEAD section -->
  
  <link rel="stylesheet" href="menu_files/css3menu1/style.css" type="text/css" /><!-- End css3menu.com HEAD section --></head><body>
<!-- Start css3menu.com BODY section id=1 -->
<ul id="css3menu1" class="topmenu">

  <li class="topfirst"><a class="pressed" href="central.html" target="mainFrame" style="width: 76px;">Inicio</a></li>
  <li class="topmenu"><a href="#" style="width: 76px;"><span>Equipos</span></a>
    <ul>
      <li class="subfirst"><a href="../consultas/consultageneral.php" target="mainFrame">Mostrar
todos</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../consultas/consultaequipo.php" target="mainFrame">Consultar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../Altas/altaequipo.htm" target="mainFrame">Nuevo</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../Bajas/borrarequipo.php" target="mainFrame">Borrar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../modificacion/modificar_equipo.html" target="mainFrame">Modificar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
    </ul>
  </li>
  <li class="topmenu"><a href="#" style="width: 76px;"><span>Participantes</span></a>
    <ul>
      <li class="subfirst"><a href="../consultas/consultagral_participantes.php" target="mainFrame">Mostrar
Todos</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../Bajas/borrarparticipante.htm" target="mainFrame">Borrar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../modificacion/modificar_participante.html" target="mainFrame">Modificar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
    </ul>
  </li>
  <li class="topmenu"><a href="#" style="width: 76px;"><span>Reactivos</span></a>
    <ul>
      <li class="subfirst"><a href="../Altas/alta_reactivos.htm" target="mainFrame">Nuevo</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../Bajas/eliminar_reactivo.htm" target="mainFrame">Borrar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../consultas/consultagral_reactivos.php" target="mainFrame">Consultar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../modificacion/modificar_reactivo.htm" target="mainFrame">Modificar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../consultas/confpreguntas.php" target="mainFrame">Iniciar
Preguntas</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
    </ul>
  </li>
  <li class="topmenu"><a href="#" style="width: 76px;"><span>Profesores</span></a>
    <ul>
      <li class="subfirst"><a href="../Altas/alta_maestro.html" target="mainFrame">Nuevo</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../Bajas/borrarmaestro.html" target="mainFrame">Borrar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../consultas/consultagral_maestros.php" target="mainFrame">Consulta</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../modificacion/modificar_maestro.html" target="mainFrame">Modificar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
    </ul>
  </li>
  <li class="topmenu"><a href="#" style="width: 76px;"><span>Mesas</span></a>
    <ul>
      <li class="subfirst"><a href="../Altas/alta_mesa.php" target="mainFrame">Nueva</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../Bajas/eliminar_mesa.php" target="mainFrame">Borrar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../consultas/consulta_mesas.php" target="mainFrame">Consulta</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../modificacion/modificar_mesa.php" target="mainFrame">Modificar</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
    </ul>
  </li>
  <li class="topmenu"><a href="../consultas/preg_contestadas.php" target="mainFrame" style="width: 76px;">Respuestas</a></li>
  <li class="topmenu"><a href="../Bajas/resetrally.php" target="mainFrame" style="width: 76px;">Reset Rally</a></li>
  <li class="topmenu"><a href="../reportes/reportes.htm" target="mainFrame" style="width: 76px;">Reportes</a></li>
  <li class="topmenu"><a href="../consultas/historial.html" target="mainFrame" style="width: 76px;">Historial</a></li>
  <li class="toplast"><a href="#" style="width: 76px;"><span>Resultados</span></a>
    <ul>
      <li class="subfirst"><a href="../finalizar/finalizar_equipo.html" target="mainFrame">Finalizar
Equipo</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
      <li><a href="../consultas/ranking.php" target="maixnFrame">Ranking</a><br />
        <br />
        <br />
      <br />
        <br />
</li>
    </ul>
  </li>
  <li class="topmenu"><a href="../users/users.php" target="mainFrame" style="width: 76px;">Usuarios</a></li>
</ul>

<!-- End css3menu.com BODY section -->
</body></html>