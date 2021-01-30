/* window.onload = function () {
     $('#nav_image_return').children('img').click(function(){
			window.location.replace("http://localhost/Pronunciation_English");
	});
   }*/

/*		alert("jquery,,,,,,,,,,,,,,.");
		$('.one_row_table_vocabulary').css({"color":"red"});
		$(this).mouseleave(function(){
		$('.one_row_table_vocabulary').css({"color":"#fff"});
	});*/


  function click_return_main()
  {
    window.location.replace("http://localhost/Pronunciation_English_2/view/main.html");
  }

function enableAutoplay() { 
  var x = document.getElementById("myAudio");
  x.autoplay = true;
  x.load();
}

// window.onload = animation_translate();

  function animation_translate()
  {
    
     setTimeout(function() { 
       /*$('.nav_content_translate').css({"display":"none"});*/
       $('.nav_content_translate').css({"border":"1px dotted blue"});
    }, 900);   
      setTimeout(function() { 
      $('.nav_content_translate').css({"border":"1px ridge #00ffbf"});
      /*$('.nav_content_translate').css({"display":"block"});*/
      animation_translate();
    }, 3000);

      

        /*$('.nav_content_translate').css({"font-size": i+"%"});*/
        
        
        
      
  }



