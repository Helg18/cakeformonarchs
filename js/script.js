
jQuery(document).ready(function(){
	var wh = jQuery(window).height();
	var ww = jQuery(window).width();
	// Use Full Width for Background in header
	
	jQuery('.header').height(wh);

	if(ww < 737 && ww > 500){
		jQuery('.logo-wrapper').css('margin-top','50px');
	}else{
		jQuery('.logo-wrapper').css('margin-top',(wh/3));
	}

	    if ( document.location.href.indexOf('shop') > -1 ) {
	        
	    }else{
	    	jQuery('#size-chart-btn').hide();
	    }
});

jQuery(window).resize(function(){
	var wh = jQuery(window).height();
	var ww = jQuery(window).width();
	jQuery('.header').height(wh);

	if(ww < 737 && ww > 500){
		jQuery('.logo-wrapper').css('margin-top','50px');
	}else{
		jQuery('.logo-wrapper').css('margin-top',(wh/3));
	}
});





