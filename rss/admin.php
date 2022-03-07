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


get_header(); #defaults to theme header or header_inc.php
?>
<h3 align="center">Manager Page</h3>


<div class="panel panel-default">
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
</div>			

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Category2 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></h3>
    </div>
    <div class="panel-body">
        <ul>       
            <li>SubCategory1 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></li>
            <li>SubCategory2 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></li>
            <li>SubCategory3 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></li>  
        </ul>  
    </div>
</div>		
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Category3 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></h3>
    </div>
    <div class="panel-body">
        <ul>   
            <li>SubCategory1 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></li>
            <li>SubCategory2 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></li>
            <li>SubCategory3 &nbsp;<a href="#"><img src="images/edit.ico" alt="edit"></a></li>        
        </ul>  
    </div>
</div>		

<?php



//@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php

?>