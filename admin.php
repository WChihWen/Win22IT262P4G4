<?php
# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'RSS-Manager page made with love & PHP in Seattle';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s IT262 Class RSS are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'RSS-Manager page,PHP,'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';



$sql = 'SELECT CategoryID, CategoryName FROM winter2022_rss_category';
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));


get_header(); #defaults to theme header or header_inc.php
?>
<h3 align="center">Manager Page</h3>    
    
<?php
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $categoryName = stripslashes($row['CategoryName']);
            echo '
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">'.$categoryName.' &nbsp;<a href="edit-category.php?CategoryID='.(int)$row['CategoryID'].'"><img src="images/edit.ico" alt="edit"></a></h3>

                </div>
                <div class="panel-body">
                <ul>';  

                $sqlfeed = 'SELECT * FROM winter2022_rss_feeds WHERE CategoryID='.(int)$row['CategoryID'];
                $resultfeed = mysqli_query(IDB::conn(),$sqlfeed) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

                if(mysqli_num_rows($resultfeed) > 0){
                    while($rowfeeds = mysqli_fetch_assoc($resultfeed)){
                        $myId = $rowfeeds['SubCategory'];
                        $categoryID = $rowfeeds['CategoryID'];
                        echo '<li><a href="edit-feeds.php?FeedsID='.(int)$rowfeeds['FeedsID'].'">'.stripslashes($rowfeeds['SubCategory']).' &nbsp; <img src="images/edit.ico" alt="edit"></a></li>';

                    } 
                        
                }
            echo '
                    </ul>  
                </div>
            </div>	
            ';
        }
    }
?>

<!--<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Category1  &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></h3>
    </div>
    <div class="panel-body">
        <ul>         
            <li>SubCategory1 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></li>
            <li>SubCategory2 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></li>
            <li>SubCategory3 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></li>
        </ul>  
    </div>
</div>				-->

<?php



//@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php

?>