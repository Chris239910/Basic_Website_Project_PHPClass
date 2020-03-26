<?php
##Revision history
#
#DEVELOPER          DATE            COMMENTS
#ANHTHIEN(1831187)  2020-02-28      Created index.php file
#ANHTHIEN(1831187)  2020-03-01      Update index.php file
##ANHTHIEN(1831187)  2020-03-03     Intergrate displayAdvertising fuction
#
define("FUNCTIONS_FOLDER", "PHP common functions/");
define("commonFunctions", FUNCTIONS_FOLDER . "commonFunctions.php");


    //send the network headers
    header('Content_Type: text/html; charset=UTF-8');
    
    //include functions path into index page
    include commonFunctions;
?>
<?php
    createPageHeader("Home Page");
?>
<p id="introduction">
    Chris TN, is a technology-related company, was found in 2020 for developing clean technologies, optimizing people's lives<br>
    This association is the place in which freshers in technology have opportunities to apply their knowledge and develop their ambitions.
    
</p>

<?php
displayAdvertising()
?>
        
        
        
<?php
createPageFooter()
?>
