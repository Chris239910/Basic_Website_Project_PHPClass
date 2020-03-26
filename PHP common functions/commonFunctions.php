<?php
##Revision history
#
#DEVELOPER          DATE            COMMENTS
#ANHTHIEN(1831187)  2020-02-28      Created commonFunctions.php file
#ANHTHIEN(1831187)  2020-03-01      Created createPageHeader() functions
#ANHTHIEN(1831187)  2020-03-01      Created createPageFooter() functions
#ANHTHIEN(1831187)  2020-03-02      Created createNavigationMenu() functions
#ANHTHIEN(1831187)  2020-03-04      Created displayAdvertising() functions
#ANHTHIEN(1831187)  2020-03-07      Created functions using for buy.php
#ANHTHIEN(1831187)  2020-03-08      Created functions using for purchase.php

?>
<?php
//send the network headers
    header('Content_Type: text/html; charset=UTF-8');
define("CSS_FOLDER", "CSS/");
define("IMAGES_FOLDER", "Images/");
define("DATA_FOLDER", "DATA/");
define("DEBUG_FOLDER", "debug/");

define("DEFAULT_STYLESHEET",CSS_FOLDER. "default.css");

define("HOME_PAGE", "index.php");
define("BUY_PAGE", "buy.php");
define("PURCHASE_PAGE", "purchase.php");

define("CLASS_ADVERTISING_IMG", "AdvertisingImg");
define("CLASS_ADVERTISING_HEINEKEN", "AdvertisingHeineken");
define("AQUAFINA_LOGO", IMAGES_FOLDER . "aquafina.jpg");
define("COCACOLA_LOGO", IMAGES_FOLDER . "cocacola.jpg");
define("HEINEKEN_LOGO", IMAGES_FOLDER . "heineken.jpg");
define("PEPSI_LOGO", IMAGES_FOLDER . "pepsi.jpg");
define("REDBULL_LOGO", IMAGES_FOLDER . "redbull.jpg");
define("COMPANY_LOGO", IMAGES_FOLDER . "logo.jpg");

define("PRODUCTCODE_MAX_LENGTH", 12);
define("FIRSTNAME_MAX_LENGTH", 20);
define("LASTNAME_MAX_LENGTH", 20);
define("CITY_MAX_LENGTH", 8);
define("COMMENTS_MAX_LENGTH", 200);
define("PRICE_MAX_LENGTH", 10000);
define("QUANTITY_MAX_LENGTH", 99);
define("QUANTITY_MIN_LENGTH", 1);

define("TAXES_RATE", 0.1205);


define("CLASS_ERROR", "error");

define("NAMES_FILE", DATA_FOLDER . "test.txt");
define("FILE_EOL", "\r\n");

define("LOG_FILE",DEBUG_FOLDER. "logs.txt");

define("COMMAND_PRINT", "print");
define("COMMAND_PRINT_STYLESHEET", CSS_FOLDER. "print.css");

define("BODY_TYPE_NOCOMMAND", "Type1");
define("BODY_TYPE_COMMAND", "Type2");

$productCodeError = "";
$firstNameError = "";
$lastNameError = "";
$cityError = "";
$commentsError = "";
$priceError = "";
$quantityError = "";
$errorFound = false;

if(isset($_POST["submit"]))
    {
        //validate all parameters
        if(!productCodeIsValid($_POST["productCode"], PRODUCTCODE_MAX_LENGTH)) //should change 10 to constant variable_...define
        {
            $productCodeError =  "The product code has to start with P/p, must not be empty and must contain maximum ".PRODUCTCODE_MAX_LENGTH." characters";
        }
        if(!stringIsValid($_POST["firstname"], FIRSTNAME_MAX_LENGTH))
        {
            $firstNameError = "The first name must not be empty and must contain maximum ".FIRSTNAME_MAX_LENGTH." characters ";
        }
        if(!stringIsValid($_POST["lastname"], LASTNAME_MAX_LENGTH))
        {
            $lastNameError = "The last name must not be empty and must contain maximum ".LASTNAME_MAX_LENGTH." characters ";
        }
        if(!stringIsValid($_POST["city"], CITY_MAX_LENGTH))
        {
            $cityError = "The city must not be empty and must contain maximum ".CITY_MAX_LENGTH." characters ";
        }
        if(!commentsIsValid($_POST["comments"], COMMENTS_MAX_LENGTH))
        {
            $commentsError = "The comments contains maximum ".COMMENTS_MAX_LENGTH." characters ";
        }
        if(!priceIsValid($_POST["price"], PRICE_MAX_LENGTH))
        {
            $priceError = "The price must not be negative and cannot be higer than ".PRICE_MAX_LENGTH." dollars ";
        }
        if(!quantityIsValid($_POST["quantity"], QUANTITY_MIN_LENGTH, QUANTITY_MAX_LENGTH))
        {
            $quantityError = "The quantity is valid between ".QUANTITY_MIN_LENGTH. "and ".QUANTITY_MAX_LENGTH.". No decimals are allowed.";
        }
        if($errorFound == false)
        {

            //calculate subtotal in type of float
            $subTotal = $_POST["price"] * $_POST["quantity"];
            
            
            //calculate taxes
            $taxes = $subTotal * TAXES_RATE;
            //round the float variables to contain only 2 digits
            $subTotal = round($subTotal, 2);
            $taxes = round($taxes, 2);
            
            //calculate the grand total
            $grandTotal = $subTotal + $taxes;
            
            //create an array to save information
            $array = array($_POST["productCode"], $_POST["firstname"],$_POST["lastname"], $_POST["city"],$_POST["comments"], floatval($_POST["price"]), intval($_POST["quantity"]), floatval($subTotal), floatval($taxes), floatval($grandTotal));
            //var_dump($array);
             file_put_contents(
                        NAMES_FILE, #filename
                        json_encode($array), 
                        FILE_APPEND); #add to existing file
                emptyPOSTValue();
            
        }
    }

function createPageHeader($title)
{
//set_error_handler("manageError");
//set_exception_handler("manageException");
?><!DOCTYPE html>
<html>
<head>
    
    <meta charset='UTF-8'>
      <?php
      //Create a variable to store stylesheet name
      $cssStylesheet = DEFAULT_STYLESHEET;

      ?>
    <link rel ="stylesheet" type="text/css" href="<?php echo $cssStylesheet; ?>" />
    <title><?php echo $title ?></title>
</head>
<body class="<?php getCommandPrintType() ?>">
        <div class='container'>
            <div class='logo'>
                <?php displayCompanyLogo();?>
            </div>
            <div class='compayName'>
                CHRIS TN 
            </div>
            <div><?php createNavigationMenu() ?></div>
        </div>
        
        <?php
}

//function create page footer
function createPageFooter()
{
    
    echo "<br><br>";
    //createNavigationMenu();
    //create a datetime object as of now
    $currentDateTime = new DateTime("now");
    
    //display current year in the copyright
    echo "<br><br>Copyright Anh Thien Nguyen(1831187) " .$currentDateTime->format("Y") . ".";
    
    ?> 
    </body>
</html> <?php
}

//function display company logo
function displayCompanyLogo()
{
    //display company logo
    echo '<img src="' . COMPANY_LOGO . '">';
}
function createNavigationMenu()
{
    //create three elements of navigation menu
    ?>
    
        <nav id="nav-bar">
			
            <ul>
                <li><a href="<?php echo HOME_PAGE ?>" title="Home">HOME</a></li>
                <li><a href="<?php echo BUY_PAGE ?>" title="buy">BUY</a></li>
                <li><a href="<?php echo PURCHASE_PAGE ?>" title="purchase">PURCHASE</a></li>


            </ul>
			
        </nav>

        <?php
    
}

function displayAdvertising()
{
    //declare five companies in advertising element
    $advertising = array(AQUAFINA_LOGO, COCACOLA_LOGO, HEINEKEN_LOGO, PEPSI_LOGO, REDBULL_LOGO);
    
    //change the order of the elements in the array
    shuffle($advertising);
    //display the 1st element of the array
    for($i = 0; $i < count($advertising); $i++ ){
        if($advertising[$i] == HEINEKEN_LOGO){
            echo '<a href="https://www.newegg.ca"><img class="'.CLASS_ADVERTISING_HEINEKEN.'" src="' . $advertising[$i] . '"></a>';
        }
        else{
            echo '<a href="https://www.newegg.ca"><img class="'.CLASS_ADVERTISING_IMG.'" src="' . $advertising[$i] . '"></a>';
        }
    }
     /*       
    if($advertising[0] == IMAGES_FOLDER.'heineken.jpg'){
        echo '<a href="https://www.newegg.ca"><img class="'.CLASS_ADVERTISING_HEINEKEN.'" src="' . $advertising[0] . '"></a>';
    }
    else{
        echo '<a href="https://www.newegg.ca"><img class="'.CLASS_ADVERTISING_IMG.'" src="' . $advertising[0] . '"></a>';
    }
      * 
      */
}

function displayPOSTValue($fieldName)
{
    //if the field was posted
    if(isset($_POST[$fieldName]))
    {
        //display on the screen
        echo $_POST["$fieldName"];
    
    }
}
function emptyPOSTValue(){
    //empty value of textboxes after successfully receiving informations from user
    $_POST["productCode"] = "";
    $_POST["firstname"] = "";
    $_POST["lastname"] = "";
    $_POST["city"] = "";
    $_POST["comments"] = "";
    $_POST["price"] = "";
    $_POST["quantity"] = "";
    
}

function displayErrorMessage($errorText)
{
    if($errorText != "")
    {
        echo '<label class="' .CLASS_ERROR .'">' . $errorText . '</label>';
    }
}
function stringIsValid($string, $maxLength)
{
    global $errorFound;
    
    //make sure the string is not empty ad not too long
    if(strlen($string) > 0 && mb_strlen($string) <= $maxLength)
    {
        //the string looks valid
        return true;
    }
    else
    {
        //the string is not valid
        $errorFound = true;
        return false;
    }
}
function commentsIsValid($string, $maxLength)
{
    global $errorFound;
    
    //make sure the string is not empty ad not too long
    if(strlen($string) >= 0 && mb_strlen($string) <= $maxLength)
    {
        //the string looks valid
        return true;
    }
    else
    {
        //the string is not valid
        $errorFound = true;
        return false;
    }
}
function quantityIsValid($string, $min, $max)
{
    global $errorFound;
    
    //make sure the string is not empty ad not too long
    if(is_int(intval($string)) && is_numeric(intval($string))){
        if(intval($string) >= $min && intval($string) <= $max)
        {
            //the string looks valid
            return true;
        }
        else
        {
            //the string is not valid
            $errorFound = true;
            return false;
        }
    }
}
function productCodeIsValid($string, $maxLength)
{
    global $errorFound;
    
    //make sure the string is not empty ad not too long
    if(strlen($string) >0 && mb_strlen($string) <= $maxLength)
    {
        if((substr($string, 0, 1) == "P" || substr($string, 0,1) == "p")){
            //the string looks valid
            return true;
        }
        
    }
    else
    {
        //the string is not valid
        $errorFound = true;
        return false;
    }
}
function priceIsValid($string, $maxLength)
{
    global $errorFound;
    
    //make sure the string is not empty ad not too long
    if(floatval($string) >0 && floatval($string) <= $maxLength)
    {
        
        //the string looks valid
        return true;
        
        
    }
    else
    {
        //the string is not valid
        $errorFound = true;
        return false;
    }
}

function readfilePurchase(){
      $fileHandle = fopen(NAMES_FILE, "r")
                        or exit("Cannot open file");
        
        #loop until i reach the end of file
        while(!feof($fileHandle)){
            #v1.0 #get the line in the file
            $fileLine =  fgets($fileHandle);
            //echo $fileLine;
            #if the line in the file is not empty
            if(trim($fileLine) <> "")
            {
                echo "<tr>";
                #convert that line onto an array
                $lineArray = json_decode($fileLine);
            
                //declare the positions of max length, price, subtotal, taxes and grand total of products
                $maxLengthArray = 9;
                $positionPrice = 5;
                $positionSubtotal = 7;
                $positionTaxes = 8;
                $positionGrandtotal = 9;
            
                #v2.0
                //$lineArray = json_decode(fgets($fileHandle));
                for($i = 0; $i <= $maxLengthArray; $i++)
                {
                    if($i == $positionPrice|| $i == $positionSubtotal|| $i ==$positionTaxes|| $i ==$positionGrandtotal)
                    {
                        
                        echo "<td>" . $lineArray[$i] ."$ </td>";
                    }else
                    {
                        echo "<td>". $lineArray[$i] ."</td>";
                    }
                }
            }

        }
        #close
        fclose($fileHandle);
        
}



function manageError($errorCode, $errorMessage, $errorFile, $errorLine)
{
    //$errorTime = new DateTime("now");
    
    file_put_contents(LOG_FILE, "An error occured at: ". getTimeNow() . "<\r\n>", FILE_APPEND);
    file_put_contents(LOG_FILE, "Error code: ". $errorCode . "<\r\n>", FILE_APPEND);
    file_put_contents(LOG_FILE, "Error Message: ". $errorMessage . "<\r\n>", FILE_APPEND);
    file_put_contents(LOG_FILE, "Filename: ". $errorFile . "<\r\n>", FILE_APPEND);
    file_put_contents(LOG_FILE, "Line: ". $errorLine . "<\r\n>", FILE_APPEND);
    
    die("An error occured<br>");
}

function getTimeNow(){
    $today = date("D M j G:i:s T Y");    
    return $today;
}

function manageException($exception)
{
   

    file_put_contents(LOG_FILE, "An exception occured at YY MM DD " . getTimeNow().".", FILE_APPEND);
    file_put_contents(LOG_FILE, "Exception code: ". $exception->getCode() . "<\r\n>", FILE_APPEND);
    file_put_contents(LOG_FILE, "Exception Message: ". $exception->getMessage() . "<\r\n>", FILE_APPEND);
    file_put_contents(LOG_FILE, "Filename: ". $exception->getFile() . "<\r\n>", FILE_APPEND);
    file_put_contents(LOG_FILE, "Line: ". $exception->getLine() . "<\r\n>", FILE_APPEND);
    
     die("An exception occured<br>");
    
}



function getCommandPrintType(){
    echo BODY_TYPE_NOCOMMAND;
    if(isset($_GET["command"]))
        {
            if($_GET["command"] == 'print')
            {
    
                    echo BODY_TYPE_COMMAND;
            }
        }

}

function getCheatSheet(){
    $cheatSeat = DATA_FOLDER.  "cheatSheet.docx";
    ?>
    <p><a href="<?php echo $cheatSeat ?>" download>Download Cheat Sheet</a></p>
    <?php
}

function getSubtotalColor($value){
    if(isset($_GET["command"]))
        {
            if($_GET["command"] == 'color')
            {
                if($value < 100){
                    echo "red";
                }
                elseif($value <= 999){
                    echo "orange";
                }
                else{
                    echo "green";
                }

            }
        }
        else{
            echo "";
        }
}?>