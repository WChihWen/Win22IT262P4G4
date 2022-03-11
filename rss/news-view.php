<?php

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'RSS-News veiw made with love & PHP in Seattle';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s IT262 Class RSS are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'RSS News-view,PHP,'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

# check variable of item passed in - if invalid data, redirect back to index.php page
if(isset($_GET['FeedsID']) && (int)$_GET['FeedsID'] > 0){#proper data must be on querystring
    $myID = (int)$_GET['FeedsID']; #Convert to integer, will equate to zero if fails
}else{
   myRedirect(VIRTUAL_PATH . "rss/news.php"); //send the user back to a safe page
}

$sql = 'SELECT * FROM winter2022_rss_feeds WHERE FeedsID = '.$myID.'';
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

get_header(); #defaults to theme header or header_inc.php
?>
<h3 align="center">News View</h3>

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $SubCategory = stripslashes($row['SubCategory']);
        echo '
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">'.$SubCategory.'</h3>
            </div>
            <div class="panel-body">
            <ul>
            <li><a href="readXML.php?FeedsID='.$myID.'">Link to webpage</a></li>
            ';  


            // $sqlfeed = 'SELECT * FROM winter2022_rss_feeds WHERE CategoryID='.(int)$row['CategoryID'];
            // $resultfeed = mysqli_query(IDB::conn(),$sqlfeed) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

            // if(mysqli_num_rows($resultfeed) > 0){

            //     while($rowfeeds = mysqli_fetch_assoc($resultfeed)){
                    
            //             $myId = $rowfeeds['FeedsID'];
            //             echo '<li><a href="news-view.php?FeedsID='.(int)$rowfeeds['FeedsID'].'">'.stripslashes($rowfeeds['SubCategory']).'</a></li>';
            //     } 
                    
            // }
        echo '
                </ul>  
            </div>
        </div>	
        ';
    }
}


//@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php

?>