<h2> P4 - News Aggregator - Groupe 4, IT 262, Winter 2022</h2>

<h3> A News app for our client: While we were building our SurveySez app, the client asked for another app that will also extend the capabilities of the Client Protosite.

This new app will be built by your team! </h3>


<h4>News Syndication, Categorization and Caching:</h4> For our third group project we'll be  building a PHP application that provides <b>categorized news pages from syndicated RSS feeds</b>. These pages must come from feed data stored in a database.  The feed data must be cached on a session level so news pages generated during a current session are stored so the data does not need to be retrieved from the remote survey beyond the first page hit.

<h4>Integrate RSS data into Feed Pages:</h4> You'll be <b>building pages that integrate customized RSS feeds into the client protosite.</b>  The RSS feed must carry the look and feel of the protosite, plus include an RSS feed from Google, etc.  The pages should carry both the news stories and images if possible that accompany the news items. 

<h4>A News Page with a Link to 3 News categories, with custom 9 custom feeds:</h4>  The entry point to the application should be a page linked to the protosite  as a page with a name such as "News" and then link to pages or an application that accommodates <b>at least 3 news categories, with at least 3 custom feeds under each.</b>  An example would be a category of Music, under which were feeds named Reggae, Blues & Jazz  (That would be one of the 3 required categories & custom feeds).

<h4>Google News Deprecates Feeds:</h4> In 2017, Google News deprecated feeds directly tied to it's news aggregation system.  Or did they?  Here's an item on stackoverflow that shows where to get the feed data, URL Format for Google News RSS Feed (Links to an external site.)

Check out the following example which targets news for 'strawberry shortcake':

https://news.google.com/rss/search?q=strawberry+shortcake&hl=en-US&gl=US&ceid=US:en

Note how in the example above the words strawberry shortcake are connected by the plus sign, which allows multiple words to tailor your feed data even more.

<h4>2 Database Tables Required:</h4> You must store your feed and category information in database tables.  Therefore you'll need a minimum of 2 tables. These tables could greatly resemble the books & categories tables from the Joins lesson on the class website!

<h4>List/View:</h4> The Category/Feeds pages will make great use of techniques we've learned such as List/View.  Be sure to study the example List/View pages in the demo folder of your client protosite.

<h4>Extra credits oportunities:</h4> 

<h4>Session Caching:</h4> Every time we hit an RSS page provided by a third party we introduce delay and consume network resources.  Therefore we'll require you to cache the data once retrieved for a number of minutes (example, 10) that will enable your app to store data for that feed via a session and not retrieve the feed data again until the cache period is up.  Each news feed should have a separate cache mechanism. 

<h4>Cache Time/Date & Clearing:</h4> If RSS data is cached, the retrieval time/date should be displayed on each feed, along with the programmatic ability to clear the cache for that feed.

You must also be able to programmatically clear the cache of all feeds. (Delete all existing session data)  

<h4>Extra Credit:</h4> You can gain up to 30 points extra credit in building the capability to add feed data through an administrative interface.  The best starting point for this piece is the demo_add.php page in the demo folder.

<h4>Extra Extra Credit:</h4> You can gain up to 30 points extra credit in building the capability to edit feed data through an administrative interface.  The best starting point for this piece is the demo_edit.php page in the demo folder.


