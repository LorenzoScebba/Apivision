<?php
/**
 * Created by PhpStorm.
 * User: Lorenzo
 * Date: 05/06/2018
 * Time: 18:11
 */

$error_400 = (array('error' => true, 'code' => '400','suggestion' => "try something else :("));
$error_401 = (array('error' => true, 'code' => '401','suggestion' => "try setting the hello parameter to true"));
$ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/../cgi-bin/config.ini",false,INI_SCANNER_RAW);

header("Content-Type: application/json");

if (!isset($_GET["hello"]) || $_GET["hello"] !== "true") {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode($error_401,JSON_PRETTY_PRINT);
    exit;
}

$response = array();

$connection = mysqli_connect($ini["dbname"], $ini["dbusername"], $ini["dbpassword"], $ini["dbtable"]);
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    die();
}

$type = "1";
if (isset($_GET["type"])) {
    switch ($_GET["type"]) {
        case "all":
            $type = "1";
            break;
        case "adult":
            $type = "isAdult = 1";
            break;
        case "racist":
            $type = "isRacist = 1";
            break;
        case "both":
            $type = "isAdult = 1 OR isRacist = 1";
            break;
    }
}

$desc="";

if(isset($_GET['desc'])){
    $desc=$_GET['desc'];
}

$limit = "0,18446744073709551615";
if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
    $limit = $_GET["limit"];
}

$sql = "Select * from img where " . $type ." and description like '%$desc%'". " limit " . $limit;
$result = $connection->query($sql);

while($row = $result->fetch_assoc()){
    array_push($response,$row);
}

if(empty($response))
    $response=$error_400;

echo json_encode($response,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
