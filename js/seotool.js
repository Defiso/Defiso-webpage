'use strict'
var analyze;
var sendReport;

$(document).ready( function(){

  analyze = function(){
    $(".loader-text").text(" ");
    var formvalues = $('form').serializeArray();
    var inputs = {"url" : formvalues[0].value,"keywords": formvalues[1].value.split(" "),"email": formvalues[2].value};
    $('.result').empty();
    var urlInput     =   $("#url-input");
    var keywordInput =   $("#keyword-input");
    var emailInput   =   $("#email-input");

    if(urlInput[0].checkValidity() && keywordInput[0].checkValidity() && emailInput[0].checkValidity()){
    $(".error-text").text("");
     $.ajax({
        method: "POST",
        url: "inc/seotool/analyze.php",
        data: inputs,
        success  : function(data){
          $('.loader-text').text('Skapar Rapport');
           $('.loader-text').delay(3000).queue(function(n) {
            $("#loader").hide();
              $(".result").html(data);
              $('.loader-text').text(' ');
              n();
          });
        },
        error: function(xhr, status, error){
          $("#loader").hide();
      },complete : function(data){
      }
    })
   }else{
      $("#loader").css("display","none");
      $(".loader-text").text(" ");
      var message = "Vänligen fyll i alla fält.";
      if(emailInput[0].checkValidity()){
        message = "Vänligen fyll i en giltig e-postadress";
      }
      $(".error-text").text(message);

   }
  }
});
