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

if($offset>0)
    $offset*=10;

$connection = mysqli_connect($ini["dbname"], $ini["dbusername"], $ini["dbpassword"], $ini["dbtable"]);
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    die();
}

$result = $connection->query("Select path from img where 1 Limit 10 offset $offset");
$images = array();

while($row = $result->fetch_assoc()){
    array_push($images, $row["path"]);
}

foreach ($images as $image) {
    $description = "";
    $sql = "Select * from img where path = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("s",$image);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    $description = $description . $row["description"];
    echo "<figure class=\"figure\" style='margin: 0 5px;'>
          <a href='$image' target='_blank'><img src=\"$image\" class=\"figure-img img-fluid rounded\" style='height: 200px;'></a>
          <figcaption class=\"figure-caption\">$description</figcaption>
          </figure>";

}
?>
</div>
