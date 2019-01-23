<?php

class Model
{
    public function connectDb()
    {
        $mysqli = new mysqli('127.0.0.1', 'admin', '123', 'beejee');
        if ($mysqli->connect_error) {
            echo "Database connect error";
            return false;
        }
        return $mysqli;
    }
}