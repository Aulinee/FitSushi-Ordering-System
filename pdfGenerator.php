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
        
            if(isset($_POST['Report_CustOrder'])){

                include ('../database/dbConnection.php');
                require('fpdf.php');

                //Header
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(100, 10, 'FitSushi Report',1,1,'L');
                $pdf->Ln();
                $pdf->Cell(100, 6, 'Contact us: 012-3456789',1,1,'L');
                $pdf->Ln();
                $pdf->Cell(100, 6, 'Address: Virtual',1,1,'L');
                $pdf->Ln(); 
                $pdf->Ln(); 
                $pdf->Cell(20, 10, 'Report generated on: '. $timestamp = date("Y-m-d H:i:s"), 'C');
                $pdf->Ln();

                $thismonth = date('m');
                $thisyear = date('Y');
                $nextmonth = $thismonth+1;    
                // Select data from MySQL database
                $select = "SELECT Subs, Price, Expiry FROM InvoiceData WHERE Username='$Username' AND MONTH(Expiry)='$nextmonth' AND YEAR(Expiry)='$thisyear'";
                $resultselect = mysqli_query($DBConnect, $select);
             
                //Select InvoiceID
                $sqlgetInvID = "SELECT InvoiceID FROM InvoiceData WHERE Username='$Username' AND MONTH(Expiry)='$nextmonth' AND YEAR(Expiry)='$thisyear'";
                $resultgetInvID = mysqli_query($DBConnect, $sqlgetInvID);   
                        
                $getInvID = mysqli_fetch_assoc($resultgetInvID);    
                $InvID = $getInvID['InvoiceID'];    

                $pdf->Ln();
                $pdf->Ln();

                //Table
                $pdf->Cell(55,10,'Subscription',1);
                $pdf->Cell(40,10,'Price',1);
                $pdf->Cell(30,10,'Valid Until',1);
                $pdf->Ln();
                while($row = $resultselect->fetch_assoc()){
                    $Subs = $row['Subs'];
                    $SubsPrice = $row['Price'];
                    $Expiry = $row['Expiry'];
                    $pdf->Cell(55,10,$Subs,1);
                    $pdf->Cell(40,10,$SubsPrice,1);
                    $pdf->Cell(30,10,$Expiry,1);
                    $pdf->Ln();
                }
            
                //Below table
                $pdf->Ln();                       
                $pdf->Cell(40, 20, 'Please keep this receipt as your and our future reference, just in case.');
                $pdf->Ln();                       
                $pdf->Cell(40, 5, 'Thank you for your purchase.');                
                $pdf->Ln();                       
                $pdf->Cell(40, 20, 'Note: This is a computer generated receipt, hence no signature required.');    
                ob_start();
                $pdf->Output();
            
                $_SESSION['transactionCompleted'] = 'Yes';
                $DBConnect->close();
 
            }
            elseif(isset($_POST['Report_Order'])){
                
                $SingleSum = $_POST['SumSingle'];
                $MultiSum = $_POST['SumMulti'];
                $AmountSingle = ($SingleSum/17);  //Exact subscriber for Premium Single
                $AmountMulti = ($MultiSum/39); //Exact subscriber for Premium Multi
                
                echo 'Single: '.$SingleSum.'<br>';
                echo 'Multi: '.$MultiSum.'<br>';
                
                include ('DatabaseConn.php');
                require('fpdf.php');

                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(100, 10, 'TMFlix Monthly Income Report',1,1,'L');
                $pdf->Ln();
                $pdf->Cell(100, 6, 'Contact us: 012-3456789',1,1,'L');
                $pdf->Ln();
                $pdf->Cell(100, 6, 'Address: Virtual',1,1,'L');
                $pdf->Ln(); 
                $pdf->Ln(); 
                $pdf->Cell(20, 10, 'Report generated on: '. $timestamp = date("Y-m-d H:i:s"), 'C');
                $pdf->Ln();
                $pdf->Cell(55,10,'Subscription',1);
                $pdf->Cell(55,10,'Total Subscriber(s)',1);
                $pdf->Cell(55,10,'Total Income (RM)',1);
                $pdf->Ln();
                
                //Premium Single Row
                $pdf->Cell(55,10,'Premium Single',1);
                $pdf->Cell(55,10,$AmountSingle,1);
                $pdf->Cell(55,10,$SingleSum,1);
                $pdf->Ln();
                
                //Premium Multiple Row
                $pdf->Cell(55,10,'Premium Multiple',1);
                $pdf->Cell(55,10,$AmountMulti,1);
                $pdf->Cell(55,10,$MultiSum,1);
                $pdf->Ln();

                $pdf->Cell(165,10,'Sum Total = RM '.($SingleSum+$MultiSum),1);                
                

                $pdf->Ln();                       
                $pdf->Cell(40, 20, 'Please keep this monthly income report for future use.');
                $pdf->Ln();                       
                $pdf->Cell(40, 5, 'Thank you.');                
                $pdf->Ln();                       
                $pdf->Cell(40, 20, 'Note: This is a computer generated report, hence no signature required.');    
                ob_start();
                $pdf->Output();

                $DBConnect->close();
 
            }

        ?>
        
    </body>
</html>