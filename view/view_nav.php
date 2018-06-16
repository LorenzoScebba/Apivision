<nav style="margin-top:16px">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Home Page</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="api.php">Api</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="code.php">Code Snippets</a>
        </li>


        <?php
        if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] === true) {
            ?>


            <li class="nav-item">
                <a class="nav-link active" href="upload.php">Upload image</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="logout.php">Logout</a>
            </li>

        <?php } else { ?>


            <li class="nav-item">
                <a class="nav-link active" href="login.php">Login</a>
            </li>

        <?php } ?>

        <form class="form-inline" method="get" action="search.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" autocomplete="off" pattern=".{3,}" title="Insert at least 3 characters" required>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </ul>
</nav>
<hr>
<!--<h3 class="text-center ">-->
<!--    --><?php
//    if (isset($_SESSION["username"]) && $_SESSION["username"] !== null) {
//        echo "Welcome back " . $_SESSION["username"];
//    } else {
//        echo "Hello Guest!";
//    }
//    ?>
<!--</h3>-->
<br>