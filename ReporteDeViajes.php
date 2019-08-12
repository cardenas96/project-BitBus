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
    $this->Cell(0,6,'Viajes Registrados',0,1,'C');	
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
$pdf->AddCol('idViaje',15,'ID','R');
$pdf->AddCol('nombre',45,"Origen",'L');
$pdf->AddCol('nombre',45,"Destino",'L');
$pdf->AddCol('Asientos',30,"Asientos",'R');
$pdf->AddCol('precioBoleto',30,"Precio",'R');
//$pdf->AddCol('pop',40,'Pop (2001)','R');
$prop = array('HeaderColor'=>array(234, 234, 234),
            'color1'=>array(245, 245, 245),
            'color2'=>array(194, 194, 194),
            'padding'=>2);
$pdf->Table($link,'SELECT v.idViaje,p.nombre,po.nombre,v.Asientos,h.precioBoleto FROM VIAJES v 
					INNER JOIN HORARIO h ON v.idHorario = h.idHorario
					INNER JOIN POBLACIONES p ON h.idPoblacionO = p.idPoblacion
					INNER JOIN POBLACIONES po ON h.idPoblacionD = po.idPoblacion 
					',$prop);
$pdf->Output();
?>