<?php
    function getUser($column, $value) {
        global $conn;
        $exec = $conn->prepare("SELECT * FROM users u INNER JOIN roles r ON u.role = r.role_id WHERE $column = ?");
        $exec->execute([$value]);
        $result = $exec->fetch();
        return $result;
    }

    function registerUser($username, $email, $password) {
        try {
            $encPassword = md5($password);
            global $conn;
            $exec = $conn->prepare("INSERT INTO users(username, email, password, role) VALUES (?, ?, ?, 2)");
            $result = $exec->execute([$username, $email, $encPassword]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function updateLoginLog($userId, $result) {
        $file = fopen(LOGIN_LOG, 'a');
        if($file) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $text = $userId . SEPARATOR . $ipAddress . SEPARATOR . getDateAndTime() . SEPARATOR . $result . "\n";
            fwrite($file, $text);
            fclose($file);
        }
    }

    function getFailedAttempts($id, $minutes) {
        $attempts = 0;
        $currentTime = time();
        $file = file(LOGIN_LOG);
        foreach($file as $row) {
            $row = trim($row);
            $values = explode(SEPARATOR, $row);
            if(intval($values[0]) == $id) {          
                $loginTime = getTime($values[2]);
                if($currentTime - $loginTime <= 60 * $minutes && $values[3] == '0') {
                    $attempts++;
                }
            }
        }
        return $attempts;
    }

    function lockAccount($id) {
        try {
            global $conn;
            $exec = $conn->prepare("UPDATE users SET active = 0 WHERE id = ?");
            $result = $exec->execute([$id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function sendEmail($user) {
        $to = $user->email;
        $subject = 'Your account has been locked';
        $message = "Your account <b>$user->username</b> has been locked due to suspicious activity. To unlock your account, contact the website administrator.";
        $headers = "From: mobishop@noreply.com" . "\r\n" . "Content-Type: text/html; charset=ISO-8859-1\r\n";

        return mail($to, $subject, $message, $headers);
    }
?>