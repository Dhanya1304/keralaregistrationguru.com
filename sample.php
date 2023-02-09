<!DOCTYPE html>
<?php

libxml_use_internal_errors(true);

//include the following 2 files for phpexcel
require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$host = "localhost";
$username = "qhqnpwmy_info_autodocg";
$password = "4DZF%{6hvDQD";

$dbname = "qhqnpwmy_info_autodocg";

//Establish connection to mysql
$conn=mysql_connect($host,$username,$password) or die("Could not connect");
mysql_select_db($dbname,$conn) or die("could not connect database");

//Load file
$path = "Book.xls";
$objPHPExcel = PHPExcel_IOFactory::load($path);

//Loop threw file to get data
$importData = array();
$importXLS = array();
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
$worksheetTitle     = $worksheet->getTitle();
$highestRow         = $worksheet->getHighestRow(); // e.g. 10
$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
$nrColumns = ord($highestColumn) - 64;
echo "<br>The worksheet ".$worksheetTitle." has ";
echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
echo ' and ' . $highestRow . ' row.';

echo '<br>Data: <table border="1"><tr>';

for ($row = 1; $row <= $highestRow; ++ $row) {
    
    echo '<tr>';
    for ($col = 0; $col < $highestColumnIndex; ++ $col) {
        $cell = $worksheet->getCellByColumnAndRow($col, $row);
        $val = $cell->getValue();
        $importData[] = $val;
        //$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
        echo '<td>' . $val . '<br></td>';
    }
    echo '</tr>';
}
echo '</table>';





}

for ($row = 1; $row <= $highestRow; ++ $row) {
    for ($col = 0; $col < $highestColumnIndex; ++ $col) {
        $cell = $worksheet->getCellByColumnAndRow($col, $row);
        $importXLS[$row][] = $cell->getValue();
    }
}


foreach($importXLS as $key => $excel){
    //echo "<pre>";print_r($importXLS);die;
    $document_number = mysql_real_escape_string($excel[0]);
    $document_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($excel[1]));
    $authority_name = mysql_real_escape_string($excel[2]);
    $relevant_number = mysql_real_escape_string($excel[3]);
    $category_name = mysql_real_escape_string($excel[4]);
    $relevant_section = mysql_real_escape_string($excel[5]);
    $sub_section = mysql_real_escape_string($excel[6]);
    $synopsis_english = mysql_real_escape_string($excel[7]);
    $subject_english = mysql_real_escape_string($excel[8]);
//Insert data from file to mysql 
$sql="INSERT INTO wp_form(document_number, document_date, authority_name, relevant_number, category_name, relevant_section, sub_section, synopsis_english, subject_english)
VALUES ('".$document_number . "','" . $document_date . "','" . $authority_name. "','" . $relevant_number. "','" . $category_name. "','" .     $relevant_section. "','" .     $sub_section. "','" .    $synopsis_english. "','" .     $subject_english. "')";

//echo $sql."\n";die;
mysql_query($sql) or die('Invalid query: ' . mysql_error());
}


libxml_use_internal_errors(false);
?>
