<?php
session_start();

class User extends Model
{
    public static function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }
}

?>