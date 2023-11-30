<?php

  require('fpdf/fpdf.php');


  class PDF extends FPDF
  {

  function Header()
  {
    
     
     $this->Image('./../imagenes/logo.jpg', 185, 5, 20); 
     $this->SetFont('Arial', 'B', 19); 
     $this->Cell(45); 
     $this->SetTextColor(0, 0, 0); 
   
     $this->Cell(110, 15, mb_convert_encoding('MITO LIMPIEZA S.A.S', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);  
     $this->Ln(3); 
     $this->SetTextColor(103);

     /* UBICACION */
     $this->Cell(110);  
     $this->SetFont('Arial', 'B', 10);
     $this->SetX(115);
     $this->Cell(96, 10, mb_convert_encoding("Ubicación : Eliseo Soaje 1285 Bº Alto de Velez Sarfield", 'ISO-8859-1', 'UTF-8'), 0, 0, '', 0);
     $this->Ln(5);

     /* TELEFONO */
     $this->Cell(110);  
     $this->SetFont('Arial', 'B', 10);
     $this->SetX(115);
     $this->Cell(59, 10, mb_convert_encoding("Teléfono : 3515958890" , 'ISO-8859-1', 'UTF-8'), 0, 0, '', 0);
     $this->Ln(5);

     /* COREEO */
     $this->Cell(110);   
     $this->SetFont('Arial', 'B', 10);
     $this->SetX(115);
     $this->Cell(96, 10, mb_convert_encoding("Ubicación : Eliseo Soaje 1285 Bº Alto de Velez Sarfield", 'ISO-8859-1', 'UTF-8'), 0, 0, '', 0);
     $this->Ln(20);

  }


  function Footer()
  {
  
     $this->SetY(-15);
       
      $this->SetFont('Arial','B',10);
       
     $this->Cell(170,10,'Todos los derechos reservados',0,0,'C',0);
     $this->Cell(25,10,mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8').$this->PageNo().'/{nb}',0,0,'C');
  }
  }

   


  $pdf = new PDF();
    
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetMargins(10,10,10);
  $pdf->SetAutoPageBreak(true,20);
  $pdf->SetX(15);
  $pdf->SetFont('Helvetica','B',15);
  $pdf->Ln(10);
  $pdf->Cell(60,8,'Producto','B',0,'C',0);
  $pdf->Cell(30,8,'Costo','B',0,'C',0);
  $pdf->Cell(35,8,'Cantidad','B',0,'C',0);
  $pdf->Cell(50,8,'Subtotal','B',1,'C',0);




 while ($ver=$result->fetch_assoc()):



  $pdf->SetFillColor(233, 229, 235);
  $pdf->SetDrawColor(61, 61, 61);

  $pdf->SetFont('Arial','',12);

    
      $pdf->Ln(0.6);
      $pdf->setX(15);
      
      $pdf->Cell(60,8,$ver['nombre'],'B',0,'C',1);
      $pdf->Cell(30,8,$ver['precio'],'B',0,'C',1);
      $pdf->Cell(35,8,$ver['cantidad'],'B',0,'C',1);
      $pdf->Cell(50,8,'$'.$ver['total'],'B',1,'C',1);
       
      $montoTotal = $ver['monto'];
      $pdf->setX(15);
      $cliente = utf8_decode($ver['cliente']);
      $comprobante = $ver['idpedido'];
      $fecha = $ver['fecha'];
 endwhile;

   $pdf->Ln(5);
   $pdf->Cell(0, 8, 'Monto Total: $' . $montoTotal , 0, 0, 'R');
   $pdf->SetY(50);  
   $pdf->SetX(20);  
   $pdf->SetFont('Arial','B',12); 
   $pdf->Cell(0, 10, 'Cliente: ' . $cliente, 0, 1, 'R');
   $pdf->SetX(15);
   $pdf->SetY(40);
   $pdf->Cell(0, 8, 'Numero de Comprobante: ' . $comprobante, 0, 1, 'L');
   $pdf->SetX(15);
   $pdf->SetY(30);
   $pdf->Cell(0, 8, 'Fecha: ' . $fecha, 0, 1, 'L');
   $pdf->Output(); 
      
    $pdf->SetY(110);
    $pdf->setX(15);
    $pdf->Cell(0, 8, 'Monto Total: $' . $montoTotal , 0, 0, 'R');
    

?>  
