<div class="container">
    <main>
        <form action="controller/checkLogin.php" method="post">
            <div class="form-group">
                <label for="username">Username : </label>
                <input type="text" name="username" id="username" class="form-control" autocomplete="off" placeholder="Username">
                <small id="usernameHelp" class="form-text text-muted">Set your username right here!
                </small>
            </div>
            <div class="form-group">
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                <small id="passwordHelp" class="form-text text-muted">We'll never share your password with others (MAYBE)
                </small>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </main>
</div>