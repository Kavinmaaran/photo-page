<?php

$signup=false;

if (isset($_POST['usr_email']) and isset($_POST['passwd']) and isset($_POST['username']) and isset($_POST['phone'])) {
    $usr_email=$_POST['usr_email'];
    $passwd=$_POST['passwd'];
    $username=$_POST['username'];
    $phone=$_POST['phone'];
    $signup=true;
    $error=User::signup($usr_email, $passwd, $username, $phone);
}
if ($signup) {
    if (!$error) {?>
<main class="container">
    <div class="bg-light p-5 rounded">
        <h1>SIGNUP SUCCESS</h1>
        <a class="btn btn-lg btn-primary" href="/my-app/login.php" role="button">Click here to LOGIN »</a>
    </div>
</main>
<?php
    } else {?>
<main class="container1">
    <div class="bg-light p-5 rounded mt-3">
        <h1>Signup Fail</h1>
        <p class="lead">Something went wrong, <?=$error?>
        </p>
    </div>
</main>
<?php
}
} else {
    ?>
<main class="form-signup">
    <form action="signup.php" method="post">
        <img class="mb-4"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHLCfQ8vAi5g-bib1x8iANL5heysMc-OEIZ_yWiZDucZfOfhUgyE0lZU32XVuGWfDMejk&amp;usqp=CAU"
            alt="" width="" height="100" style="
    display: block;
    margin: auto;
">
        <h1 class="h3 mb-3 fw-normal">Please Sign up</h1>

        <div class="form-floating">
            <input name="usr_email" type="email" class="form-control" id="floatingInputemail"
                placeholder="name@example.com">
            <label for="floatingInputemail">Email address</label>
        </div>
        <div class="form-floating">
            <input name="passwd" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
            <input name="username" type="text" class="form-control" id="floatingPasswordusername"
                placeholder="Password">
            <label for="floatingPasswordusername">Username</label>
        </div>
        <div class="form-floating">
            <input name="phone" type="text" class="form-control" id="floatingPasswordphone" placeholder="Password">
            <label for="floatingPasswordphone">Phone</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary hvr-buzz-out" type="submit">Sign up</button>
    </form>
</main>
<?php
}
