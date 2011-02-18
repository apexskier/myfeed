<?php

/*
 * Set these variables.
 */
// youtube username
$youtube      = 'camapexskier';
// twitter handle
$twitter      = 'apexskier';
// github username
$github       = 'apexskier';
// google username
$google       = 'apxskier';
// date format
$date_format  = 'g:i A M jS';
// number of weeks to display
$numweeks     = 2;

/*
 * My Feed
 * 
 * @version	0.5
 * @author	Cameron Little
 * @link	none, currently
 * 
 * Notes:
 * --
 * 
 * Credits/Inspiration:
 * Hashtag/username parsing based on: http://snipplr.com/view/16221/get-twitter-tweets/
 * Feed caching: http://www.addedbytes.com/articles/caching-output-in-php/
 * Feed parsing: http://boagworld.com/forum/comments.php?DiscussionID=4639
 *
 * Twitter and github replacing strings: http://f6design.com/journal/2010/10/07/display-recent-twitter-tweets-using-php/
 * YQL stuff: http://net.tutsplus.com/tutorials/javascript-ajax/how-to-build-an-rss-reader-with-jquery-mobile-2/
 */

// master array to store data for each item in.
$itemArray = array();
// human readable keys for template keys
$timevarArray = 0;
$titleArray = 1;
$contentArray = 2;
$sourceArray = 3;
$displaytimeArray = 4;
$directlinkArray = 5;
$classesArray = 6;

$current_time = time();
             // s    m    h    d   w
$timespan     = 60 * 60 * 24 * 7 * $numweeks;
$start_path   = "http://query.yahooapis.com/v1/public/yql?q=";
$end_path     = "&format=json";

// I want to include something from promotejs.com - hence the following added item
$itemArray[]  = array (
		// random unix datetime from the past $numweeks
		rand($current_time - $timespan, $current_time),
		'Promote JS!',
		"<a href='https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/RegExp' title='JS RegExp .source'><img src='http://static.jsconf.us/promotejsh.gif' height='150' width='180' alt='JS RegExp .source'/></a>
",
		'promotejs',
		null,
		'https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/RegExp',
		'promotejs'
	);


$yt_path = $start_path . urlencode("SELECT * FROM feed WHERE url='http://gdata.youtube.com/feeds/base/users/$youtube/uploads'") . $end_path;
$yt_feed = json_decode(file_get_contents($yt_path, true));

foreach ($yt_feed->query->results->entry as $item) {
	$unixtime = strtotime($item->published);
	// stop if items are older than set timeframe
	if ( ($current_time - $unixtime) > $timespan) {
		break;
	}
	
	$content = "<iframe title='YouTube video player' width='400' height='225' src='http://www.youtube.com/embed/";
	$content .= str_replace("&feature=youtube_gdata", "", str_replace("http://www.youtube.com/watch?v=", "", $item->link[0]->href));
	$content .= "?hd=1' frameborder='0' allowfullscreen></iframe>";

	// Add each item to the master array
	$itemArray[] = array
		(
			$unixtime,
			$item->title->content,
			$content,
			'youtube',
			date($date_format, $unixtime),
			$item->link[0]->href,
			'youtube'
		);
}


$gh_path = $start_path . urlencode("SELECT * FROM feed WHERE url='https://github.com/$github.atom'") . $end_path;
$gh_feed = json_decode(file_get_contents($gh_path, true));

foreach ($gh_feed->query->results->entry as $item) {
	$unixtime = strtotime($item->published);
	// stop if items are older than set timeframe
	if ( ($current_time - $unixtime) > $timespan) {
		break;
	}
	
	$title = $item->title;
	// Strip $github username from the beginning of the title
	$title = substr($title, strlen("$github "));

	$content = $item->content->content;
	// Add hyperlink html tags to any urls, twitter ids or hashtags in the tweet.
	$content = preg_replace('/(<a href=")/', '<a href="https://github.com', $content);
	$content = preg_replace('/(^|[\n\s])@([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/$2">@$2</a>', $content);
	$content = preg_replace('/(^|[\n\s])#([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/search?q=%23$2">#$2</a>', $content);

	// Add each item to the master array
	$itemArray[] = array
		(
			$unixtime,
			null,
			$title . $content,
			'github',
			date($date_format, $unixtime),
			$item->link->href,
			'github'
		);
}


$tw_path = $start_path . urlencode("SELECT * FROM feed WHERE url='http://twitter.com/statuses/user_timeline/$twitter.rss'") . $end_path;
$tw_feed = json_decode(file_get_contents($tw_path, true));

foreach ($tw_feed->query->results->item as $tweet) {
	$content = $tweet->description;	
	// Stript Twitter username, "e.g. User name: Blah" from tweet.
	$content = substr($content, strpos($content, ":")+2);
	$content = htmlspecialchars($content);
	
	// Make youtube uploads not show in Twitter
	if (!strpos($content, 'uploaded') && !strpos($content, 'YouTube')) {
		$unixtime = strtotime($tweet->pubDate);
		// stop if items are older than set timeframe
		if ( ($current_time - $unixtime) > $timespan) {
			break;
		}
	
		$content = $tweet->description;	
		// Stript Twitter username, "e.g. User name: Blah" from tweet.
		$content = substr($content, strpos($content, ":")+2);
		$content = htmlspecialchars($content);
	
		$first_char = substr($content, 0, 1);
		$firsttwo_char = substr($content, 0, 2);
	
		// Add hyperlink html tags to any urls, twitter ids or hashtags in the tweet.
		$content = preg_replace('/(https?:\/\/[^\s"<>]+)/','<a href="$1">$1</a>',$content);
		$content = preg_replace('/(^|[\n\s])@([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/$2">@$2</a>', $content);
		$content = preg_replace('/(^|[\n\s])#([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/search?q=%23$2">#$2</a>', $content);
		
		$classes = 'tweet';
		if ($first_char == '@') {
			$classes .= ' reply';
		}
		if ($firsttwo_char == 'RT') {
			$classes .= ' retweet';
		}
		
		// Add each item to the master array
		$itemArray[] = array
			(
				$unixtime,
				null,
				$content,
				'tweet',
				date($date_format, $unixtime),
				$tweet->guid,
				$classes
			);
	}
}


$pcsa_path = $start_path . urlencode("SELECT * FROM feed WHERE url='https://picasaweb.google.com/data/feed/base/user/$google?alt=rss&kind=album&hl=en_US'") . $end_path;
$pcsa_feed = json_decode(file_get_contents($pcsa_path, true));

foreach ($pcsa_feed->query->results->item as $item) {
	$unixtime = strtotime($item->pubDate);
	// stop if items are older than set timeframe
	/* disabled because I don't have anything new.
	if ( ($current_time - $unixtime) > $timespan) {
		break;
	}
	*/

	$content = $item->description;
	
	// remove styles and replace font tags with spans
	$content = str_replace(' style="padding: 0 5px"', '', $content);
	$content = str_replace(' style="border:1px solid #5C7FB9"', '', $content);
	$content = str_replace('font color="#333333"', 'span class=""', $content);
	$content = str_replace('font color="#6B6B6B"', 'span class="description"', $content);
	$content = str_replace('font color=\"#3964C2\"', 'span class=""', $content);
	$content = str_replace('/font', '/span', $content);

	// Add each item to the master array
	$itemArray[] = array
		(
			$unixtime,
			$item->title,
			$content,
			'picasa',
			date($date_format, $unixtime),
			$item->link,
			'picasa'
		);
}


$gr_path = $start_path . urlencode("SELECT * FROM feed WHERE url='http://www.google.com/reader/public/atom/user%2F00170081306971182888%2Fstate%2Fcom.google%2Fbroadcast'") . $end_path;
$gr_feed = json_decode(file_get_contents($gr_path, true));

foreach ($gr_feed->query->results->entry as $item) {
	$unixtime = strtotime($item->published);
	if ( ($current_time - $unixtime) > $timespan) {
		break;
	}

	// don't display youtube activity
	if ( $item->content->base != "http://www.youtube.com/user/$youtube" ) {
		if ($item->content->content) {
			$content = $item->content->content;
			$content = strip_tags($content);
			$content = substr($content, 0, 1200);
			$content .= '...';
		} elseif ($item->summary->content) {
			$content = $item->summary->content;
		}
				
		// Add each item to the master array
		$itemArray[] = array
			(
				$unixtime,
				$item->title->content,
				$content,
				'reader',
				date($date_format, $unixtime),
				$item->link->href,
				'reader'
			);
	}
}


// sort array by first item in each subarray (unixtime) descending
array_multisort($itemArray, SORT_DESC);

// this template sets how each item is displayed
include('templates/item.template.php');

?>