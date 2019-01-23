<?php

class User extends Model
{
    public function createAdmin()
    {
        $login = 'admin';
        $pass = hash('sha256', '123');
        if ($mysqli = $this->connectDb()) {
            $query = "INSERT INTO user (`login`, `password`) VALUES (?,?)";
            $stmt = $mysqli->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ss", $login, $pass);
                $stmt->execute();
                $stmt->close();
                $mysqli->close();
                return true;
            }
        }
        return false;
    }


    public function check($login, $password)
    {
        if ($mysqli = $this->connectDb()) {
            $query = "SELECT * FROM user WHERE `login` = '$login'";
            if ($result = $mysqli->query($query)) {
                if ($result) {
                    $array = $result->fetch_assoc();
                    $result->close();
                    $mysqli->close();
                    if ($array['password'] == hash('sha256', $password)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

}
