$(document).ready(function() {
	$('.carousel').carousel();
  $(".ubicanos iframe").on('load', function(){
        
        console.log('load the iframe')
        $(".ubicanos iframe").contents().find("body .container").css({"width":"100%","padding":"0"});
    });
  
});
