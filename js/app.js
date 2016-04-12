
/* -------- js/offcanvas-menu.js -------- */ 

menuButton = $('#openMenu');
menuWrapper = $('.menu-wrapper');
mainWrapper = $('.main-wrapper');
wrapperBackground = $('#wrapperBackground');

menuButton.click(function() {
  menuWrapper.attr('id', 'open');
  mainWrapper.attr('id', 'menuOpen');
})

wrapperBackground.click(function() {
  menuWrapper.removeAttr('id', 'open');
  mainWrapper.removeAttr('id', 'menuOpen');
})


/* -------- js/seotool.js -------- */ 

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
     $("#loader").css("display","block");
     $(".loader-text").text("Validerar webbadress");
     $('.loader-text').delay(3000).queue(function(n) {  $(this).text('Analyserar Webbplats'); n(); });
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

/* -------- js/skip-link-focus-fix.js -------- */ 

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();
