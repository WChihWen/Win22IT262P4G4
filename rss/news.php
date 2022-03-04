<?php
/**
 * index.php along with survey_view.php allows us to view surveys
 * 
 * @package SurveySez
 * @author Chih Wen Wang <yaman0923@gmail.com>
 * @version 3.02 2022/02/15
 * @link http://www.example.com/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see survey_view.php
 * @see Pager.php 
 * @todo none
 */

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
?>
<h3 align="center">News List</h3>

<div align="left"><a href="import.php">Import News</a>&nbsp;&nbsp;&nbsp; <a href="delete.php">Delete Imported News</a></div>
<br><br>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Sport</h3>
    </div>
    <div class="panel-body">
        <ul>         
            <li><a href="#">Football</a></li>
            <li><a href="#">Tennis</a></li>
            <li><a href="#">Baseball</a></li>
        </ul>  
    </div>
</div>			

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Arts</h3>
    </div>
    <div class="panel-body">
        <ul>         
            <li><a href="#">Dance</a></li>
            <li><a href="#">Music</a></li>
            <li><a href="#">Theater</a></li>
        </ul>  
    </div>
</div>		
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Business</h3>
    </div>
    <div class="panel-body">
        <ul>         
            <li><a href="#">Economy</a></li>
            <li><a href="#">Energy & Environment</a></li>
            <li><a href="#">Small Business</a></li>
        </ul>  
    </div>
</div>		

<?php



//@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php

?>