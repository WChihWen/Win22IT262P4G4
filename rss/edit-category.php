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

$CategoryID = 0;
$CategoryName = "";

$errorMsg = "";

$print="";
$sql_err="";

if($_SERVER['REQUEST_METHOD'] == 'POST') {   
    $CategoryID = (int)$_POST['CategoryID'];

    if(empty($_POST['CategoryName'])){
        $errorMsg .= 'Please enter a new category name.';
    }else {
        $CategoryName = $_POST['CategoryName'];

        
        if(isset($_POST['CategoryName'])){
            $sql = 'UPDATE winter2022_rss_category SET CategoryName = "'.$CategoryName.'" WHERE CategoryID = '.$CategoryID;

            if (IDB::conn()->query($sql) === true) {

                $print .='Update </b> successfully.<br>';           

                header('Location: admin.php');
            } else{    
                $sql_err= "SQL_error: " . $sql . "<br><br>";
            } 
        }

    }
} else {
    if ( isset($_GET['CategoryID'])){        
        $CategoryID =(int)$_GET["CategoryID"];       
    } else {
        header('Location: admin.php');
    }
    //Load Feeds data
    $sql = 'select * from winter2022_rss_category where CategoryID ='.$CategoryID ;

    $result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);   
        $CategoryName = stripslashes($row['CategoryName']);
        $CategoryID =(int)($row['CategoryID']);
    }else {
        // if there is no feedsID, go back admin
        header('Location: admin.php');
    }
    @mysqli_free_result($result);
}


?>

<h3 align="center">Edit Category</h3>
<br>

<form  style="width:350px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <fieldset>
        <label for = "CategoryName">New category name:</label>
        <input for = "CategoryName" type="text" name="CategoryName" value="<?php echo ($CategoryName); ?>"> 
        <br>
        <span><?php echo ($errorMsg); ?></span>
        <br>
        <div >            
            <input id="submit" type="submit"  value="Update">
            <a href="admin.php" class="button">Cancel</a>  
        </div> 
        <input type="hidden" id="CategoryID" name="CategoryID" value="<?php echo $CategoryID;?>">
    </fieldset>
</form> 

<?php


//@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php

?>
