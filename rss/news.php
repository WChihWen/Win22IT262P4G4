<?php

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'RSS-News list made with love & PHP in Seattle';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s IT262 Class RSS are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'RSS-News,PHP,'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';


get_header(); #defaults to theme header or header_inc.php

$sql = 'SELECT CategoryID,CategoryName FROM winter2022_rss_category';
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

?>


<h3 align="center">News List</h3>

<div align="left"><a href="admin.php">Manager Page</a></div>
<br>

<?php
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $categoryName = stripslashes($row['CategoryName']);
            //echo $categoryName;
            echo '<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">'.$categoryName.'</h3>
                    </div>
                    <div class="panel-body">
                        <ul>';

                        $sqlfeed = 'SELECT * FROM winter2022_rss_feeds where CategoryID='.(int)$row['CategoryID'] ;
                        $resultfeed = mysqli_query(IDB::conn(),$sqlfeed) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

                        if(mysqli_num_rows($resultfeed) > 0){
                            while($rowfeeds = mysqli_fetch_assoc($resultfeed)){                                                               
                                echo '<li><a href="news-view.php?FeedsID='.(int)$rowfeeds['FeedsID'].'">'.stripslashes($rowfeeds['SubCategory']).'</a></li>';                                
                            }
                        }
            echo            '</ul>  
                    </div>
                </div>	';
        }
    }
?>


<?php



//@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php

?>