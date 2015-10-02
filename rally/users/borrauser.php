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
mysqli_query($conn,"Delete from usuarios where usuario_id='".$usuario."'") or die("no se pudo eliminar el usuario".mysqli_error($conn));
mysqli_query($conn,"Delete from admins where id='".$usuario."'");
echo("usuario eliminado");
$resultado=$_SESSION['usuario_nombre']." elimin&oacute al usuario numero ".$usuario;
$usuario_id = $_SESSION['usuario_id'];
                    mysqli_query($conn,"insert into log (usuario, evento) values('$usuario_id','$resultado')") or die("error al escribir en el log".mysqli_error($conn));
?>
<?php }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../login/acceso.php'>Ingresar</a>";
    }
?>