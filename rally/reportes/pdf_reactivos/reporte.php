<?php 
# Cargamos la librer�a dompdf.
//include('../../lib/config.php');
require_once 'dompdf_config.inc.php';
ob_start();
//include( "reactivos.php" );
$variable = file_get_contents('reactivos.php');
 
# Contenido HTML del documento que queremos generar en PDF.
$html=$variable;
 
# Instanciamos un objeto de la clase DOMPDF.
$mipdf = new DOMPDF();
 
# Definimos el tama�o y orientaci�n del papel que queremos.
# O por defecto coger� el que est� en el fichero de configuraci�n.
$mipdf ->set_paper("A3", "landscape");
 
# Cargamos el contenido HTML.
$mipdf ->load_html(utf8_decode($html));
 
# Renderizamos el documento PDF.
$mipdf ->render();
 
# Enviamos el fichero PDF al navegador.
$mipdf ->stream('Reporte_de_Reactivos.pdf');
?>