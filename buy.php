<?php


##Revision history
#
#DEVELOPER          DATE            COMMENTS
#ANHTHIEN(1831187)  2020-03-01      Created buy.php file
#ANHTHIEN(1831187)  2020-03-05      Created PageHeader and Form
#
define("FUNCTIONS_FOLDER", "PHP common functions/");
define("commonFunctions", FUNCTIONS_FOLDER . "commonFunctions.php");


    
    
    //include functions path into index page
    include commonFunctions;

    createPageHeader("Buy Page");
?>
<form action="buy.php" method="POST";>
        <p>Please input information below to buy product</p>
        
        <p>
            <label>Product Code: </label>
            <input type="text" name="productCode" value="<?php displayPOSTValue("productCode") ?>"> 
            <?php displayErrorMessage($productCodeError); ?>
        </p>
        <p>
            <label>Customer First name: </label> 
            <input type="text" name="firstname" value="<?php displayPOSTValue("firstname") ?>">
            <?php displayErrorMessage($firstNameError); ?>
        </p>
        <p>
            <label>Customer Last name: </label>
            <input type="text" name="lastname" value="<?php displayPOSTValue("lastname") ?>"> 
            <?php displayErrorMessage($lastNameError); ?>
        </p>
        <p>
            <label>Customer City: </label>
            <input type="text" name="city" value="<?php displayPOSTValue("city") ?>"> 
            <?php displayErrorMessage($cityError); ?>
        </p>
        <p>
            <label>Comments: </label>
            <input type="text" name="comments" value="<?php displayPOSTValue("comments") ?>"> 
            <?php displayErrorMessage($commentsError); ?>
        </p>
        <p>
            <label>Price: </label>
            <input type="text" name="price" value="<?php displayPOSTValue("price") ?>"> 
            <?php displayErrorMessage($priceError); ?>
        </p>
        <p>
            <label>Quantity: </label>
            <input type="text" name="quantity" value="<?php displayPOSTValue("quantity") ?>"> 
            <?php displayErrorMessage($quantityError); ?>
        </p>
        <p>
            <input type="submit" name="submit" value="Submit Data" />
            <input type="reset" value="Clear Data" />
        </p>
    
    </form>

        
        
        
<?php
createPageFooter()
?>

