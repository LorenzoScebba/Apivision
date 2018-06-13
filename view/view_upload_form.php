<div class="container">
    <main>
        <form action="controller/checkImage.php" method="post" enctype="multipart/form-data" multiple="multiple">
            <div class="form-group ">
                <label for="image">Image : </label>
                <input type="file" name="image" id="image" class="form-control" >
                <small id="passwordHelp" class="form-text text-muted">Upload your image here!
                </small>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </main>
</div>