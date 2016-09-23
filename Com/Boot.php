<?php

/**
 * Debug Mode Enabled
 */
if (!DEBUG_MODE) {
    error_reporting("0");
} else {
    error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED);
}

/**
 * Main & Generic Functions
 */
function __autoload($className) {
    $classDir = str_replace("_", "/", $className);
    if (file_exists(FILE_PREFIX . "{$classDir}.php")) {
        require_once(FILE_PREFIX . "{$classDir}.php");
    } elseif (file_exists(FILE_PREFIX . "Modules/{$classDir}.php")) {
        require_once(FILE_PREFIX . "Modules/{$classDir}.php");
    } else {
        header("location:" . Com_Helper_Url::getInstance()->urlBase . "/as/error");
        exit;
    }
}

function get($name) {
    if (isset($_GET[$name])) {
        return $_GET[$name];
    } elseif (isset($_POST[$name])) {
        return $_POST[$name];
    } elseif (isset($_SESSION[$name])) {
        return $_SESSION[$name];
    } elseif (isset($_COOKIE[$name])) {
        return $_COOKIE[$name];
    } elseif (isset($_SERVER[$name])) {
        return $_SERVER[$name];
    } elseif (isset($_FILES[$name])) {
        return $_FILES[$name];
    }
    return "";
}

function set($name, $value, $type = "GET") {
    switch ($type) {
        case 'SERVER': {
                $_SERVER[$name] = $value;
                break;
            }
        case 'COOKIE': {
                $_COOKIE[$name] = $value;
                setcookie($name, $value, time() + 3600);
                break;
            }
        case 'SESSION': {
                $_SESSION[$name] = $value;
                break;
            }
        case 'POST': {
                $_POST[$name] = $value;
                break;
            }
        default: {
                $_GET[$name] = $value;
                break;
            }
    }
}

function generateCharacters($length) {
    $chars = "abcdefghijkmnopqrstuvwxyz0123456789";
    srand((double) microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i < $length) {
        $number = rand() % 35;
        $temp = substr($chars, $number, 1);
        $pass = $pass . $temp;
        $i++;
    }
    return strtoupper($pass);
}

function generateUrl($string) {
    $string = str_replace(" ", "-", strtolower($string));
    $string = str_replace("?", "", strtolower($string));
    $string = str_replace(",", "", strtolower($string));
    $string = str_replace(":", "", strtolower($string));
    $string = str_replace("!", "", strtolower($string));
    $string = str_replace(".", "", strtolower($string));
    $string = str_replace("...", "", strtolower($string));
    return filter_var($string, FILTER_SANITIZE_URL) . ".html";
}

function truncate($string, $limit, $break = ".", $pad = "...") {
    // return with no change if string is shorter than $limit
    if (strlen($string) <= $limit) {
        return $string;
    }

    // is $break present between $limit and the end of the string?
    if (false !== ($breakpoint = strpos($string, $break, $limit))) {
        if ($breakpoint < strlen($string) - 1) {
            $string = substr($string, 0, $breakpoint) . $pad;
        } else {
            $string = substr($string, 0, $limit) . $pad;
        }
    } else {
        $string = substr($string, 0, $limit) . $pad;
    }

    $string = substr($string, 0, $limit) . $pad;

    return restoreTags($string);
}

function restoreTags($input) {
    $opened = array();
    $matches = "";
    // loop through opened and closed tags in order
    if (preg_match_all("/<(\/?[a-z]+)>?/i", $input, $matches)) {
        foreach ($matches[1] as $tag) {
            if (preg_match("/^[a-z]+$/i", $tag, $regs)) {
                // a tag has been opened
                if (strtolower($regs[0]) != 'br') {
                    $opened[] = $regs[0];
                }
            } elseif (preg_match("/^\/([a-z]+)$/i", $tag, $regs)) {
                // a tag has been closed
                unset($opened[array_pop(array_keys($opened, $regs[1]))]);
            }
        }
    }

    // close tags that are still open
    if ($opened) {
        $tagstoclose = array_reverse($opened);
        foreach ($tagstoclose as $tag) {
            $input .= "</$tag>";
        }
    }

    return $input;
}

function getLatinDate($date) {
    $time = strtotime($date);
    $day = date("w", $time);
    switch ($day) {
        case 0: {
                $day = "Domingo";
                break;
            }
        case 1: {
                $day = "Lunes";
                break;
            }
        case 2: {
                $day = "Martes";
                break;
            }
        case 3: {
                $day = "Mi&eacute;rcoles";
                break;
            }
        case 4: {
                $day = "Jueves";
                break;
            }
        case 5: {
                $day = "Viernes";
                break;
            }
        case 6: {
                $day = "S&aacute;bado";
                break;
            }
    }
    $month = date("m", $time);
    switch ($month) {
        case 1: {
                $month = "Enero";
                break;
            }
        case 2: {
                $month = "Febrero";
                break;
            }
        case 3: {
                $month = "Marzo";
                break;
            }
        case 4: {
                $month = "Abril";
                break;
            }
        case 5: {
                $month = "Mayo";
                break;
            }
        case 6: {
                $month = "Junio";
                break;
            }
        case 7: {
                $month = "Julio";
                break;
            }
        case 8: {
                $month = "Agosto";
                break;
            }
        case 9: {
                $month = "Septiembre";
                break;
            }
        case 10: {
                $month = "Octubre";
                break;
            }
        case 11: {
                $month = "Noviembre";
                break;
            }
        case 12: {
                $month = "Diciembre";
                break;
            }
    }
    return $day . " " . date("d", $time) . " de " . $month . ", " . date("Y", $time);
}

function readDirectory($dir = "/") {
    $listDir = array();
    if ($handler = opendir($dir)) {
        while (($sub = readdir($handler)) !== FALSE) {
            if ($sub != "." && $sub != ".." && $sub != "Thumb.db") {
                if (is_file($dir . "/" . $sub)) {
                    $listDir[] = $sub;
                } elseif (is_dir($dir . "/" . $sub)) {
                    $listDir[$sub] = readDirectory($dir . "/" . $sub);
                }
            }
        }
        closedir($handler);
    }
    return $listDir;
}

function cast($destination, $sourceObject) {
    if (is_string($destination)) {
        $destination = new $destination();
    }
    $sourceReflection = new ReflectionObject($sourceObject);
    $destinationReflection = new ReflectionObject($destination);
    $sourceProperties = $sourceReflection->getProperties();
    foreach ($sourceProperties as $sourceProperty) {
        $sourceProperty->setAccessible(true);
        $name = $sourceProperty->getName();
        $value = $sourceProperty->getValue($sourceObject);
        if ($destinationReflection->hasProperty($name)) {
            $propDest = $destinationReflection->getProperty($name);
            $propDest->setAccessible(true);
            $propDest->setValue($destination, $value);
        } else {
            $destination->$name = $value;
        }
    }
    return $destination;
}
