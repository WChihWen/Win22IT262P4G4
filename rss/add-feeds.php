<?php

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'RSS-Add feed made with love & PHP in Seattle';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s IT262 Class RSS are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'RSS Add feed,PHP,'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

get_header(); #defaults to theme header or header_inc.php


$CategoryName = "";

$CategoryID = 0;
$SubCategory="";
$FeedsFrom="";
$FeedsUrl="";

$SubCategory_Err="";
$FeedsFrom_Err="";
$FeedsUrl_Err="";

$all_set = true; 

$print="";
$sql_err="";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // insert data    
    $CategoryID = (int)$_POST['CategoryID'];

    if($_POST['SubCategory'] == NULL){
        $SubCategory_Err = 'Please fill out SubCategory';  
        $all_set = false; 
    }else {
        $SubCategory = $_POST['SubCategory'];
    }

    if($_POST['FeedsFrom'] == NULL){
        $FeedsFrom_Err = 'Please fill out FeedsFrom';  
        $all_set = false; 
    }else {
        $FeedsFrom = $_POST['FeedsFrom'];
    }

    if($_POST['FeedsUrl'] == NULL){
        $FeedsUrl_Err = 'Please fill out FeedsUrl';  
        $all_set = false; 
    }else {
        $FeedsUrl = $_POST['FeedsUrl'];
    }

    if($all_set == true){
        // insert feeds
        //FeedsID	CategoryID	SubCategory	FeedsFrom	FeedsUrl	DateAdded
        $mydate = date('Y-m-d H:i:s');
        $sql = "INSERT INTO winter2022_rss_feeds VALUES (NULL,".$CategoryID.",'".$SubCategory."','".$FeedsFrom."','".$FeedsUrl."','".$mydate."');";

        if (IDB::conn()->query($sql) === TRUE) {            
            header('Location: admin.php');            
        }else{    
            $sql_err= "SQL_error: " . $sql . "<br><br>";
        }  
    }
    //@mysqli_free_result($result);
}else{
    // load data 
    if (isset($_GET["CategoryID"]) && isset($_GET["CategoryName"])){        
        $CategoryID =(int)$_GET["CategoryID"];   
        $CategoryName =$_GET["CategoryName"];        
    } else {
        header('Location: admin.php');
    }
}

?>
<h3 align="center">Add Feed</h3>
<br><br>
<form  style="width:500px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <fieldset>
        <label>Category: <?php echo $CategoryName;?></label>
        <br> <br>
        <label>SubCategory:</label>
        <input type="text" name="SubCategory" value="<?php echo $SubCategory;?>"> 
        <br> 
        <span class="error"><?php echo $SubCategory_Err;?></span>
        <br>
        <label>Feed From:</label>
        <input type="text" name="FeedsFrom" value="<?php echo $FeedsFrom;?>"> 
        <br> 
        <span class="error"><?php echo $FeedsFrom_Err;?></span>
        <br>
        <label>FeedsUrl:</label>
        <textarea name="FeedsUrl" style="width:98%;"  rows="5"><?php echo $FeedsUrl;?></textarea>
        
        <br>
        <span class="error"><?php echo $FeedsUrl_Err;?></span>
        <br> <br>
        <div >            
            <input type="submit"  value="New">
            <a href="admin.php" class="button">Cancel</a>  
        </div> 

        <input type="hidden" id="CategoryID" name="CategoryID" value="<?php echo $CategoryID;?>">
    </fieldset>
</form>
<br>
<span ><?php echo $print;?></span>
<span class="error"><?php echo $sql_err;?></span>

<?php




get_footer(); #defaults to theme footer or footer_inc.php

?>