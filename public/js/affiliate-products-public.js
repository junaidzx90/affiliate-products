jQuery(function( $ ) {
	'use strict';
    const slider = new JooSlider({
      warpper: '#slider', 
      slider: '.slider_inner', 
      next: '.slider_next', 
      prev: '.slider_prev',
      thumbnails: '.thumbnails',
      thumb: '.thumb',
      speed: 500,
      thumbSize: 5,
      zoomClass: 'zoom',
      closeZoom: '.closeFullscreen'
    });

	$(".product_filter_btn").on("click", function(){
		$(".product_filter_btn").removeClass("active");
		$(this).addClass("active");
		$(".filterbox").removeClass("active");
		$(".filterbox."+$(this).data('filter')).addClass("active");
	});
});
