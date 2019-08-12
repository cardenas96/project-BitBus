<?php
require('fpdf.php');

class PDF extends FPDF
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
		$this->Cell(0,6,'Camiones Registrados',0,1,'C');	
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
	function LoadData()
	{
		// Leer las líneas del fichero
		$host_db = "localhost";
		$usuario_db = "root";
		$pass_db ="";
		$conexion = mysqli_connect($host_db,$usuario_db,$pass_db);
		$data = array();
		mysqli_select_db($conexion,"bitbus");
		if($resultado = mysqli_query($conexion,"SELECT * FROM autobus"))
		{			
			while($fila = mysqli_fetch_row($resultado))
			{

			if($fila[4] = 1)
			{
				$estado = "Activo";
			}
			else
			{
				$estado = "Inactivo";
			}
				$data[] = explode(';',trim($fila[1].';'.$fila[2].';'.$fila[3].';'.$estado));
			}
		}

		return $data;
	}
	
	function ImprovedTable($header, $data)
	{
		// Anchuras de las columnas
		//$this ->Ln(20);
		
		$contador = 0;
		$w = array(40, 40, 30, 30);
		// Cabeceras
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C');
		
		$this->Ln();
		// Datos
		$this->SetFont('Arial','',12);
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR');
			$this->Cell($w[1],6,$row[1],'LR');
			$this->Cell($w[2],6,$row[2],'LR',0,'L');
			$this->Cell($w[3],6,$row[3],'LR',0,'R');
			$this->Ln();
			$contador++;
			if($contador == 46){
				$this-> AddPage();
				$contador = 0;
			}
		}
		// Línea de cierre
		$this->Cell(array_sum($w),0,'','T');
	}	
}
	$pdf = new PDF();
	$pdf->AliasNbPages();
	// Títulos de las columnas
	$data = $pdf->LoadData();
	$pdf->SetFont('Arial','',14);
	$header = array('Marca', 'Modelo', 'Capacidad','Estado');
	$pdf->AddPage();
	$pdf->ImprovedTable($header,$data);
	//$pdf->ImprovedTable($header,$data);
	$pdf->Output();
?>
