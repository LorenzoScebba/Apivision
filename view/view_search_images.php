<div class="container">
    <?php

    $connection = mysqli_connect($ini["dbname"], $ini["dbusername"], $ini["dbpassword"], $ini["dbtable"]);
    if (!$connection) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        die();
    }

    $desc = "";
    if (isset($_GET['search'])) {
        $desc = $_GET['search'];
    }

    $desc = "%$desc%";

    $sql ="Select path from img where description like ? OR tags like ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("ss",$desc,$desc);
    $statement->execute();
    $result = $statement->get_result();

    $images = array();

    while ($row = $result->fetch_assoc()) {
        array_push($images, $row["path"]);
    }

    if (!empty($images)) {
        foreach ($images as $image) {
            $description = "";
            $sql = "Select * from img where path = ?";
            $statement = $connection->prepare($sql);
            $statement->bind_param("s",$image);
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            $description = $description . $row["description"] . "<br>";
            //$description = $description.$row["tags"];
            echo "<figure class=\"figure\" style='margin: 0 5px;'>
          <a href='$image' target='_blank'><img src=\"$image\" class=\"figure-img img-fluid rounded\" style='height: 200px;'></a>
          <figcaption class=\"figure-caption\">$description</figcaption>
          </figure>";

        }
    }else{
        echo "No results found :(";
    }
    ?>
</div>
