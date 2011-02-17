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
	
	$('#sort a').click(function(){
	  var sortName = $(this).attr('data-sort');
	  $items.isotope({ sortBy : sortName });
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
	
	
	  // switches selected class on buttons
	  $('#options').find('.option-set a').click(function(){
	    var $this = $(this);
	
	    // don't proceed if already selected
	    if ( !$this.hasClass('selected') ) {
	      $this.parents('.option-set').find('.selected').removeClass('selected');
	      $this.addClass('selected');
	    }
	
	  });
	
	$(function(){
	  
	  $items.isotope({
	    layoutMode : layout,
	    masonry : {
	      columnWidth: 220
	    },
	    getSortData : {
	      related : function( $elem ) {
	        return $elem.attr('data-related');
	      },
	      width : function( $elem ) {
	        return $elem.width();
	      }
	    }
	  });
	  
	});
  
});