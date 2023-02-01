<?php
class Helper
{
    public static function redirect($page)
    {
        header("Location:$page");
    }

    public static function filter($str)
    {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }
}
