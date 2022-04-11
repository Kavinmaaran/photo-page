<?php
include 'libs/load.php';
// print("_SESSION \n<br>");
// print_r($_SESSION);

$user = "fooboo1";
$pass = isset($_GET['pass']) ? $_GET['pass'] : '';

// $user = "kavin33";
// $pass = "kavin123";

// $user = "fooboo1";
// $pass = "password";

if (isset($_GET['logout'])) {
    if (Session::destroy()) {
        die("Session destroyed, <a href='logintest.php'>Login Again</a>");
    } else {
        return "Logout Failed";
    }
}
if (Session::get('session_token')) {
    $token = Session::get('session_token');
} else {
    $token = null;
}

if (UserSession::authorize($token)) {
    $username = Session::get('session_username');
    $userobj = new User($username);
    print("Welcome Back ".$userobj->getFirstname());
    $userobj->setBio("Making new things...");
} else {
    printf("No session found, trying to login now. <br>");
    $token = UserSession::authenticate($user, $pass);
    
    if ($token) {
        $userobj = new User($user);
        echo "Login Success ", $userobj->getUsername();
        Session::set('is_loggedin', true);
        Session::set('session_username', $userobj->username);
        Session::set('session_token', $token);
    } else {
        echo "Login failed, $user <br>";
    }
}

echo <<<EOL
<br><br><a href="logintest.php?logout">Logout</a>
EOL;



























// if (isset($_GET['logout'])) {
//     Session::destroy();
//     die("Session destroyed, <a href='logintest.php'>Login Again</a>");
// }

// if (Session::get('is_loggedin')) {
//     $username = Session::get('session_username');
//     $userobj = new User($username);
//     print("Welcome Back ".$userobj->getFirstname());
//     print("<br>".$userobj->getBio());
//     $userobj->setBio("Making new things...");
//     print("<br>".$userobj->getBio());
// } else {
//     printf("No session found, trying to login now. <br>");
//     $result = User::login($user, $pass);
//     //print_r($result);
    
//     if ($result) {
//         $userobj = new User($user);
//         echo "Login Success ", $userobj->getUsername();
//         Session::set('is_loggedin', true);
//         Session::set('session_username', $result);
//     } else {
//         echo "Login failed, $user <br>";
//     }
// }

// echo <<<EOL
// <br><br><a href="logintest.php?logout">Logout</a>
// EOL;
