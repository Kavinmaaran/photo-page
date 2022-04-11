<?php
class User
{
    private $conn;
    public function __construct($username)
    {
        if (!$this->conn) {
            $this->conn=Database::getConnection();
        }
        $this->username = $username;
        $this->id = null;
        $query = "SELECT `id` FROM `auth` WHERE `username` = '$username' LIMIT 1";
        $result = $this->conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
        } else {
            throw new Exception("Username invalid");
        }
    }

    public static function signup($email, $pass, $user, $phone)
    {
        $options = ['cost' => 9, ];
        $pass = password_hash($pass, PASSWORD_BCRYPT, $options);
        $conn=Database::getConnection();
        $sql ="INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`)
               VALUES ('$user', '$pass', '$email', '$phone','1');";
        $error=false;
        if ($conn->query($sql) === true) {
            $error=false;
        } else {
            $error=$conn->connect_error;
        }

        //$conn->close();
        return $error;
    }

    public static function login($user, $pass)
    {
        //$pass = md5(strrev(md5($pass)));
        $query = "SELECT * FROM `auth` WHERE `username` = '$user'";
        $conn = Database::getConnection();
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            //if ($row['password'] == $pass) {\
            if (password_verify($pass, $row['password'])) {
                return $row['username'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        if (substr($name, 0, 3) == 'get') {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == 'set') {
            return $this->_set_data($property, $arguments[0]);
        } else {
            throw new Exception("User::__call() -> $name, function unavailable.");
        }
    }

    public function _get_data($var)
    {
        if (!$this->conn) {
            $this->conn=Database::getConnection();
        }
        $query = "SELECT `$var` FROM `users` WHERE `id` = $this->id LIMIT 1;";
        $result = $this->conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row["$var"];
        } else {
            return null;
        }
    }

    public function _set_data($var, $data)
    {
        if (!$this->conn) {
            $this->conn=Database::getConnection();
        }
        $query = "UPDATE `users` SET `$var` = '$data' WHERE `id` = $this->id;";
        $result = $this->conn->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function setDob($year, $month, $day)
    {
        if (checkdate($month, $day, $year)) { //checking data is valid
            return $this->_set_data('dob', "$year.$month.$day");
        } else {
            return false;
        }
    }
    public function getUsername()
    {
        return $this->username;
    }


    // public function __construct($username)
    // {
    //     $this->conn=Database::getConnection();
    //     $this->conn->query();
    // }
    
    // public function authenticate()
    // {
    // }

    // public function setBio()
    // {
    // }

    // public function getBio()
    // {
    // }

    // public function setAvatar()
    // {
    // }

    // public function getAvatar()
    // {
    // }
}
