<?php
define ('K_PATH_IMAGES','');
//============================================================+
// File name   : example_039.php
// Begin       : 2008-10-16
// Last Update : 2014-01-13
//
// Description : Example 039 for TCPDF class
//               HTML justification
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML justification
 * @author Nicola Asuni
 * @since 2008-10-18
 */

//fetch data
// Database Connection
// Check for connection erro
require "config.php";

if (isset($_GET["id"]) && !empty($_GET["id"]))
{
    $dt = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur'));
    $time_stamp = $dt->format('dmYHis');
    $date_will = date("d/m/Y"); //Returns IST
    $cut_date_will=str_replace('/','',$date_will);
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $id = $_GET["id"];
    $will_date = date("Y-m-d");
    $signature_path = 'images/'.$id.".png";

    $update_will_date = "UPDATE will SET will_date='$will_date', will_time=CURRENT_TIMESTAMP WHERE will_id=$id ";

    $select_user = "SELECT * FROM usertable WHERE id=$id";
    $result_user = $con->query($select_user);
    while ($row = $result_user->fetch_object())
    {
        $user_id = $row->id;
        $user_name = $row->name;
        $user_ic = $row->user_ic;
        $user_address = $row->user_address;
    }

    function fetch_data()
    {
        $output = '';
        $connect = mysqli_connect('localhost', 'pyongcom_dems_admin', 'rB+XtWau&4dI', 'pyongcom_demsDB');
        $sql = "SELECT * FROM executor WHERE user_id=$id";
        $result = mysqli_query($connect, $sql);
        while ($row1 = mysqli_fetch_array($result))
        {
            $output .= "<tr>  
                         <td>" . $row1["executor_id"] . "</td>  
                         <td>" . $row1["executor_name"] . "</td>  
                         <td>" . $row1["executor_email"] . "</td>  
                     </tr>  
                          ";
        }
        return $output;
    }

    $select_executor = "SELECT * FROM executor WHERE user_id=$id";
    $result_executor = $con->query($select_executor);
    $tbl_executor_header = '<table border="1" cellspacing="0" cellpadding="5" >  
           <tr>  
                <th width="5%">No.</th>  
                <th width="30%">Name</th>  
                <th width="30%">IC No.</th>  
           </tr> ';
    $tbl_executor_footer = "</table>";
    $tbl_executor= "";

    $sql_executor = mysqli_query($con, "SELECT * FROM executor WHERE user_id=$id");

    while ($row_executor = mysqli_fetch_array($sql_executor))
    {
        $executor_name = $row_executor["executor_name"];
        $executor_ic = $row_executor["executor_ic"];
        $executor_index++;
        $tbl_executor .= '<tr>
        <td>' . $executor_index . '</td>
            <td>' . $executor_name . '</td>
            <td>' . $executor_ic . '</td>
        </tr>';
    }

    $select_beneficiaries = "SELECT * FROM beneficiaries WHERE user_id=$id";
    $result_beneficiaries = $con->query($select_beneficiaries);
    while ($row = $result_beneficiaries->fetch_object())
    {
    }

    $select_digital_asset = "SELECT * FROM digital_asset WHERE user_id=$id";
    $result_digital_asset = $con->query($select_digital_asset);
    $tbl_digital_asset_header = '<table border="1" cellspacing="0" cellpadding="5" >  
           <tr>  
                <th width="5%">No.</th>  
                <th width="30%">Asset Name</th>  
                <th width="30%">Beneficiary</th>
                <th width="30%">Notes</th>  
           </tr> ';
    $tbl_digital_asset_footer = "</table>";
    $tbl_digital_asset= "";

    $sql_digital_asset = mysqli_query($con, "SELECT * FROM digital_asset WHERE user_id=$id");


    while ($row_digital_asset = mysqli_fetch_array($sql_digital_asset))
    {
        
        
        $digital_asset_name = $row_digital_asset["digital_asset_name"];
        $digital_asset_beneficiary = $row_digital_asset["digital_asset_beneficiary"];
        $digital_asset_notes = $row_digital_asset["digital_asset_notes"];
        $digital_asset_index++;
        
        
        //other table
        $sql_beneficiary = mysqli_query($con, "SELECT * FROM beneficiaries WHERE user_id=$id AND beneficiaries_name=$digital_asset_beneficiary");
        while ($row_beneficiary = mysqli_fetch_array($sql_beneficiary)){
        $beneficiaries_ic = $row_beneficiary["beneficiaries_ic"];}
        
        
        $tbl_digital_asset .= '<tr>
            <td>' . $digital_asset_index . '</td>
            <td>' . $digital_asset_name . '</td>
            <td>' . $digital_asset_beneficiary . '</td>
            <td>' . $digital_asset_notes . '</td>
        </tr>';
    }
    

    
}
else
{
    // id does not exits do something
    
}

// Include the main TCPDF library (search for installation path).
require_once "tcpdf/tcpdf.php";

//Extend the TCPDF class to create custom Header and Footer


// create new PDF document
 $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("DEMS");
$pdf->SetTitle("CODICIL TO THE LAST WILL AND TESTAMENT");

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . " CODICIL TO THE LAST WILL AND TESTAMENT", PDF_HEADER_STRING);

$pdf->SetHeaderData("DEMS_Logo.PNG");



// set header and footer fonts
$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, "", PDF_FONT_SIZE_MAIN]);
$pdf->setFooterFont([PDF_FONT_NAME_DATA, "", PDF_FONT_SIZE_DATA]);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . "/lang/eng.php"))
{
    require_once dirname(__FILE__) . "/lang/eng.php";
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// add a page
$pdf->AddPage();

// set font
$pdf->SetFont("helvetica", "B", 20);

$pdf->Write(0, "CODICIL TO THE LAST WILL AND TESTAMENT", "", 0, "L", true, 0, false, false, 0);

// font-size
// font-weight
// font-family
// text-align
// text-transform
// width
// height
// border
$width_cell = [10, 30, 20, 30];

// create some HTML content
$section1 = <<<EOD
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">I, $user_name (IC: $user_ic) with address of $user_address (&ldquo;Testator&rdquo;) create this Codicil to my Last Will on $date_will (&ldquo;Last Will&rdquo;). I hereby republish and declare said Last Will as amended by this Codicil to be my Last Will.&nbsp;</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">In addition, I am adding the following provisions to my original Will:</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">&nbsp;</p>
<p style="font-size:16px; text-align:center; font-weight:bold;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">DIGITAL ASSETS</span></p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">My digital assets shall be distributed in accordance with this Codicil to Will. For the purposes of this Codicil to Will, &ldquo;digital assets&rdquo; includes the following:</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">1.&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Files stored on my digital devices, including but not limited to, desktops, laptops, tablets, peripherals, storage devices, mobile telephones, smartphones, and any similar digital device; and</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">2.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Emails received, email accounts, digital music, digital photographs, digital videos, software licenses, social network accounts, file sharing accounts, financial accounts, banking accounts, domain registrations, DNS service accounts, web hosting accounts, tax preparation service accounts, online stores, affiliate programs, other online accounts, and similar digital items, regardless of the ownership of any physical device upon which the digital item is stored.</p>
EOD;
$section2 = <<<EOD
<p style="font-size:16px; text-align:center; font-weight:bold;">DIGITAL EXECUTOR</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">I APPOINT the following as the Digital Executor. </p>
EOD;
$table1 = <<<EOD
<h1>Student  list</h1>
<table cellspacing="0" cellpadding="1" border="1" style="border-color:gray;">
    <tr style="background-color:green;color:white;">
        <td>SL no</td>
        <td>Name</td>
        <td>Roll No</td>
		<td>City</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Divyasundar</td>
		<td>001</td>
		<td>Pune</td>
    </tr>
	<tr>
        <td>1</td>
        <td>Milan</td>
		<td>002</td>
		<td>Pune</td>
    </tr>
	<tr>
        <td>1</td>
        <td>Hritika</td>
		<td>003</td>
		<td>Pune</td>
    </tr>
</table>
EOD;
$content .= '  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="5%">No.</th>  
                <th width="30%">Name</th>  
                <th width="30%">IC No.</th>  
                
           </tr>  
      ';
$content .= fetch_data();
$content .= '</table>';
$image = '<br>';
$imageURL = 'images/'.$user_id.'.png';
$image .= '<img src="'.$imageURL.'" width="200" />';
$image .= '<br>';
$section3 = <<<EOD
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">For the purposes of this Codicil to Will, Digital Executor shall mean a designated executor assigned to manage the responsibilities for my digital assets after deaths. I direct that my Digital Executors shall have sole responsibility for the administration and distribution of my Digital Assets. Subject to any Memorandum of Digital Assets that I may have prepared, my Digital Executor(s) shall have but not limited to, the power to act on my behalf for the purposes of managing, distributing, accessing and terminating my digital assets, including all rights and powers that I may acquire in the future.</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">&nbsp;</p>
<p style="font-size:16px; text-align:center; font-weight:bold;">BENEFICIARY</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">The beneficiaries, in addition to other powers and authority granted by law or necessary or appropriate for proper administration of the Digital Assets, shall have the following rights, powers, and authority without order of court and without notice to anyone, which may include, but not limited to:</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">A.&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Access Assets. The power to access, obtain, modify, delete, and control my passwords and other electronic credentials associated with my digital devices and digital assets. In addition, my beneficiary may download, and backup digital assets, convert my file formats, access any and all devices necessary to manage digital assets, and clear computer caches and delete files.</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">B.&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Receive Assets. To receive, hold, maintain, administer, collect, invest and re-invest the Digital Assets, and collect and apply the income, profits, and principal of the Digital Assets in accordance with the terms of this instrument.</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">C.&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Standard of Care. To acquire, invest, reinvest, exchange, retain, sell, and manage Digital Assets, exercising the judgement and care, under the circumstances then prevailing, that persons of prudence, discretion and intelligence exercise in the management of their own affairs.</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">&nbsp;</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">If I have prepared a memorandum, which may be altered by me from time to time, with instructions concerning my digital assets and their access, handling, distribution, and disposition, it is my wish that my beneficiaries follow my instructions as outlined in that memorandum.</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">&nbsp;</p>
<p style="font-size:16px; text-align:center; font-weight:bold;">DISTRIBUTION OF DIGITAL ASSETS</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">Upon my death, I GIVE, DEVISE and BEQUEATH fully all my rights, title, interest and benefits in the following asset(s) to the following beneficiary(s) as shown below:</p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>
EOD;
$section4 = <<<EOD
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>
<p style="font-size:16px; text-align:center; font-weight:bold;">SIGNATURE OF TESTATOR</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">I, name. declare that this instrument is my codicil to my last will and testament, that I am of the legal age in this jurisdiction to make a will, that I am under no constraint or undue influence, and that I sign this Will freely and voluntarily.&nbsp;</p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">Testator Signature:</span></p>
EOD;
$section5 = <<<EOD
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">Name: $user_name</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">Date: $date_will</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>
<p style="font-size:16px; text-align:center; font-weight:bold;">SIGNATURE OF WITNESS</p>
<p style="font-size:16px; font-weight:normal; font-family:""; text-align:justify; line-height:115%;">This instrument was signed on the above written date by the abovenamed Testator, name. At the Testator&rsquo;s request, I subscribe my name as witness hereto. I declare under penalty of perjury under the laws of Malaysia that the foregoing is true and correct.</p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">Witness Signature:</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>

<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">Name:</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">Date: $date_will</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">Official Stamp:</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>
<p style="margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;"><span style="font-size:16px;line-height:115%;font-family:"Times New Roman",serif;color:black;">&nbsp;</span></p>
EOD;


// set core font
$pdf->SetFont("helvetica", "", 10);

// output the HTML content

$pdf->writeHTML($section1, true, 0, true, true);
$pdf->writeHTML($section2, true, 0, true, true);
$pdf->writeHTML($tbl_executor_header . $tbl_executor . $tbl_executor_footer, true, false, false, false, "");
// $pdf->writeHTMLCell(50, 0, 50, 50, $tbl_header . $tbl . $tbl_footer, 'LRTB', 1, 0, true, 'L');
$pdf->writeHTML($section3, true, 0, true, true);
// $pdf->writeHTML(
//     $tbl_header . $tbl_asset . $tbl_footer,
//     true,
//     false,
//     false,
//     false,
//     ""
// );
$pdf->writeHTML($tbl_digital_asset_header . $tbl_digital_asset . $tbl_digital_asset_footer, true, false, false, false, "");
$pdf->writeHTML($section4, true, 0, true, true);
$pdf->writeHTML($image, true, 0, true, 0);
$pdf->writeHTML($section5, true, 0, true, true);

$pdf->Ln();

// set UTF-8 Unicode font
$pdf->SetFont("dejavusans", "", 10);

// reset pointer to the last page
$pdf->lastPage();


// ---------------------------------------------------------
//Close and output PDF document
$filename="pdf/$user_ic+_$date_will.pdf";
$pdf->Output($_SERVER['DOCUMENT_ROOT'].'DEMS/pdf/'.$user_ic._.$time_stamp.'.pdf', "F");
$pdf->Output($user_ic._.$time_stamp.'.pdf', "I");

//============================================================+
// END OF FILE
//============================================================+

?>
