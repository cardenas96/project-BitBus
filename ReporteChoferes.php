<?php
require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
    // Title
	$this->Image("imagenes/logo.png",10,1,40);
	//$this->;
	$this->SetFont('Arial','',12);
	$this->Cell(0,6,'Sistema Bitbus - Administracion/Consultas/Informes',0,1,'C');
	$this->SetFont('Arial','I',12);
	$this->Cell(0,6,'Fecha de Reporte: ' . date("d/m/Y"),0,1,'C');
	$this->Ln(4);
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,'CHoferes Registrados',0,1,'C');	
    $this->Ln(10);
    // Ensure table header is printed
    parent::Header();
}
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

// Connect to database
$link = mysqli_connect('localhost','root','','bitbus');

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
// Second table: specify 3 columns
$pdf->AddCol('idChofer',15,'ID','R');
$pdf->AddCol('nombre',45,"Nombres",'L');
$pdf->AddCol('direccion',35,'Direccion','L');
$pdf->AddCol('telefono',40,"Telefono",'R');
$pdf->AddCol('fechaRegistro',26,'Registro','R');
$pdf->AddCol('vigenciaLicencia',26,"Vigencia",'R');
//$pdf->AddCol('pop',40,'Pop (2001)','R');
$prop = array('HeaderColor'=>array(234, 234, 234),
            'color1'=>array(245, 245, 245),
            'color2'=>array(194, 194, 194),
            'padding'=>2);
$pdf->Table($link,'SELECT idChofer,nombre,direccion,telefono,fechaRegistro,vigenciaLicencia FROM CHOFERES',$prop);
$pdf->Output();
?>