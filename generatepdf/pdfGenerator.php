<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            
            if(isset($_POST['Report_PendingOrder'])){

                include '../database/dbConnection.php'; 
                require('fpdf.php');            

//--------------CONTENT FOR PAGE 1---------------------------------------------------------
                //Header
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(190, 10, 'FitSushi Order List',1,1,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(100, 6, 'Contact us: 0111251420',1,1,'L');
                $pdf->Ln();
                $pdf->Cell(100, 6, 'Address: Virtual',1,1,'L');
                $pdf->Ln(); 
                $pdf->Ln(); 
                $pdf->Cell(20, 10, 'List generated on: '. $timestamp = date("d M Y H:i:s"), 'C');
                $pdf->Ln();

                $thismonth = date('m');
                $thisyear = date('Y');
                $nextmonth = $thismonth+1;  

                // Select data from MySQL database
                $displayTotalSushi = "SELECT s.sushiID, s.sushiName, SUM(a.qty) totalqty FROM sushi s, orders o, alacarteorder a WHERE s.sushiID = a.sushiID AND a.orderID = o.orderID AND o.orderStatusID = 4 GROUP BY s.sushiID";
                $result = mysqli_query($conn, $displayTotalSushi);

                $pdf->Ln();

                //Table
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(30,8,'Sushi ID',1,0,'C');
                $pdf->Cell(55,8,'Sushi Name',1,0,'C');
                $pdf->Cell(30,8,'Total Quantity',1,0,'C');
                $pdf->SetFont('ZapfDingbats','', 8);
                $pdf->Cell(10,8,"4",1,0,'C');
                $pdf->Ln();

                $pdf->SetFont('Arial','',8);
                while($row = $result->fetch_assoc()){
                    $sushiID = $row['sushiID'];
                    $sushiName = $row['sushiName'];
                    $qty = $row['totalqty'];
                    $pdf->Cell(30,8,$sushiID,1,0,'C');
                    $pdf->Cell(55,8,$sushiName,1,0);
                    $pdf->Cell(30,8,$qty,1,0,'C');
                    $pdf->Cell(10,8,'',1,0,'C');
                    $pdf->Ln();                            
                }
            
                $pdf->addpage();

//--------------CONTENT FOR PAGE 2---------------------------------------------------------  

                $displayCustomerOrder = "SELECT o.orderID, c.custName, s.sushiName, a.qty, c.deliveryAddress, ad.PostalCode, ad.State, ad.Area, ad.Country, o.orderTotal FROM customer c, sushi s, alacarteorder a, orders o, address ad WHERE c.customerID=o.customerID AND s.sushiID=a.sushiID AND a.orderID=o.orderID AND c.PostalCode = ad.PostalCode AND o.orderStatusID=4";
                $result2 = mysqli_query($conn, $displayCustomerOrder);

                $pdf->Ln();

                $pdf->SetFont('Arial','B',12);
                //Table
                $pdf->Cell(190,8,'Customer Order (Pending)',1,1,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(20,8,'Order ID',1,0,'C');
                $pdf->Cell(30,8,'Customer Name',1,0,'C');
                $pdf->Cell(30,8,'Sushi Name',1,0,'C');
                $pdf->Cell(15,8,'Quantity',1,0,'C');
                $pdf->Cell(65,8,'Address',1,0,'C');
                $pdf->Cell(20,8,'Total (RM)',1,0,'C');
                $pdf->SetFont('ZapfDingbats','', 8);
                $pdf->Cell(10,8,"4",1,0,'C');
                $pdf->Ln();

                $pdf->SetFont('Arial','',8);
                while($row = $result2->fetch_assoc()){
                    $orderID = $row['orderID'];
                    $custName = $row['custName'];
                    $sushiName = $row['sushiName'];
                    $qty = $row['qty'];
                    $address = $row['deliveryAddress'].', '.$row['PostalCode'].' '.$row['Area'].', '.$row['State'].', '.$row['Country'];
                    $price = $row['orderTotal'];
                    $pdf->Cell(20,16,$orderID,1,0,'C');
                    $xPos=$pdf->GetX();
                    $yPos=$pdf->GetY();                    
                    $pdf->MultiCell(30,16,$custName,1);
                    $pdf->SetXY($xPos + 30, $yPos);
                    $xPos=$pdf->GetX();
                    $yPos=$pdf->GetY();
                    $pdf->MultiCell(30,16,$sushiName,1);
                    $pdf->SetXY($xPos + 30, $yPos);
                    $pdf->Cell(15,16,$qty,1,0,'C');
                    $xPos=$pdf->GetX();
                    $yPos=$pdf->GetY();
                    $pdf->MultiCell(65,8,$address,1);
                    $pdf->SetXY($xPos + 65, $yPos);
                    $pdf->Cell(20,16,$price,1,0,'C');
                    $pdf->Cell(10,16,'',1,0,'C');
                    $pdf->Ln();                            
                }


                //Below table
                $pdf->Ln();   
                $pdf->SetFont('Arial','B',12);                    
                $pdf->Cell(40, 20, 'Notes:');
                $pdf->Ln();    
                $pdfname = "Pending Order (".date('d M Y').")";                   
                ob_start();
                $pdf->Output($pdfname, 'I');

            }else if(isset($_POST['Report_OnDeliverOrder'])){

                include '../database/dbConnection.php'; 
                require('fpdf.php');            

                //Header
                $pdf = new FPDF();
                $pdf->AddPage();
                $displayCustomerOrder = "SELECT o.orderID, c.custName, s.sushiName, a.qty, c.deliveryAddress, ad.PostalCode, ad.State, ad.Area, ad.Country, o.orderTotal FROM customer c, sushi s, alacarteorder a, orders o, address ad WHERE c.customerID=o.customerID AND s.sushiID=a.sushiID AND a.orderID=o.orderID AND c.PostalCode = ad.PostalCode AND o.orderStatusID=1 GROUP BY o.orderID";
                $result2 = mysqli_query($conn, $displayCustomerOrder);

                $pdf->Ln();
                $pdf->SetFont('Arial','B',12);
                //Table
                $pdf->Cell(190,8,'Customer Order (On-Delivery)',1,1,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20, 10, 'List generated on: '. $timestamp = date("d M Y H:i:s"), 'C');
                $pdf->SetFont('Arial','B',8);
                $pdf->Ln();
                $pdf->Cell(20,8,'Order ID',1,0,'C');
                $pdf->Cell(30,8,'Customer Name',1,0,'C');
                $pdf->Cell(30,8,'Sushi Name',1,0,'C');
                $pdf->Cell(15,8,'Quantity',1,0,'C');
                $pdf->Cell(65,8,'Address',1,0,'C');
                $pdf->Cell(20,8,'Total (RM)',1,0,'C');
                $pdf->SetFont('ZapfDingbats','', 8);
                $pdf->Cell(10,8,"4",1,0,'C');
                $pdf->Ln();

                $pdf->SetFont('Arial','',8);
                while($row = $result2->fetch_assoc()){
                    $orderID = $row['orderID'];
                    $custName = $row['custName'];
                    $sushiName = $row['sushiName'];
                    $qty = $row['qty'];
                    $address = $row['deliveryAddress'].', '.$row['PostalCode'].' '.$row['Area'].', '.$row['State'].', '.$row['Country'];
                    $price = $row['orderTotal'];
                    $pdf->Cell(20,16,$orderID,1,0,'C');
                    $xPos=$pdf->GetX();
                    $yPos=$pdf->GetY();                    
                    $pdf->MultiCell(30,16,$custName,1);
                    $pdf->SetXY($xPos + 30, $yPos);
                    $xPos=$pdf->GetX();
                    $yPos=$pdf->GetY();
                    $pdf->MultiCell(30,16,$sushiName,1);
                    $pdf->SetXY($xPos + 30, $yPos);
                    $pdf->Cell(15,16,$qty,1,0,'C');
                    $xPos=$pdf->GetX();
                    $yPos=$pdf->GetY();
                    $pdf->MultiCell(65,8,$address,1);
                    $pdf->SetXY($xPos + 65, $yPos);
                    $pdf->Cell(20,16,$price,1,0,'C');
                    $pdf->Cell(10,16,'',1,0,'C');
                    $pdf->Ln();                            
                }


                //Below table
                $pdf->Ln();   
                $pdf->SetFont('Arial','B',12);                    
                $pdf->Cell(40, 20, 'Notes:');
                $pdf->Ln();
                $pdfname = "OnDeliver Order (".date('d M Y').")";                          
                ob_start();
                $pdf->Output($pdfname, 'I');
            }

        ?>
        
    </body>
</html>