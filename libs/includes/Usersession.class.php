<?php

class UserSession
{
    public function __construct($token)
    {
        $this->conn = Database::getConnection();
        $this->token = $token;
        $this->data = null;
        $query = "SELECT * FROM `session` WHERE `token`= '$token' LIMIT 1";
        $result = $this->conn->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid'];
            return true;
        } else {
            // throw new Exception("Session construction Failure.");
            return false;
        }
    }
    public static function authenticate($user, $pass)
    {
        $username = User::login($user, $pass);
        $user = new User($username);
        
        if ($username) {
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(rand(0, 9999999).$ip.$agent.time());
            $query = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `agent`, `active`)
            VALUES ('$user->id', '$token', now(), '$ip', '$agent', '1');";
            if ($conn->query($query)) {
                Session::set('session_token', $token);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function authorize($token)
    {
        if ($sess = new UserSession($token)) {
            if ($token == $sess->data['token']) {
                if ($sess->isValid()) {
                    return true;
                } else {
                    // throw new Exception("Invalid Session");
                    return false;
                }
            } else {
                // throw new Exception("Invalid token");
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUser()
    {
        return new User($this->uid);
    }

    /**
     * Check if the validity of the session is within one hour, else it inactive.
     *
     * @return boolean
     */
    public function isValid()
    {
        if ($this->data['active']) {
            $timeDiff = strtotime(date('y-m-d h:i:s')) - strtotime($this->data['login_time']);
            if (!($this->getIP() == $this->data['ip'])) {
                echo($this->data['ip']);
                return false;
            }
            if (!($this->getUserAgent() == $this->data['agent'])) {
                return false;
            }
            if ($timeDiff < 3600) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getIP()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public function deactivate()
    {
        if (!$this->conn) {
            $this->conn=Database::getConnection();
        }
        $query = "UPDATE `session` SET `active` = '0' WHERE `token` = '$this->token';";
        $result = $this->conn->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
