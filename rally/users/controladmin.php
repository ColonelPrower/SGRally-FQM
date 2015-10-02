<?php session_start();
    include('../lib/config.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
      $user=$_SESSION['usuario_id'];
      $sacaidadmin=mysqli_query($conn,"Select id from admins where id='$user'");
      if (mysqli_num_rows($sacaidadmin)==0)
	{
	print("No tiene privilegios de Administrador")and die();
        }
?>
<?php
$usuario=$_POST['usuarios'];
$admin=$_POST['permiso'];
//echo($admin);
if($admin=="concedido"){
    $consulta=mysqli_query($conn,"select * from admins where id='$usuario'");
    $consulta2=mysqli_query($conn,"select usuario_nombre from usuarios where usuario_id='$usuario'");
    $nuevoadmin=mysqli_fetch_array($consulta2);
    $newadmin=$nuevoadmin['usuario_nombre'];
    if(mysqli_num_rows($consulta)){
        echo("el usuario actualmente ya es administrador") and die();
    }
    mysqli_query($conn,"insert into admins values('$usuario','$newadmin')");
    echo("se le otorgaron a ".$newadmin." permisos de administrador");
}
if($admin=="revocado"){
    mysqli_query($conn,"Delete from admins where id='".$usuario."'");
    echo("se le han revocado los permisos de administrador al usuario");
}
//echo($admin)
?>
<?php }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>