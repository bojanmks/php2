<?php
    function sendMessage($email, $name, $message) {
        $userId = NULL;
        if(isset($_SESSION['user'])) {
            $userId = $_SESSION['user']->id;
        }
        $message = addslashes($message);
        global $conn;
        $exec = $conn->prepare("INSERT INTO contact_messages(user_id, email, name, message) VALUES (?, ?, ?, ?)");
        $result = $exec->execute([$userId, $email, $name, $message]);
        return $result;
    }
?>