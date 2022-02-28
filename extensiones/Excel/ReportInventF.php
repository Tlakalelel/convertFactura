<?php 
require_once 'functions/excel.php';
require_once '../../modelos/conexion.php';

activeErrorReporting();
noCli();
$mes=$_POST['mes'];
$anio=$_POST['anio'];

if ($mes == "01") {
      $newMes = "Enero";
    }
    if ($mes == "02") {
      $newMes = "Febrero";
    }
    if ($mes == "03") {
      $newMes = "Marzo";
    }
    if ($mes == "04") {
      $newMes = "Abril";
    }
    if ($mes == "05") {
      $newMes = "Mayo";
    }
    if ($mes == "06") {
      $newMes = "Junio";
    }
    if ($mes == "07") {
      $newMes = "Julio";
    }
    if ($mes == "08") {
      $newMes = "Agosto";
    }
    if ($mes == "09") {
      $newMes = "Septiembre";
    }
    if ($mes == "10") {
      $newMes = "Octubre";
    }
    if ($mes == "11") {
      $newMes = "Noviembre";
    }
    if ($mes == "12") {
      $newMes = "Diciembre";
    }



      $NombreFile="Inventario Financiero ".$newMes." ".$anio;      





require_once 'PHPEXCEL/Classes/PHPExcel.php';
//require_once 'functions/conexion.php';
//require_once 'functions/getAllListsAndVideos.php';

$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("System")
               ->setLastModifiedBy("Oficialia Mayor")
               ->setTitle("Inventario Financiero")
               ->setSubject("Reporte")
               //->setDescription("")
               //->setKeywords("Reporte del Mes")
               ->setCategory("Reporte");

$objPHPExcel->getDefaultStyle()->getFont()->setName('Graphik Regular')
                                          ->setSize(10);            




$objPHPExcel->setActiveSheetIndex(0);  
$objPHPExcel->getActiveSheet()->setTitle("Hoja 1");

    
                  $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'No.')
                  ->setCellValue('B1', 'Código')
                  ->setCellValue('C1', 'Descripción del inmueble')
                  ->setCellValue('D1', 'Valor en libros ')
                  ->setCellValue('E1', 'Fecha registro');      
            
           


$objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$stmt = Conexion::conectar()->prepare("SELECT * FROM invent_finan 
WHERE MONTH(Fecha_Alta)=$mes AND YEAR(Fecha_Alta)=$anio");
$stmt->execute();
$resultado = $stmt->fetchAll();
$numregistros = count($resultado);
$numSe=count($resultado)+2;
$numF=count($resultado)+1;
$contador=0;
$i=2;
$key=1;


foreach ($resultado as $row) {

            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A$i", $key)
            ->setCellValue("B$i", $row['Codigo'])
            ->setCellValue("C$i", $row['Descrip_Inmueb'])
            ->setCellValue("D$i", $row['Valor_lib'])
            ->setCellValue("E$i", $row['Fecha_Alta']);        


            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

/*
            $objPHPExcel->getActiveSheet()->getStyle("F$i")->getNumberFormat()->setFormatCode("#,##0.00");
            $objPHPExcel->getActiveSheet()->getStyle("F$numSe")->getNumberFormat()->setFormatCode("#,##0.00");

            $objPHPExcel->getActiveSheet()->getStyle("G$i")->getNumberFormat()->setFormatCode("$#,##0.00");
            $objPHPExcel->getActiveSheet()->getStyle("G$numSe")->getNumberFormat()->setFormatCode("$#,##0.00");
            
            
            $objPHPExcel->getActiveSheet()->getStyle("H$i")->getNumberFormat()->setFormatCode("$#,##0.00");
            $objPHPExcel->getActiveSheet()->getStyle("H$numSe")->getNumberFormat()->setFormatCode("$#,##0.00");
        
            
            $objPHPExcel->getActiveSheet()->getStyle("I$i")->getNumberFormat()->setFormatCode("$#,##0.00");
            $objPHPExcel->getActiveSheet()->getStyle("I$numSe")->getNumberFormat()->setFormatCode("$#,##0.00");
            $objPHPExcel->getActiveSheet()->getStyle("E$numSe:I$numSe")->getFont()->setBold(true);
           
*/
      $i++;
      $key++;
     

      
}
$objPHPExcel->createSheet();
getHeaders($NombreFile);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;