<div class="container">
<?php

$connection = mysqli_connect($ini["dbname"], $ini["dbusername"], $ini["dbpassword"], $ini["dbtable"]);
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    die();
}

$result = $connection->query("Select path from img where 1");
$images = array();

while($row = $result->fetch_assoc()){
    array_push($images, $row["path"]);
}

foreach ($images as $image) {
    $description = "";
    $result = $connection->query("Select * from img where path = '$image'");
    $row = $result->fetch_assoc();
    $description = $description . $row["description"];
    echo "<figure class=\"figure\" style='margin: 0 5px;'>
          <a href='$image' target='_blank'><img src=\"$image\" class=\"figure-img img-fluid rounded\" style='height: 200px;'></a>
          <figcaption class=\"figure-caption\">$description</figcaption>
          </figure>";

}
?>
</div>
