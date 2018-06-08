<?php
/**
 * Created by PhpStorm.
 * User: l.scebba
 * Date: 01/06/2018
 * Time: 09:46
 */


// <editor-fold defaultstate="collapsed" desc="Settings">
require $_SERVER["DOCUMENT_ROOT"]."/APIVision". "/vendor/autoload.php";
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
include 'isLoggedIn.php';
include '../model/config.php';
ini_set('display_errors', '1');
// </editor-fold>
$ini = parse_ini_file("../config.ini",false,INI_SCANNER_RAW);
$url = $ini["url"];
// <editor-fold defaultstate="collapsed" desc="Get image and save it to img folder temp">

if (!isset($_FILES['image']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
    echo 'Non hai inviato nessun file...';
    die();
}

$uploaddir = $_SERVER["DOCUMENT_ROOT"]."/APIVision" . "/img/";
echo $uploaddir;
$userfile_tmp = $_FILES['image']['tmp_name'];
$userfile_name = rand(0,PHP_INT_MAX).$_FILES['image']['name'];

if (!move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
    echo 'Failed to upload image';
    die();
}

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Upload tmp image to blob">

$connectionString = "DefaultEndpointsProtocol=https;AccountName=aristogattibd22;AccountKey=".$ini["account_key"];
$blobClient = BlobRestProxy::createBlobService($connectionString);

$imgpath = $_SERVER["DOCUMENT_ROOT"]."/APIVision/img/" . $userfile_name;
$content = fopen($imgpath, "r");
$blobClient->createBlockBlob("vision", $userfile_name, $content);

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Is image racist?">

$request = curl_init();

curl_setopt($request, CURLOPT_URL, "https://westeurope.api.cognitive.microsoft.com/vision/v1.0" . "/analyze?visualFeatures=Description,Adult");
curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type: application/octet-stream', 'Ocp-Apim-Subscription-Key: ' . $ini["sub_key"]));
curl_setopt($request, CURLOPT_POSTFIELDS, file_get_contents($imgpath));
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($request);
$result = json_decode($result, true);
$desc = $result["description"];
$desc = $desc["captions"];
$desc = $desc[0]["text"];
$adult = $result["adult"];
$racist = $result["adult"];
if ($adult["isAdultContent"] == true) {
    $adult = 1;
} else {
    $adult = 0;
}
if ($racist["isRacyContent"] == true) {
    $racist = 1;
} else {
    $racist = 0;
}
$tagsArray = $result["description"]["tags"];
$tags = "";
foreach($tagsArray as $tag){
    $tags = $tags.$tag.",";
}



// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Insert image into db">

$connection = mysqli_connect($ini["dbname"], $ini["dbusername"], $ini["dbpassword"], $ini["dbtable"]);
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    die();
}
$path = "https://aristogattibd22.blob.core.windows.net/vision/" . $userfile_name;
$result = $connection->query("Insert into img(path,isAdult,isRacist,description,tags) VALUES('$path',$adult,$racist,'$desc','$tags')");

if ($result) {
    echo "Done!";
    header("Location: http://$url/upload.php");
    // <editor-fold defaultstate="collapsed" desc="Remove tmp image">
    array_map('unlink', glob("../img/" . $userfile_name));
    // </editor-fold>
} else {
    echo "Failed insert into db";
    // <editor-fold defaultstate="collapsed" desc="Remove tmp image">
    array_map('unlink', glob("../img/" . $userfile_name));
    // </editor-fold>
}

// </editor-fold>