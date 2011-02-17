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

  <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	<link rel="stylesheet" href="css/style.css?v=2">

	<!-- <script src="js/libs/modernizr-1.6.min.js"></script> -->
</head>




<body>
<div id="container">
  
  <h1>Isotope</h1>
  
  <section id="options" class="clearfix">
    <div class="option-combo">
      <h2>Filter:</h2>
      <ul id="filter" class="option-set floated clearfix">
        <li><a href="#show-all" data-filter="*" class="selected">show all</a></li>
        <li><a href="#youtube" data-filter=".youtube">youtube</a></li>
        <li><a href="#tweets" data-filter=".tweet">tweets</a></li>
        <li><a href="#github" data-filter=".github">github</a></li>
        <li><a href="#none" data-filter=".none">none</a></li>
      </ul>
    </div>
    <div class="option-combo">
      <h2>Sort:</h2>
      <ul id="sort" class="option-set floated clearfix">
        <li><a href="#type" data-sort="original-order" class="selected">original order</a></li>
        <li><a href="#postdate" data-sort="postdate">post date</a></li>
        <li><a href="#width" data-sort="width">width</a></li>
      </ul>
    </div>
    <div class="option-combo">
      <h2>Layout: </h2>
      <ul id="layouts" class="option-set floated clearfix">
        <li><a href="#fitRows" class="selected">fitRows</a></li>
        <li><a href="#masonry">masonry</a></li>
      </ul>
    </div>
  </section>
	
	<div id="main" role="main">
		<ul id="items" class="fitRows clearfix"> 
			<?php include "includes/main.php"; ?>
		</ul>
	</div>
	
	<footer>
	</footer>
</div> <!-- end of #container -->

  
  
  <script src="js/libs/jquery-1.4.4.min.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script src="js/script.js"></script>


</body>
</html>