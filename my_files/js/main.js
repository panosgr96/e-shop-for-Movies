$(document).ready(function() {
	$('body').addClass('stop-scrolling');
	setTimeout(function(){		
		$('body').addClass('loaded');
		$('.entry-title').fadeOut("slow");
		$('body').addClass('start-scrolling');
	}, 500);	
});