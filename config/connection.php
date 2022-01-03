<?php
    require_once('config.php');
    try {
        $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        echo("Connection error: " . $ex->getMessage());
    }

    function executeQuery($query) {
        global $conn;
        return $conn->query($query)->fetchAll();
    }

    function getDateAndTime() {
        return date("d-m-Y H:i:s");
    }

    updateLog();
    function updateLog() {
        $file = fopen(LOG_FILE, "a");
        if($file) {
            isset($_SESSION['user']) ? $userId = $_SESSION['user']->id : $userId = NULL;
            $page = $_SERVER['PHP_SELF'];
            $subPage = '';
            if(isset($_GET['p'])) $subPage = $_GET['p'];
            else if(strpos($page, '/index.php') !== false) $subPage = 'home';
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $text = $userId . SEPARATOR . $page . SEPARATOR . $subPage . SEPARATOR . $ipAddress . SEPARATOR . getDateAndTime() . "\n";
            fwrite($file, $text);
            fclose($file);
        }
    }

    function updateErrorLog($message) {
        $file = fopen(ERROR_LOG, "a");
        if($file) {
            $page = $_SERVER['PHP_SELF'];
            if(isset($_GET['p'])) {
                $page .= "?p=" . $_GET['p'];
                if(isset($_GET['ap'])) {
                    $page .= "&ap=" . $_GET['ap'];
                }
            }
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $text = $page . SEPARATOR . $ipAddress . SEPARATOR . getDateAndTime() . SEPARATOR . $message . "\n";
            fwrite($file, $text);
            fclose($file);
        }
    }

    function getTime($fullDate) {
        $dateAndTime = explode(" ", $fullDate); 

        $date = explode("-", $dateAndTime[0]);
        $time = explode(":", $dateAndTime[1]);

        $hour = intval($time[0]);
        $minute = intval($time[1]);
        $second = intval($time[2]);

        $day = intval($date[0]);
        $month = intval($date[1]);
        $year = intval($date[2]);

        return mktime($hour, $minute, $second, $month, $day, $year);
    }
?>