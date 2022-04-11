<?php
$username=$_POST["usr_email"];
$passwd=$_POST["passwd"];
?>
<?php
if (validate_credentials($username, $passwd)) {
    ?>
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">LOGIN SUCCESS</h1>
        <p class="lead">Pin a footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS.
        </p>
    </div>
</main>
<?php
} else {?>
<main class="form-signin">
    <form action="login.php" method="post">
        <img class="mb-4"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHLCfQ8vAi5g-bib1x8iANL5heysMc-OEIZ_yWiZDucZfOfhUgyE0lZU32XVuGWfDMejk&amp;usqp=CAU"
            alt="" width="" height="100" style="margin-left: auto;margin-right: auto;display: block;">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input name="usr_email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input name="passwd" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary hvr-buzz-out" type="submit">Sign in</button>
    </form>
</main>

<?}
    ?>