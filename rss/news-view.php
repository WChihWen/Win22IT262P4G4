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

    get_header(); #defaults to theme header or header_inc.php

    if (isset($_GET["FeedsID"])){        
        $FeedsID =(int)$_GET["FeedsID"];       
    } else {
        header('Location: news.php');
    }

    //Load Feeds data
    $sql = 'select a.CategoryName,b.* from winter2022_rss_feeds b inner join winter2022_rss_category a on a.CategoryID = b.CategoryID where b.FeedsID ='.$FeedsID ;

    $CategoryName ='';
    $SubCategory ='';
    $FeedsFrom ='';
    $FeedsUrl ='';
    //$DateAdded ='';
    $result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);    

        $CategoryName = stripslashes($row['CategoryName']);
        $SubCategory = stripslashes($row['SubCategory']);
        $FeedsFrom = stripslashes($row['FeedsFrom']);
        $FeedsUrl = stripslashes($row['FeedsUrl']);
        //$DateAdded = stripslashes($row['DateAdded']);
    } else{
        header('Location: news.php');
    }
    //session_start();
    include 'Class/Feed.php';
    $myitems = array();
    // check if data is in session.
    if(isset($_SESSION[$CategoryName."_".$SubCategory])){
        $myitems[] = $_SESSION[$CategoryName."_".$SubCategory];        
    }else{
         // load xml data from FeedsUrl
        $request = $FeedsUrl;
        $response = file_get_contents($request);
        $xml = simplexml_load_string($response);          
        
        // store news list in $myitems[]
        foreach($xml->channel->item as $story){      
            $ArySplit = explode(" - ", $story->title);
            $NewsTitle = $ArySplit[0];
            $NewsUrl = $story->link;
            $PubDate = $story->pubDate;
            $Source = $story->source;
            $SourceUrl = $story->source->attributes()->url;   
            
            $myitems[] = new Feed($ArySplit[0],$NewsUrl,$PubDate,$Source,$SourceUrl);    
                       
            $_SESSION[$CategoryName."_".$SubCategory] = $myitems;
        }    
    }
?>
<h3 align="center">News View</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 ><?php echo '<b>'.$CategoryName.'</b> => <b>'.$SubCategory.'</b> <div align="right">Source: <a href="'.$FeedsUrl.'" target="_blank">'.$FeedsFrom ?></a></div></h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>					
                    <th scope="col">Link</th>
                    <th scope="col">Source</th>
                    <th scope="col">Public Date</th>
                </tr>
                </thead>
                <tbody>
                <?php                
                    for ($i = 0; $i < count($myitems) - 1; $i++) {                        
                        echo '
                        <tr>
                            <td><a href="'.$myitems[$i]->link.'" target="_blank">'.$myitems[$i]->title.'</a></td>
                            <td><a href="'.$myitems[$i]->sourceUrl.'" target="_blank">'.$myitems[$i]->source.'</a></td>
                            <td>'.$myitems[$i]->pubDate.'</td>
                        </tr>';                    
                    }  
                ?>  
                </tbody>
			</table> 
        </div>
    </div>
<?php

@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php

?>