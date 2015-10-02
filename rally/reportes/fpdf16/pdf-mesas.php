<?php
    session_start();
    include('../../lib/config.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?><?php
require('fpdf.php');
ob_end_clean();
class PDF extends FPDF
{
//Tabla coloreada
function FancyTable($encabezados,$result)
{
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(0,0,255);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    $this->Ln();
    //Cabecera
    $w=array(60,60);
    for($i=0;$i<count($encabezados);$i++)
        $this->Cell($w[$i],7,$encabezados[$i],1,0,'C',1);
    $this->Ln();
    //Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    //Datos
    $fill=true;
	$y=40;
    $row = mysqli_fetch_array($result);
    do {
	   // Cell(ancho, alto, cadena a desplegar, bordes,
	   //donde (a la derecha o siguiente linea....), alineación, colorear y no colorear ) 
	   // Cell(puntos, puntos, string, 0no y 1si, 0der 1siglinea 2abajo, 'C''R''L', boolean ) 
        $this->Cell($w[0],15,$row[0],0,0,'C',$fill);
	    $this->Cell($w[1],15,$row[1],0,0,'C',$fill);
		
		//$this->Cell($w[6],15,$row[6],0,0,'C',$fill);	
	    $fill=!$fill;
		// $archivo='../../images/participantes/'.$row[6];
		// $this->image($archivo,240,$y,10); //pon la foto en la misma columna pero cada vez 15 pixeles mas abajo, 10 es el ancho de la foto
		$y=$y+15;
		
		//if ($y=200) $y=20;
 		$this->Ln();
	    
    } while ($row=mysqli_fetch_array($result));
  
}
} //fin de la definicion de la clase extendida de fpdf

//----------------------------------------------------
//conexion a la base de datos
	require_once('../../lib/config.php');
// $conn = mysqli_connect("localhost","root","");
// mysqli_select_db("prally", $conn);


$result = mysqli_query($conn,"SELECT num_mesa, maestro from mesas"); //devuelve true si se pudo hacer la consulta, y falso en caso contrario

//si hay registros insertados
if (mysqli_num_rows($result))
{
	$pdf=new PDF('L','mm','Letter');
	
	//Titulos de las columnas
	$encabezados=array(utf8_decode('Número de Mesa'),'Profesor a cargo');
	$pdf->SetFont('Arial','',12);
	$pdf->AddPage();
	$pdf->Write(10,'Listado de las Mesas del Rally', '');
	$pdf->Ln();
	$pdf->FancyTable($encabezados,$result); //dibuja la tabla con la funcion FancyTable
 	//<img src="../../images/participantes/$row['foto']" width='50px' height='60px'/>
	$pdf->Output();

} 
else 
{
	echo "¡ La base de datos está vacia !";
}
?>
 <?php
    }else {
        echo "Est&aacutes accediendo a una p&aacutegina restringida, para ver su contenido debes estar registrado.<br />
        <a href='../../login/acceso.php'>Ingresar</a>";
    }
?>