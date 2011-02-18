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
  
});