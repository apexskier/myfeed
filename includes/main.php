<?php

$youtube      = 'camapexskier';
$twitter      = 'apexskier';
$github       = 'apexskier';
$date_format  = 'g:i A M jS';

$titles       = array();
$published    = array();
$descriptions = array();
$content      = array();
$source       = array();
$current_time = time();
$pastweek     = $current_time - 1209600;

/*
$cache = dirname(__FILE__) . "/cache/$siteName";
// Re-cache every three hours
if(filemtime($cache) < (time() - 10800))
{
   // Get from server
   if ( !file_exists(dirname(__FILE__) . '/cache') ) {
      mkdir(dirname(__FILE__) . '/cache', 0777);
   }
   // YQL query (SELECT * from feed ... ) // Split for readability
   $path = "http://query.yahooapis.com/v1/public/yql?q=";
   $path .= urlencode("SELECT * FROM feed WHERE url='$url'");
   $path .= "&format=json";

   // Call YQL, and if the query didn't fail, cache the returned data
   $yt_feed = file_get_contents($path, true);

   // If something was returned, cache
   if ( is_object($yt_feed) && $yt_feed->query->count ) {
      $cachefile = fopen($cache, 'wb');
      fwrite($cachefile, $yt_feed);
      fclose($cachefile);
   }
}
else
{
   // We already have local cache. Use that instead.
   $yt_feed = file_get_contents($cache);
}
*/
// Decode that shizzle
// $yt_feed = json_decode($yt_feed);


$yt_path  = "http://query.yahooapis.com/v1/public/yql?q=";
$yt_path .= urlencode("SELECT * FROM feed WHERE url='http://gdata.youtube.com/feeds/base/users/$youtube/uploads'");
$yt_path .= "&format=json";

$yt_feed = json_decode(file_get_contents($yt_path, true));

foreach ($yt_feed->query->results->entry as $item) {
	$vid = str_replace("&feature=youtube_gdata", "", str_replace("http://www.youtube.com/watch?v=", "", $item->link[0]->href));
	$source[]    = 'youtube';
	$titles[]    = $item->title->content;
	$published[] = strtotime($item->published);
	$content[]     = "<iframe title='YouTube video player' width='400' height='225' src='http://www.youtube.com/embed/$vid?hd=1' frameborder='0' allowfullscreen></iframe>";

	if (strtotime($item->published) > $pastweek) { break; }
}


$gh_path  = "http://query.yahooapis.com/v1/public/yql?q=";
$gh_path .= urlencode("SELECT * FROM feed WHERE url='https://github.com/$github.atom'");
$gh_path .= "&format=json";

$gh_feed = json_decode(file_get_contents($gh_path, true));

foreach ($gh_feed->query->results->entry as $item) {
	$source[]    = 'github';
	$titles[]    = $item->title;
	$published[] = strtotime($item->published);
	$content[]     = $item->content->content;

	// if (strtotime($item->published) > $pastweek) { break; }
}

$gh_feed = json_decode($gh_feed);







/**
 * Originally based off of this...
 *
 *
 * TWITTER FEED PARSER
 * 
 * @version	1.1
 * @author	Jonathan Nicol
 * @link	http://f6design.com/journal/2010/10/07/display-recent-twitter-tweets-using-php/
 * 
 * Notes:
 * We employ caching because Twitter only allows their RSS feeds to be accesssed 150
 * times an hour per user client.
 * --
 * Dates can be displayed in Twitter style (e.g. "1 hour ago") by setting the 
 * $twitter_style_dates param to true.
 * 
 * Credits:
 * Hashtag/username parsing based on: http://snipplr.com/view/16221/get-twitter-tweets/
 * Feed caching: http://www.addedbytes.com/articles/caching-output-in-php/
 * Feed parsing: http://boagworld.com/forum/comments.php?DiscussionID=4639
 */

$tw_path  = "http://query.yahooapis.com/v1/public/yql?q=";
$tw_path .= urlencode("SELECT * FROM feed WHERE url='http://twitter.com/statuses/user_timeline/$twitter.rss'");
$tw_path .= "&format=json";

$tw_feed = json_decode(file_get_contents($tw_path, true));

foreach ($tw_feed->query->results->item as $tweet) {
	$source[] = 'tweet';
	$titles[] = '';

	// Stript Twitter username, "e.g. User name: Blah" from tweet.
	$tweet_desc = substr($tweet->description,strpos($tweet->description,":")+2);
	$tweet_desc = htmlspecialchars($tweet_desc);

	// Add hyperlink html tags to any urls, twitter ids or hashtags in the tweet.
	$tweet_desc = preg_replace('/(https?:\/\/[^\s"<>]+)/','<a href="$1">$1</a>',$tweet_desc);
	$tweet_desc = preg_replace('/(^|[\n\s])@([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/$2">@$2</a>', $tweet_desc);
	$tweet_desc = preg_replace('/(^|[\n\s])#([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/search?q=%23$2">#$2</a>', $tweet_desc);

	$tweet_time = strtotime($tweet->pubDate);	
	$display_time = date($date_format, $tweet_time);

	$content[]   = $tweet_desc;
	$published[] = $tweet_time;

	// If we have processed enough tweets, stop.
	if ( strtotime($tweet->published) > $pastweek ) {
		break;
	}

}

include('templates/item.template.php');

?>