<?php

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'RSS-Edit Category made with love & PHP in Seattle';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s IT262 Class RSS are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'RSS Edit Category,PHP,'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';


get_header(); #defaults to theme header or header_inc.php
?>
<h3 align="center">Edit Category</h3>
<br><br>
<form  style="width:350px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <fieldset>
        <label >Category:</label>
        <input type="text" name="Category" value=""> 
        <br><br>
        <div >            
            <input type="submit"  value="Update">
            <a href="admin.php" class="button">Cancel</a>  
        </div> 
    </fieldset>
</form>
<br>

<?php



//@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php

?>