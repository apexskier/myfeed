# My Feed
## build by Cameron Little

This is a fun thing I built that uses PHP and YQL to get feed content from a variety of services. It then uses [Isotope](https://github.com/desandro/isotope) to display and filter the items by service.

### Services

- Twitter
- Youtube
- Github
- Picasa
- Google Reader
- More to come!

### How it works

You input your usernames for different services into the starting variables. For each service it creates a YQL query and pulls the items from the last two weeks (or whatever you want). Then it creates an array inside a multidimensional array for each item. Then it sorts the multidimensional array by the time and inserts it into a list on the page. Isotope then lays out everything and filters it.