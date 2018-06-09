<?php
/**
 * Created by PhpStorm.
 * User: l.scebba
 * Date: 01/06/2018
 * Time: 09:25
 */

session_start();
$ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/../cgi-bin/config.ini",false,INI_SCANNER_RAW);
$url = $ini["url"];
$connection = mysqli_connect($ini["dbname"], $ini["dbusername"], $ini["dbpassword"], $ini["dbtable"]);
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    die();
}

$username = $_POST["username"];
$password = sha1($_POST["password"]);

$result = $connection->query("Select * from user where username = '$username' and password = '$password'");
if($result->num_rows > 0){
    //User exist
    $_SESSION["isLoggedIn"] = true;
    $_SESSION["username"] = $username;
    header("Location: http://$url/index.php");
}else{
    echo "Error loggin in";
    die();
}