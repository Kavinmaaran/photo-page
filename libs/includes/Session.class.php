<?php

class Session
{
    public static function start()
    {
        return session_start();
    }
    public static function destroy()
    {
        if (Session::get('is_loggedin') == 1) {
            $token = Session::get('session_token');
            $query = "UPDATE `session` SET `active` = '0' WHERE `token` = '$token'";
            $conn = Database::getConnection();
            $result = $conn->query($query);
            if ($result) {
                session_destroy();
                return true;
            } else {
                return false;
            }
        }
    }
    public static function unset()
    {
        return session_unset();
    }
    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($key);
        }
    }
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function isset($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function get($key, $default=false)
    {
        if (Session::isset($key)) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }
}
