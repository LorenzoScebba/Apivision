<!DOCTYPE HTML>
<html>
<head>
    <title>Api vision</title>
    <?php include 'model/css.php' ?>
    <?php include 'model/config.php' ?>
</head>
<body>
<main>
    <?php include 'view/view_nav.php' ?>
    <div class="container">
        <p class="text-center">
            You can use the api by doing a GET request on the webpage<a
                    href="Api/index.php"> <?php echo($url !== null ? "http://" . $url . "/Api/" : "http://localhost/APIVision/Api") ?></a>
        </p>
        <p>Requested <B>GET</B> Parameters </p>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">hello*</th>
                <td>true</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">type</th>
                <td>all</td>
                <td>racist</td>
                <td>adult</td>
                <td>both</td>
            </tr>
            <tr>
                <th scope="row">desc</th>
                <td>dog</td>
                <td>hat</td>
                <td>park</td>
                <td>why the fork am i doing DISS</td>
            </tr>
            <tr>
                <th scope="row">limit</th>
                <td>1</td>
                <td>5</td>
                <td>10</td>
                <td>...</td>
            </tr>
            </tbody>
        </table>
        <p>
            <small>Needed parameters are marked with a <b>*</b></small>
        </p>
        <hr>
        <p><h4>Examples</h4></p>
        <p>
        <li>All Images :</li>
        <br>
        <code><?php echo($url !== null ? "http://" . $url . "/Api/" : "http://localhost/APIVision/Api") ?>?hello=true</code>
        <samp>
                <pre>
[
    {
        "id": "1",
        "path": "https://aristogattibd22.blob.core.windows.net/vision/1068221728spaghetti.jpg",
        "isAdult": "0",
        "isRacist": "0",
        "description": "a dog wearing a hat"
    },
    {
        "id": "2",
        "path": "https://aristogattibd22.blob.core.windows.net/vision/17260644776fb1c0db4d3713dd607b29bc1fcf6431.jpg",
        "isAdult": "0",
        "isRacist": "0",
        "description": "a cat that is looking at the camera"
    },
    {
        "id": "3",
        "path": "https://aristogattibd22.blob.core.windows.net/vision/544394130ab9.jpg",
        "isAdult": "0",
        "isRacist": "0",
        "description": "a dog wearing a hat"
    }
]
                </pre>
        </samp>
        </p>
        <p>
        <li>All Images that contains dogs :</li>
        <br>
        <code><?php echo($url !== null ? "http://" . $url . "/Api/" : "http://localhost/APIVision/Api") ?>?hello=true&desc=dog</code>
        <samp>
                <pre>
[
    {
        "id": "1",
        "path": "https://aristogattibd22.blob.core.windows.net/vision/1068221728spaghetti.jpg",
        "isAdult": "0",
        "isRacist": "0",
        "description": "a dog wearing a hat"
    },
    {
        "id": "3",
        "path": "https://aristogattibd22.blob.core.windows.net/vision/544394130ab9.jpg",
        "isAdult": "0",
        "isRacist": "0",
        "description": "a dog wearing a hat"
    }
]
                </pre>
        </samp>
        </p>

    </div>
</main>
<?php include 'view/view_footer.php' ?>
</body>
<?php include 'model/js.php' ?>
</html>