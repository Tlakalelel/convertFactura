$(document).ready(function () {
  



    $("#conertirXml").submit(function (e) { 
      e.preventDefault();

      

      const archivoXml = $('#fileXml').prop('files')[0];
      const valArchivoXml = $('#fileXml').prop('files').length;

     
        if ($('#txtNumDoc').val().length==0) {
          // toast.error("Ingrese el número de orden","¡Error!");
            NotifyAlerts("error","Ingrese el número de orden");
          return; 
         }
             
      

      if (valArchivoXml==0) {
        NotifyAlerts("error","Seleccione el XML de su factura");
        return
      }   
      if (archivoXml.type !== 'text/xml') {
        NotifyAlerts("error","El archivo ingresado no pertenece al formato XML");
        return;
      }

      const filePath = 'controllers/file.controller.php';
        
         $.ajax({
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: new FormData(this),
          url: filePath,
          beforeSend: function(e) {
            $("#loading").css("display","flex");
          }
        })
          .done(function (data) {
              console.log(data);
              const json=JSON.parse(data);
              if (json.op=='error1') {
                $("#loading").css("display","none");
                $('#art').html(json.html);
                NotifyAlerts("error",json.text);
              } else if (json.op=='error2') {
                $("#loading").css("display","none");
                $('#art').html(json.html);
                swal({
                  title: json.title,
                  text: json.text,
                  type: "error",
                  button: "Cerrar",
                });
              }else if (json.op=='ok'){
                $("#loading").css("display","none");
                $('#conertirXml').trigger("reset");
                $('#art').html(json.html);
                var $a = $("<a>");
                $a.attr("href",'data:text/plain;charset=utf-8,' + encodeURIComponent(json.file));
                $("body").append($a);
                $a.attr("download",json.nameFile+".txt");
                $a[0].click();
                $a.remove();
              }
              
          })
          .fail(function () {
            alert('El archivo no se pudo cargar');
          });


    });


   
 

    
  
   
});
function NotifyAlerts(tiponotify,mensaje){
      Command: toastr[tiponotify](mensaje);

      toastr.options = {
        closeButton: false,
        debug: false,
        progressBar: false,
        preventDuplicates: false,
        positionClass: "toast-top-right",
        onclick: null,
        showDuration: "400",
        hideDuration: "1000",
        timeOut: "3200",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
      };
  }