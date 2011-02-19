<?php include "includes/options.php"; ?>
<!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Cameron Little's Feed</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	<link rel="stylesheet" href="css/style.css?v=2">
	<link href='http://fonts.googleapis.com/css?family=Lato:100,light,regular' rel='stylesheet'>

	<!-- <script src="js/libs/modernizr-1.6.min.js"></script> -->
</head>

<body>

<a href="http://github.com/you"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://assets0.github.com/img/30f550e0d38ceb6ef5b81500c64d970b7fb0f028?repo=&url=http%3A%2F%2Fs3.amazonaws.com%2Fgithub%2Fribbons%2Fforkme_right_orange_ff7600.png&path=" alt="Fork me on GitHub"></a>

<div id="container">

  <header>
  	<h1>Cameron Little</h1><h2> &nbsp;-&nbsp; hi! I built this feed thing with PHP and YQL</h2>
  </header>
  
	<div id="main" role="main">
	  <section id="options">
	    <ul id="filter" class="option-set floated clearfix">
	      <li><a href="#show-all" data-filter="*" class="selected">
	      	<img src="img/all.png" alt="show all" title="show all" width="32" height="32" />
	      </a></li>
	      <li><a href="#youtube" data-filter=".youtube">
		      <img src="img/youtube.png" alt="youtube" title="youtube" width="32" height="32" />
	      </a></li>
	      <li><a href="#tweets" data-filter=".tweet">
	        <img src="img/tweet.png" alt="tweets" title="tweets" width="32" height="32" />
	      </a></li>
	      <li><a href="#github" data-filter=".github">
	        <img src="img/github.png" alt="github" title="github" width="32" height="32" />
	      </a></li>
	      <li><a href="#picasa" data-filter=".picasa">
	        <img src="img/picasa.png" alt="picasa" title="picasa" width="32" height="32" />
	      </a></li>
	      <li><a href="#reader" data-filter=".reader">
	        <img src="img/reader.png" alt="reader" title="reader" width="32" height="32" />
	      </a></li>
	      <li><a href="#flickr" data-filter=".flickr">
	        <img src="img/flickr.png" alt="flickr" title="flickr" width="32" height="32" />
	      </a></li>
	      <li><a href="#none" data-filter=".none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
	    </ul>
	  </section>
	
		<ul id="items" class="fitRows clearfix"> 
			<?php include "includes/main.php"; ?>
		</ul>
	</div>
	
	<footer>
		<p>Built by <a href="http://twitter.com/apexskier">Cameron Little</a></p>
		<p>The layout and filtering uses <a href="http://isotope.metafizzy.co/">Isotope</a> by <a href="http://desandro.com">David DeSandro</a> / <a href="http://metafizzy.co">Metafizzy</a> </p>
		<p>Social media icons (except for all items) by <http://www.ormanclark.com/blog/free-vector-social-media-icons/>Orman Clark</p>
	</footer>
</div> <!-- end of #container -->


  
  <script src="js/libs/jquery-1.4.4.min.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script src="js/script.js"></script>
	
	<!-- asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet
       change the UA-XXXXX-X to be your site's ID -->
  <script>
   var _gaq = [['_setAccount', 'UA-18767205-1'], ['_trackPageview']];
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