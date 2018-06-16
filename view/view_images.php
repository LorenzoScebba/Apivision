<div class="container">
<?php
$offset = 0;
if(isset($_GET["page"])){
    if(is_numeric($_GET["page"])){
        $offset = $_GET["page"];
    }else{
        $offset = 0;
    }
}
$page = $offset;
if($offset>0)
    $offset*=10;

$connection = mysqli_connect($ini["dbname"], $ini["dbusername"], $ini["dbpassword"], $ini["dbtable"]);
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    die();
}

$count = $connection->query("Select count(*) as cnt from img");
$count = $count->fetch_assoc();
$count = $count["cnt"];
if($offset > $count){
    $offset = intval($count/10);
    $page = $offset;
    $_GET["page"] = $page;
    $offset = $offset*10;
}

$result = $connection->query("Select * from img where 1 Limit 10 offset $offset");
$images = array();

while($row = $result->fetch_assoc()){
    array_push($images, array($row["path"],$row["description"]));
}

foreach ($images as $image) {
    echo "<figure class=\"figure\" style='margin: 0 5px;'>
          <a href='$image[0]' target='_blank'><img src=\"$image[0]\" class=\"figure-img img-fluid rounded\" style='height: 200px;'></a>
          <figcaption class=\"figure-caption\">$image[1]</figcaption>
          </figure>";

}
?>
    <br><br>
    <div class="text-center">
        <a class="btn btn-primary <?php if($page == 0) echo "disabled" ?>" href="?page=<?php echo $page-1 ?>"><b>Previous Page</b></a>
        <a class="btn btn-primary <?php if($page > 0 && sizeof($images) < 10) echo "disabled" ?>" href="?page=<?php echo $page+1 ?>"><b>Next Page</b></a>
    </div>
</div>

