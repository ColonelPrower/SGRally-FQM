<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Untitled Document</title>

<style type="text/css">
body {
background-color: #0097D0;
background-image: url(imagenes/fondo_encabezado.jpg);
background-repeat: repeat-x;
}
</style>
<link href="estilos/paginas.css" rel="stylesheet" type="text/css" />
<?php session_start();
    include('../lib/config.php');
?>
</head>

<body>
<?php if(isset($_SESSION['usuario_nombre'])) {
?>
Bienvenido:
<?php echo("<a target='mainFrame' href='../login/perfil.php?id=".$_SESSION['usuario_id']."'><strong>".$_SESSION['usuario_nombre']."</strong></a>");?>
        <a target="_parent" href="../login/logout.php">Cerrar Sesi&oacute;n</a> &nbsp; &nbsp;
		<?php
    }
?>
<a target="mainFrame" href="../otros/acerca_de.html">
<img style="border: 0px solid ; width: 34px; height: 34px;" src="../images/otros/info_but2.png" alt="info_but2.png" align="top" hspace="0" vspace="0" />Acerca de</a>

</body></html>