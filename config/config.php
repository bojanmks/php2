<?php
    // absolute path
    define('ABSOLUTE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/mobishoptpo/");

    // files
    define('ENV_FILE', ABSOLUTE_PATH . 'config/.env');
    define('LOG_FILE', ABSOLUTE_PATH . 'data/log.txt');
    define('ERROR_LOG', ABSOLUTE_PATH . 'data/error_log.txt');
    define('LOGIN_LOG', ABSOLUTE_PATH . 'data/login_log.txt');
    define('SEPARATOR', "\t");

    // db
    define('SERVER', env('SERVER'));
    define('DATABASE', env('DATABASE'));
    define('USERNAME', env('USERNAME'));
    define('PASSWORD', env('PASSWORD'));
    
    function env($keyword) {
        $file = file(ENV_FILE);
        foreach($file as $line) {
            $line = trim($line);
            $lineContent = explode('=', $line);
            if($lineContent[0] == $keyword) {
                return $lineContent[1];
            }
        }
    }
?>