<?
//read-feed-simpleXML.php
//our simplest example of consuming an RSS feed
require '../inc_0700/config_inc.php';

# check variable of item passed in - if invalid data, redirect back to index.php page
if(isset($_GET['FeedsID']) && (int)$_GET['FeedsID'] > 0){#proper data must be on querystring
    $myID = (int)$_GET['FeedsID']; #Convert to integer, will equate to zero if fails
}else{
   myRedirect(VIRTUAL_PATH . "rss/news.php"); //send the user back to a safe page
}

$sql = 'SELECT * FROM winter2022_rss_feeds WHERE FeedsID = '.$myID.'';
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $request = $row['FeedsUrl'];
        $response = file_get_contents($request);
        $xml = simplexml_load_string($response);
    print '<h1>' . $xml->channel->title . '</h1>';

        foreach($xml->channel->item as $story)
        {
            echo '<a href="' . $story->link . '">' . $story->title . '</a><br />'; 
            echo '<p>' . $story->description . '</p><br /><br />';
            }
}
}
   
  
?>