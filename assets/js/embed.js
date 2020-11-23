do4me_holder=document.getElementById('do4me');
var sites_urls=document.getElementById('do4me').getAttribute('data-url');

do4me_holder.innerHTML='<object id="do4me_content" style="width:100%; height:101%;" type="text/html" data="'+sites_urls+'" onload="do4medivload()" ></object>';
var normal_height = 2000;

function do4medivload(){
	setInterval(function() {
		var new_page_height = jQuery('#do4me object').contents().find('.d4m-main-wrapper').height()+50;
		if(new_page_height < normal_height){
			jQuery('#do4me').height(normal_height);
		}else{
			jQuery('#do4me').height(new_page_height);
		}
	}, 500);
	
	jQuery('#do4me object').contents().find('.scroll_top_complete').click(function(e){
		jQuery('html, body').animate({scrollTop: 0 }, 1000);
	});
	
	jQuery('#do4me object').contents().find('.d4m-service-embed').click(function(e){
	  jQuery('html, body').stop().animate({'scrollTop': jQuery('#do4me object').contents().find('.d4m-scroll-meth-unit').offset().top}, 800, 'swing', function () {});
	});
}