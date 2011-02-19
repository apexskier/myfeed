# My Feed
## built by Cameron Little

This is a fun thing I built that uses PHP and YQL to get feed content from a variety of services. It then uses [Isotope](https://github.com/desandro/isotope) to display and filter the items by service.

### Services

- Twitter
- Youtube
- Github
- Picasa
- Google Reader
- Flickr
- More to come!

### Options

- Custom date format - http://php.net/manual/en/function.date.php
- Number of weeks to search back for items.
- Where to store a cache file.
- Time to store the cache file for.

### How it works (on the PHP side)

1. Takes variables from includes/options.php.
2. Checks if there's a cache file and displays it if there is one.
3. If not...
4. Creates a multidimensional array. Each entry has a subarray with the unix time, the title, the content, the source, the time in a readable format, a direct link to the item, and any custom css classes to be added to the item.
5. Adds an item that has a Promote JS image in it. This has a random unix time value that's in between the current time and however long ago the timeframe is set to.
6. For each service, it adds items to the multidimensional array and stops once it reaches the time limit.
7. Sorts the multidimensional array by the time (descending).
8. Starts creating the cache file.
9. Runs each item in the multidimensional array through the item.template.php file and creates a <code>li</code>.
10. Generates the cache file and ends the caching process.

### Credits and Inspiration

Built by Cameron Little.

The layout and filtering uses <a href="http://isotope.metafizzy.co/">Isotope</a> by <a href="http://desandro.com">David DeSandro</a> / <a href="http://metafizzy.co">Metafizzy</a>

Social media icons (except for the all items icon) by <http://www.ormanclark.com/blog/free-vector-social-media-icons/>Orman Clark.

#### Helpful resources

YQL stuff: http://net.tutsplus.com/tutorials/javascript-ajax/how-to-build-an-rss-reader-with-jquery-mobile-2/

Twitter/Github string replacement and caching: http://f6design.com/journal/2010/10/07/display-recent-twitter-tweets-using-php/