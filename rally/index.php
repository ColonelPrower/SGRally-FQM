<?php 
    session_start(); 
    include('./lib/config.php'); // incluímos los datos de acceso a la BD 
    // comprobamos que se haya iniciado la sesión 
    if(isset($_SESSION['usuario_nombre'])) { 
?> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema de Rally de Fisica Quimica y Matematicas</title>
</head>
<frameset rows="51,*,31" cols="*" framespacing="0" frameborder="no" border="0">
  <frame src="plantilla/arriba.html" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset rows="*" cols="210,*" framespacing="0" frameborder="no" border="0">
		<frame src="plantilla/menu.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
		<frame src="plantilla/central.html" name="mainFrame" id="mainFrame" title="mainFrame" />
	</frameset>
  <frame src="plantilla/pie_de_pagina.php" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="bottomFrame" />
</frameset>
<noframes><body>
</body></noframes>
</html>
<?php 
    }
    else { 
        echo "<img src='./plantilla/imagenes/logorally.gif' alt='sistema gestor de rally de matematicas fisica y quimica'></br>Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br /> 
        <a href='./login/acceso.php'>Ingresar</a> "; 
    } 
	mysqli_close($conn);
?>
