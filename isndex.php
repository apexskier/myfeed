<!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title></title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	<link rel="stylesheet" href="css/style.css?v=2">
	<!-- <script src="js/libs/modernizr-1.6.min.js"></script> -->
	
</head>

<body>
<div id="container">
	<header>
		<h1>Cameron Little</h1>
	</header>
	
  <section id="options" class="clearfix">
    <div class="option-combo">
      <h2>Filter:</h2>
      <ul id="filter" class="option-set floated clearfix">
        <li><a href="#show-all" data-filter="*" class="selected">show all</a></li>
        <li><a href="#tweets" data-filter=".tweet">tweets</a></li>
        <li><a href="#docs" data-filter=".doc">docs</a></li>
        <li><a href="#demos" data-filter=".demo">demos</a></li>
      </ul>
    </div>
    <div class="option-combo">
      <h2>Sort:</h2>
      <ul id="sort" class="option-set floated clearfix">
        <li><a href="#type" data-sort="original-order" class="selected">original order</a></li>
        <li><a href="#related" data-sort="related">related</a></li>
        <li><a href="#width" data-sort="width">width</a></li>
      </ul>
    </div>
    <div class="option-combo">
      <h2>Layout: </h2>
      <ul id="layouts" class="option-set floated clearfix">
        <li><a href="#fitRows" class="selected">fitRows</a></li>
        <li><a href="#straightDown">straightDown</a></li>
        <li><a href="#masonry">masonry</a></li>
      </ul>
    </div>
  </section>

	<div id="links">
	</div>
	
	<ul id="main">
		<?php include "includes/main.php"; ?>
	</ul>
	
	<footer>
	</footer>
</div> <!-- end of #container -->


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.4.js"%3E%3C/script%3E'))</script>


<!-- scripts concatenated and minified via ant build script-->
<script src="js/plugins.js"></script>
<script src="jquery.isotope.min.js"></script>
<script>

  $list = $('#main');

  $('#filter a').click(function(){
    var filterName = $(this).attr('data-filter');
    $list.isotope({ filter : filterName });
    return false;
  });

  $('#sort a').click(function(){
    var sortName = $(this).attr('data-sort');
    $list.isotope({ sortBy : sortName });
    return false;
  });

  var currentLayout = 'fitRows';

  $('#layouts a').click(function(){
    var layoutName = $(this).attr('href').slice(1);
    $list.removeClass( currentLayout ).addClass( layoutName );
    currentLayout = layoutName;
    $list.isotope({ layoutMode : layoutName });
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
    
    $list.isotope({
      layoutMode : 'fitRows',
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
</script>
<script src="js/script.js"></script>
<!-- end concatenated and minified scripts-->


<!--[if lt IE 7 ]>
<script src="js/libs/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg'); </script>
<![endif]-->


<!-- change the UA-XXXXX-X to be your site's ID -->
<script>
var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
(function(d, t) {
var g = d.createElement(t),
s = d.getElementsByTagName(t)[0];
g.async = true;
g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
s.parentNode.insertBefore(g, s);
})(document, 'script');
</script>

</body>
</html>