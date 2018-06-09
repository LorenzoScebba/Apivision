<h1>
<?php
/**
 * Created by PhpStorm.
 * User: l.scebba
 * Date: 01/06/2018
 * Time: 11:18
 */
ini_set("error_reporting",0);
session_start();
$ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/../cgi-bin/config.ini",false,INI_SCANNER_RAW);
$url = $ini["url"];

if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
    header("HTTP/1.1 401 Unauthorized");
    echo "401 | Unauthorized";
    header( "refresh:2;url=http://$url/index.php" );
    die();
}

?>
</h1>
