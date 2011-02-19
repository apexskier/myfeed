/* Author: Cameron Little

*/
$(document).ready(function(){  
	  
	$items = $('#items');
	var layout = 'masonry';
	
	$('#filter a').click(function(){
	  var filterName = $(this).attr('data-filter');
	  $items.isotope({ filter : filterName });
	  return false;
	});
	
	var currentLayout = layout;
	
	$('#layouts a').click(function(){
	  var layoutName = $(this).attr('href').slice(1);
	  $items.removeClass( currentLayout ).addClass( layoutName );
	  currentLayout = layoutName;
	  $items.isotope({ layoutMode : layoutName });
	  return false;
	});
	
  $items.isotope({
    layoutMode : layout,
    masonry : {
      columnWidth: 220
    }
  });
  
    
  $('.item').hover(
		function() {
			$(this).addClass("hover");
		},
		function() {
			$(this).removeClass("hover");
  	}
  );
  
  $('#options #filter a').click(function(){
  	$('#options #filter a').removeClass('selected');
  	$(this).addClass('selected');
  });
  
});

window.onscroll = function() {
	if( window.XMLHttpRequest ) {
		var top = 100;
		if (document.documentElement.scrollTop > top || self.pageYOffset > top) {
	    $('#options').addClass('scrolleddown');
	    $('#items').addClass('scrolleddown');
		} else if (document.documentElement.scrollTop < top || self.pageYOffset < top) {
	    $('#options').removeClass('scrolleddown');
	    $('#items').removeClass('scrolleddown');
		}
	}
}