<?php

require_once "../extensiones/Excel/functions/excel.php";
require_once "../models/articulos.model.php";
class XMLEXCEL
{
    private $nameFile=null;
    private $nameSrc=null;
    private $numberOrder=null;
    private $proveedores=null;    
    private $proveedor=null;
    private $listaArticulos=null;
    private $listaNoArticulos=null;
    private $folio=null;
    private $objArticulos=null;
    private $ex=null;
    private $fecha=null;

    function __construct() {
     $this->nameFile="";
     $this->nameSrc="../assets/xml/";
     $this->numberOrder=0; 
     $this->provedores='{"THE791105HP2":"P000001","MTM050621GW8":"P000010"}';
     $this->listaArticulos=array();
     $this->listaNoArticulos=array();
     $this->folio="";
     $this->objArticulos=new ArticuloModel();
     $this->ex="fasle";
     $this->fecha="";
    }

    public function setNumberOrder($numberOrder)
    {
         $this->numberOrder=$numberOrder;
    }

    public function subirArchivoXml()
    {   
        $htmlArN='';     
            $this->nameFile = $_FILES["fileXml"]["name"];
                if(move_uploaded_file($_FILES["fileXml"]["tmp_name"],$this->nameSrc.$this->nameFile)){
                    if ($this->objArticulos->verifySB1()!="off") {
                      $this->prt("SPB0");
                    }else if ($this->objArticulos->verify()!="off") {
                      $this->prt("SQLS");      
                    } else {
                      
                      $json=array(
                                'op' => 'error2',
                                'title'=> '¡Error!',
                                'text'=> 'No se estableció la conexión a la base de datos',
                                'html'=>'<p>0 Articulos</p>'
                            );
                      unlink($this->nameSrc.$this->nameFile);
                            die(json_encode($json));
                    }
                    
                    
                }else{
                    $json=array(
                        'op' => 'error2',
                        'title'=> '¡Error!',
                        'text'=> 'No se completó correctamente la subida del archivo intente nuevamente',
                        'html'=>'<p>0 Articulos</p>'
                    );
                    die(json_encode($json));
                }
            
        
    }

    public function prt($value)
    {
       $this->leerArchivoXml($value);
                        if ($this->proveedor!=NULL) {
                          if (count($this->listaNoArticulos)==0) {
                                if (isset($_POST['prueba'])) {
                                   $this->exportarArchivoExl();
                                }else{
                                    $this->exportarTxt();
                                }
                              
                              
                            }else{
  
                              foreach ($this->listaNoArticulos as $row) {
                                $htmlArN.='<li>'.$row['NoId'].'-'.$row['Desc'].'</li>';
                              }
                              $json=array(
                                  'op' => 'error2',
                                  'title'=> '¡Error!',
                                  'text'=> 'Artículos no registrados favor de comunicarse con sistemas',
                                  'html'=>$htmlArN
                              );
                              unlink($this->nameSrc.$this->nameFile);
                              die(json_encode($json));
                          }
                        } else {
                          
                          $json=array(
                                'op' => 'error2',
                                'title'=> '¡Error!',
                                'text'=> 'El proveedor de la factura no se encuentra registrado favor de comunicarse con sistemas',
                                'html'=>'<p>0 Articulos</p>'
                            );
                          unlink($this->nameSrc.$this->nameFile);
                            die(json_encode($json));
                        }
    }

    public function leerArchivoXml($db)
    {
        $i=0;
        $xml = simplexml_load_file($this->nameSrc.$this->nameFile); 
        $ns = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('c', $ns['cfdi']);
        $xml->registerXPathNamespace('t', $ns['tfd']);
        
        foreach ($xml->xpath('//cfdi:Emisor') as $cfdiEmisor){
            $objProv=json_decode($this->provedores);
            $this->proveedor= !isset($objProv->{$cfdiEmisor['Rfc']}) ? NULL:$objProv->{$cfdiEmisor['Rfc']};
            // echo $this->proveedor;
            
        }
        foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiEmisor){
            $this->folio=$cfdiEmisor['Folio'];
            $this->fecha=date("Ymd",strtotime($cfdiEmisor['Fecha']));


        }
        
        foreach ($xml->xpath('//cfdi:Conceptos//cfdi:Concepto') as $cfdiConcepto){
        $clave="";
        // echo '<p>'.$cfdiConcepto['NoIdentificacion'].'</p>';
        $this->objArticulos->setNoIdentificardor($cfdiConcepto['NoIdentificacion']);
              if ($db=="SQLS") {
                $this->objArticulos->buscarArticulo();
              }else{
                $this->objArticulos->buscarArticuloSap();
              }

              
              $this->ex="true";
              $clave=$this->objArticulos->getClaveArticulo()!=NULL ? $this->objArticulos->getClaveArticulo():"00000";
        // echo '<p>'.$this->objArticulos->getClaveArticulo().'</p>'; 
              if ($clave=="00000") {
                $this->listaNoArticulos[]=array(
                  "NoId"=>$cfdiConcepto['NoIdentificacion'],
                  "Desc"=>$cfdiConcepto['Descripcion']
                );
                $i++;
              }
                // echo "<p>".$clave."</p>";

              $this->listaArticulos[]=array(
                  "Prov"=>$this->proveedor,
                  "NoId"=>$cfdiConcepto['NoIdentificacion'],
                  "ClAr"=>$clave,
                  "Desc"=>$cfdiConcepto['Descripcion'],
                  "UnMe"=>$cfdiConcepto['Unidad'],
                  "Unid"=>$cfdiConcepto['Cantidad'],
                  "PreU"=>$cfdiConcepto['ValorUnitario'],
                  "Decu"=>$cfdiConcepto['Descuento'],
                  "Impr"=>$cfdiConcepto['Importe'],
                  "Foli"=>$this->folio,
                  "Fech"=>$this->fecha,
                  "Orde"=>"1",
                  "NumO"=>$this->numberOrder
              );
        
        
        
        }
       return $i;
    }

    public function probarArray()
    {
        foreach ($this->listaArticulos as $key => $value) {
            echo $value['Prov'].'<br>';
            echo $value['NoId'].'<br>';
            echo $value['Desc'].'<br>';
            echo $value['UnMe'].'<br>';
            echo $value['Unid'].'<br>';
            echo $value['PreU'].'<br>';
            echo $value['Impr'].'<br>';
            echo $value['Foli'].'<br>';
            echo $value['Orde'].'<br>';
            echo "////////////////////////////////////////////";
        }
    }

    public function exportarArchivoExl()
    {
        require_once "../extensiones/PHPEXCEL/Classes/PHPExcel.php";
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("A")
               ->setLastModifiedBy("B")
               ->setTitle("C")
               ->setSubject("D")
               ->setCategory("E");

        // $objPHPExcel->getDefaultStyle()->getFont()->setName('Graphik Regular')
        //                                           ->setSize(10);            
            
            
            
            
        $objPHPExcel->setActiveSheetIndex(0);  
        $objPHPExcel->getActiveSheet()->setTitle("Hoja 1");
            
            
                          $objPHPExcel->setActiveSheetIndex(0)
                          ->setCellValue('A1', 'Clave')
                          ->setCellValue('B1', 'Unidades')
                          ->setCellValue('C1', 'Precio Unitario')
                          ->setCellValue('D1' ,'Descuento');

                          // ->setCellValue('A1', 'Proveedor')
                          // ->setCellValue('B1', 'NoIdentificador')
                          // ->setCellValue('C1', 'Clave')
                          // ->setCellValue('D1', 'Descripcion')
                          // ->setCellValue('E1', 'U,M')
                          // ->setCellValue('F1', 'Unidades')
                          // ->setCellValue('G1', 'Precio Unitario')
                          // ->setCellValue('H1' ,'Descuento')
                          // ->setCellValue('I1', 'Importe')
                          // ->setCellValue('J1', 'Folio')
                          // ->setCellValue('K1', 'Fecha')
                          // ->setCellValue('L1', 'Orden')
                          // ->setCellValue('M1', 'Orden de compra');


                  
                          
            $i=2;           
            foreach ($this->listaArticulos as $key => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A$i", $value['ClAr'])
                    ->setCellValue("B$i", $value['Unid'])
                    ->setCellValue("C$i", $value['PreU'])
                    ->setCellValue("D$i", $value['Decu']);         

                    // ->setCellValue("A$i", $value['Prov'])
                    // ->setCellValueExplicit("B$i", $value['NoId'], PHPExcel_Cell_DataType::TYPE_STRING)
                    // ->setCellValue("C$i", $value['ClAr'])
                    // ->setCellValue("D$i", $value['Desc'])
                    // ->setCellValue("E$i", $value['UnMe'])
                    // ->setCellValue("F$i", $value['Unid'])
                    // ->setCellValue("G$i", $value['PreU'])
                    // ->setCellValue("H$i", $value['Decu'])
                    // ->setCellValue("I$i", $value['Impr'])
                    // ->setCellValue("J$i", $value['Foli']) 
                    // ->setCellValue("K$i", $value['Fech']) 
                    // ->setCellValue("L$i", $value['Orde'])  
                    // ->setCellValue("M$i", $value['NumO']);

                    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                    // $objPHPExcel->getActiveSheet()->getCellByColumnAndRow('B',$i)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING);
                    // $objPHPExcel->getActiveSheet()
                    //             ->getStyle('B'.$i)
                    //             ->getNumberFormat()
                    //             ->setFormatCode(PHPExcel_Cell_DataType::TYPE_STRING);

                                         
                    $i++;

                   
                }
            
          

        // foreach

        $objPHPExcel->createSheet();
        getHeaders($this->nameFile);
        ob_start();        

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$this->nameFile.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        $objWriter->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();

        $response =  array(
                'op' => 'ok',
                'nameFile'=>$this->nameFile,
                'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
        );
        unlink($this->nameSrc.$this->nameFile);
        die(json_encode($response));
        // return "hola";



    }
    public function exportarTxt()
    {
        $contenido="Proveedor\tNoIdentificador\tClave\tDescripcion\tU.M\tUnidades\tPrecio Unitario\tDescuento\tImporte\tFolio\tFecha\tOrden\tOrden de compra\n";

            foreach ($this->listaArticulos as $key => $value) {
              
                $contenido.=$value['Prov']."\t".$value['NoId']."\t".str_replace(".0","",$value['ClAr'])."\t".str_replace("'","",$value['Desc'])."\t".$value['UnMe']."\t".str_replace(".000","",$value['Unid'])."\t".$value['PreU']."\t".$value['Decu']."\t".$value['Impr']."\t".$value['Foli']."\t".$value['Fech']."\t".$value['Orde']."\t".$value['NumO']."\n";
            }
        
        

            $response =  array(
             'op' => 'ok',
             'nameFile'=>$this->nameFile,
             'file' => $contenido,
             'html'=>'<p>0 Articulos</p>'
             );
            unlink($this->nameSrc.$this->nameFile);
        die(json_encode($response));
    }
}

$formatos_permitidos =  array('text/xml');
$res=array("Subir","Cerrar");    

    if (!isset($_POST['flexRadioDefault'])) {
        $json=array(
            'op' => 'error1',
            'title'=> '¡Error!',
            'text'=> 'Seleccione '
        );
        die(json_encode($json));
    }elseif (!in_array($_POST['flexRadioDefault'],$res)) {
        $json=array(
            'op' => 'error2',
            'title'=> '¡Error!',
            'text'=> '',
            'html'=>'<p>0 Articulos</p>'
        );
        die(json_encode($json));
    }else{
        if ($_POST['flexRadioDefault']=="Cerrar") {
            if (empty($_POST['txtNumDoc'])) {
                $json=array(
                    'op' => 'error1',
                    'title'=> '¡Error!',
                    'text'=> 'Ingrese el número de orden'
                );
                die(json_encode($json));
            } elseif (count($_FILES["fileXml"])==0) {
                $json=array(
                    'op' => 'error1',
                    'title'=> '¡Error!',
                    'text'=> 'Seleccione el XML de su factura'
                );
                die(json_encode($json));
            } else {
                
                if (!in_array($_FILES['fileXml']['type'],$formatos_permitidos)) {
                    $json=array(
                        'op' => 'error1',
                        'title'=> '¡Error!',
                        'text'=> 'El archivo ingresado no pertenece al formato XML'
        
                    );
                    die(json_encode($json)); 
                } else {
                    $objXE=new XMLEXCEL();
                    $objXE->setNumberOrder($_POST['txtNumDoc']);
                    $objXE->subirArchivoXml();
                }
            }
        }else{
            if (count($_FILES["fileXml"])==0) {
                $json=array(
                    'op' => 'error1',
                    'title'=> '¡Error!',
                    'text'=> 'Seleccione el XML de su factura'
                );
                die(json_encode($json));
            } else {
                
                if (!in_array($_FILES['fileXml']['type'],$formatos_permitidos)) {
                    $json=array(
                        'op' => 'error1',
                        'title'=> '¡Error!',
                        'text'=> 'El archivo ingresado no pertenece al formato XML'
        
                    );
                    die(json_encode($json)); 
                } else {
                    $objXE=new XMLEXCEL();
                    $objXE->setNumberOrder("11");
                    $objXE->subirArchivoXml();
                }
            }
        }
    }

// if (empty($_POST['txtNumDoc'])) {
//                 $json=array(
//                     'op' => 'error1',
//                     'title'=> '¡Error!',
//                     'text'=> 'Ingrese el número de orden'
//                 );
//                 die(json_encode($json));
//             } elseif (count($_FILES)==0) {
//                 $json=array(
//                     'op' => 'error1',
//                     'title'=> '¡Error!',
//                     'text'=> 'Seleccione el XML de su factura'
//                 );
//                 die(json_encode($json));
//             } else {
                
//                 if (!in_array($_FILES['fileXml']['type'],$formatos_permitidos)) {
//                     $json=array(
//                         'op' => 'error1',
//                         'title'=> '¡Error!',
//                         'text'=> 'El archivo ingresado no pertenece al formato XML'
        
//                     );
//                     die(json_encode($json)); 
//                 } else {
//                     $objXE=new XMLEXCEL();
//                     $objXE->setNumberOrder($_POST['txtNumDoc']);
//                     $objXE->subirArchivoXml();
//                 }
//             }


    
?>