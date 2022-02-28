<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="lib/toastr/toastr.css">
   <style type="text/css">
#art {
        max-height: 400px;
        overflow-y: scroll;
}

</style>

</head>
<body>

<div id="loading"><div class="loader">Loading...</div></div>
    <div class="container-fluid">
        
        <div class="col-md-12 mt-5">
            <div class="row">
                    <div class="col-md-5 ml-auto ">
                           
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Convertidor de archivos XML a Excel</h3>
                                        </div>
                                        <form id="conertirXml">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-8 form-group nO">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="">N° Orden:</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="number" id="txtNumDoc" name="txtNumDoc" class="form-control" placeholder="Ingresa número de orden">
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label for="">Seleccionar archivo xml</label>
                                                            <input type="file" name="fileXml" id="fileXml" accept="text/xml" required>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="col-md-6 mr-auto ml-auto">
                                                                <button type="submit" class="btn btn-success btn-block">Convertir</button>   
                                                        </div>
                                                        
                                                    </div>
                                                </div>   
                                        </form>  
                                    </div>
                              
                    </div>
                    <div class="col-md-5  mr-auto">
                            <div class="card">
                                    <div class="card-header">   
                                            <h3>Artículos no registrados</h3>
                                    </div>
                                    <div class="card-body" id="art">
                                        <p>0 Articulos</p>       
                                        <!-- <ul>    
                                                <li>EST-5P ESTANTE PLASTICO PRETUL DE 5 REPI</li>
                                                <li>EST-5P ESTANTE PLASTICO PRETUL DE 5 REPI</li>
                                                <li>EST-5P ESTANTE PLASTICO PRETUL DE 5 REPI</li>
                                                <li>EST-5P ESTANTE PLASTICO PRETUL DE 5 REPI</li>
                                                <li>EST-5P ESTANTE PLASTICO PRETUL DE 5 REPI</li>
                                                <li>EST-5P ESTANTE PLASTICO PRETUL DE 5 REPI</li>
                                        </ul> --> 
                                    </div>     
                            </div>   
                    </div>   
            </div>
        </div>
          
    </div>
    
        
   
    <script src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/toastr/toastr.js"></script>
    <script src="lib/sweetalert2/sweetalert2.all.js"></script>
    <script src="js/fileAjaxOne.js"></script>
    
   
</body>
</html>