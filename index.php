<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/unify/unify.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="lib/toastr/toastr.css">
    <link rel="stylesheet" type="text/css" href="lib/uicons/css/uicons-regular-rounded.css" />
    <link rel="stylesheet" type="text/css" href="lib/icon-material/material-icons.css">
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
        
        <div class="col-md-12 mt-form">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="hero-image">
                      <div class="hero-text">
                        <img src="https://ak.picdn.net/contributors/3823328/avatars/thumb.jpg?t=164270418" class="logo-hero">
                      </div>
                    </div>
                </div>
                    <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto mb-5">
                           
                                    <div class="card text-center">
                                        <div class="card-header g-bg-sunset g-color-cloud">
                                            <!-- <h3>Convertidor de archivos XML a Excel</h3> -->
                                            <div class="media">
                                              <div class="media-body mr-4 p-2">
                                                <h3 class="h5 g-color-cloud mb-20 text-uppercase roboto g-font-weight-600">Convertidor de archivos</h3>
                                                <p class="text-uppercase roboto g-font-weight-600">XML a Excel</p>
                                              </div>
                                              <div class="d-flex">
                                                <span class="u-icon-v2 g-color-sunset g-bg-cloud rounded-circle">
                                                  <i class="material-icons">import_export</i>
                                                </span>
                                              </div>
                                            </div>
                                        </div>
                                        <form id="conertirXml">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="roboto g-font-weight-600">ACCC</label>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                                                            <label class="u-check">
                                                                                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="flexRadioDefault" id="flexRadioDefault11" value="Subir" type="radio" checked="">
                                                                                <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked rounded-0"><i class="material-icons g-font-size-18 g-right-5">file_upload</i>Subir pedido</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                                                            <label class="u-check">
                                                                                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="flexRadioDefault" id="flexRadioDefault12" value="Cerrar" type="radio">
                                                                                <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked rounded-0"><i class="material-icons g-font-size-18 g-right-5">check</i>Cerrar pedido</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-md-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault11" value="Subir">
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                          Subir pedido
                                                                        </label>
                                                                    </div>
                                                                </div> -->
                                                                <!-- <div class="col-md-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault12" value="Cerrar">
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                          Cerrar pedido
                                                                        </label>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 form-group nO">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p align="left" class="roboto g-font-weight-600">Número de orden</p>
                                                                    <div class="input-group g-brd-primary--focus">
                                                                      <div class="input-group-prepend">
                                                                        <span class="input-group-text rounded-0 g-bg-white g-color-gray-light-v1"><i class="material-icons">chrome_reader_mode</i></span>
                                                                      </div>
                                                                      <input class="form-control form-control-md rounded-0" id="txtNumDoc" name="txtNumDoc" type="text" placeholder="Agregue número de orden">
                                                                    </div>
                                                                    <!-- <input type="number" id="txtNumDoc" name="txtNumDoc" class="form-control"> -->
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-8 form-group ">
                                                            <label class="roboto g-font-weight-600">Seleccionar archivo xml</label>
                                                            <input type="file" name="fileXml" id="fileXml" accept="text/xml" class="btn">
                                                        </div>
                                                    </div>
                                                    <div class="mt-5">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <button type="submit" class="btn btn-block g-rounded-5 u-btn-outline-blue u-btn-hover-v1-1 mb-2">
                                                                        <i class="material-icons g-font-size-18">description</i>
                                                                        Archivo de texto
                                                                    </button> 
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <button type="button" class="btn btn-block u-btn-outline-cyan u-btn-hover-v1-3 g-rounded-5" id="btnExcel">
                                                                        <i class="material-icons g-font-size-18">web</i>
                                                                        Archivo Excel
                                                                    </button>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   
                                        </form>  
                                    </div>
                              
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-5 col-xl-5 mr-auto mb-5">
                            <div class="card text-center">
                                    <div class="card-header g-bg-mirror">   
                                            <!-- <h3>Artículos no registrados</h3> -->
                                            <div class="media">
                                              <div class="media-body mr-4 p-2">
                                                <h3 class="h5 g-color-cloud mb-20 text-uppercase roboto g-font-weight-600">Articulos no registrados</h3>
                                              </div>
                                              <div class="d-flex">
                                                <span class="u-icon-v2 g-color-mirror g-bg-cloud rounded-circle">
                                                  <i class="material-icons">widgets</i>
                                                </span>
                                              </div>
                                            </div>
                                    </div>
                                    <div class="card-body" id="art">
                                        <div class="u-shadow-v19 g-bg-white g-pa-30">
                                          <div class="media g-mb-15">
                                            <div class="d-flex mr-4">
                                              <span class="g-color-gray-dark-v3 g-font-size-26">
                                                <i class="material-icons">view_agenda</i>
                                              </span>
                                            </div>
                                            <div class="media-body">
                                              <h3 class="h4 g-color-mirror roboto g-font-weight-600 mb-20">0 articulos agregados</h3>
                                              <!-- <div class="g-width-300 g-brd-bottom g-brd-gray-dark-v3 "></div> -->
                                              <p class="g-color-gray-dark-v4 g-mb-0 roboto g-font-weight-600">Aún no se ha registrado ningun articulo</p>
                                            </div>
                                          </div>
                                        </div>    
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
    <script src="js/fileAjax.js"></script>
    
   
</body>
</html>