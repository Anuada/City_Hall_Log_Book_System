<?php

class Misc
{
    public static function lastIndex($string)
    {
        $stringCount = strlen($string);
        $i = $stringCount - 1;
        return $string[$i];
    }

    public static function url($route = null, $fragments = null)
    {
        $http_protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $project_folder = basename(dirname(__DIR__));
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestPathFrag = $_SERVER['REQUEST_URI'];

        if ($route != null) {
            if ($host == 'localhost' || filter_var($host, FILTER_VALIDATE_IP)) {
                return $http_protocol . '://' . $host . '/' . $project_folder . '/' . $route;
            }
            return $http_protocol . '://' . $host . '/' . $route;
        } elseif ($fragments != null && $fragments == true) {
            return $http_protocol . "://" . $host . $requestPathFrag;
        }
        return $http_protocol . "://" . $host . $requestPath;
    }

    public static function uploadImage($file, $filename, $filedir)
    {
        $img_name = $filename . ".png";
        $img_file = $filedir . $img_name;
        move_uploaded_file($file["tmp_name"], $img_file);

        return $img_file;
    }

    public static function displayEnums(array $enums)
    {
        return array_column($enums, 'value');
    }

}