<?php

include_once("includes/Session.class.php");
include_once 'includes/Mic.class.php';
include_once 'includes/User.class.php';
include_once 'includes/Database.class.php';
include_once 'includes/Usersession.class.php';

global $__site_config;
//Note: Change this path if you run this code outside lab.
$__site_config = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../photogramconfig.json');
// echo "hii";
// $b = get_config("base_name");
// echo $b;
Session::start();

function get_config($key, $default=null)
{
    global $__site_config;
    $array = json_decode($__site_config, true);
    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}

function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT'].get_config("base_name")."_templates/$name.php";
}

function validate_credentials($username, $password)
{
    if ($username=="kavin@maaran" and $password=="kavin123") {
        return true;
    } else {
        return false;
    }
}

/*function signup($email, $pass, $user, $phone)
{
    $servername = "mysql.selfmade.ninja";
    $username = "kavin33";
    $password = "kavin098!@#";
    $dbname = "kavin33_myapp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql ="INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`)
    VALUES ('$user', '$pass', '$email', '$phone','1');";
    $result=false;
    if ($conn->query($sql) === true) {
        $result=true;
    } else {
        $result=$conn->connect_error;
    }

    $conn->close();
    return $result;
}*/
