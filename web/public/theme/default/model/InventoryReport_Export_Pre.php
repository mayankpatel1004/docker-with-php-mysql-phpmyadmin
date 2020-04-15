<?php
global $theme_path,$theme_url,$cf;
$export_fields = "";
$totalColumns = 0;
$arrExportfields = array();
if(isset($_REQUEST['submit'])){
    unset($_REQUEST['submit']);
}
if(isset($_REQUEST['exportfields']) && $_REQUEST['exportfields'] != "") {
    $export_fields = $_REQUEST['exportfields'];
    $arrExportfields = explode(",",$_REQUEST['exportfields']);
    $totalColumns = count($arrExportfields);
}

if($totalColumns > 0) {
    $objPHPExcel = new PHPExcel;
    $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    $currencyFormat = '#,#0.## \â‚¬;[Red]-#,#0.## \â‚¬';
    $numberFormat = '#,#0.##;[Red]-#,#0.##';
    $objSheet = $objPHPExcel->getActiveSheet();
    $title = "Items";

    $objSheet->setTitle($title);
    $alphabet = array('1' => 'A','2' => 'B','3' => 'C','4' => 'D','5' => 'E','6' => 'F','7' => 'G','8' => 'H','9' => 'I','10' => 'J','11' => 'K','12' => 'L','13' => 'M','14' => 'N','15' => 'O','16' => 'P','17' => 'Q','18' => 'R','19' => 'S','20' => 'T','21' => 'U','22' => 'V','23' => 'W','24' => 'X','25' => 'Y','26' => 'Z');

    $objSheet->getStyle('A1:'.$alphabet[$totalColumns].'1')->getFont()->setBold(true)->setSize(12);
    if(isset($arrExportfields) && !empty($arrExportfields)){
        $counter = 0;
        foreach($arrExportfields as $field) {
            if($field != ''){
                $field = str_replace("_"," ",$field);
                $counter++;
                $objSheet->getCell($alphabet[$counter].'1')->setValue($field);
            }
        }    
    }

    $export_fields = substr($export_fields, 0, -1);
    $sqlQuery = "SELECT $export_fields FROM $table WHERE 1=1 $where_string";
    //echo $sqlQuery;exit;
    $arrData = $cf->getData($sqlQuery);
    //echo "<pre>";print_r($arrData);exit;
    if(isset($arrData) && !empty($arrData)) {
        $dataCounter = 1;  
        foreach($arrData as $data) {
            $dataCounter++;
            $counter = 0;
            foreach($arrExportfields as $field) {
                if($field != ''){
                    $counter++;
                    $objSheet->getCell($alphabet[$counter].$dataCounter)->setValue($data[$field]);
                }
            }
        }
    }


    $filename = ucfirst($title)."-".date('Ymdhis').".xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');
}
?>