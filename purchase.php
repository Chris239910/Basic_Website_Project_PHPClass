<?php



##Revision history
#
#DEVELOPER          DATE            COMMENTS
#ANHTHIEN(1831187)  2020-03-01      Created purchase.php file
##ANHTHIEN(1831187)  2020-03-08      Added the new table 
#
define("FUNCTIONS_FOLDER", "PHP common functions/");
define("commonFunctions", FUNCTIONS_FOLDER . "commonFunctions.php");


    //send the network headers
    header('Content_Type: text/html; charset=UTF-8');
    
    //include functions path into index page
    include commonFunctions;

    createPageHeader("Purchase Page");
?>
<table class="purchases">
            <tr>
                <th>Product Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>City</th>
                <th>Comments</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Taxes</th>
                <th>Grand Total</th>
               

            </tr>
        
            <?php readfilePurchase(); ?>
</table>
<br><br><br>
 <?php getCheatSheet(); ?>


        
        
        
<?php
createPageFooter()
?>
