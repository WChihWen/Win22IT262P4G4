<?php

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'RSS-New Category made with love & PHP in Seattle';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s IT262 Class RSS are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'RSS New Category,PHP,'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

get_header(); #defaults to theme header or header_inc.php


$CategoryName = "";
$Category_Err ="";
$all_set = true; 

if($_SERVER['REQUEST_METHOD'] == 'POST') {   
    if($_POST['CategoryName'] == NULL){
        $Category_Err = 'Please fill out Category Name';  
        $all_set = false; 
    }else {
        $CategoryName = $_POST['CategoryName'];
    }

    if($all_set == true){
        $sql = "INSERT INTO winter2022_rss_category VALUES (NULL,'".$CategoryName."');";

        if (IDB::conn()->query($sql) === TRUE) {                       
            //$print .='Update </b> successfully.<br>';           

            //$print .='Go back <a href="admin.php"><b>Manager Page</b></a>';
            header('Location: admin.php');
            
        }else{    
            $sql_err= "SQL_error: " . $sql . "<br><br>";
        }
    }
}


?>

<h3 align="center">New Category</h3>
<br>

<form  style="width:350px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <fieldset>
        <label for = "CategoryName">New category name:</label>
        <input for = "CategoryName" type="text" name="CategoryName" value="<?php echo ($CategoryName); ?>"> 
        <br>
        <span><?php echo ($Category_Err); ?></span>
        <br>
        <div >            
            <input id="submit" type="submit"  value="New">
            <a href="admin.php" class="button">Cancel</a>  
        </div>         
    </fieldset>
</form> 

<?php


//@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php

?>