<?php
    function displayMessages() {
        $text = "";
        if(isset($_SESSION['messages'])) {
            $text .= '<div class="alert alert-info">';
            foreach($_SESSION['messages'] as $key=>$m) {
                if($key > 0) $text .= '<br/>';
                $text .= "<p class='text-info text-center m-0'>$m</p>";
            }
            $text .= '</div>';
            unset($_SESSION['messages']);
        }
        if(isset($_SESSION['errors'])) {
            $text .= '<div class="alert alert-danger">';
            foreach($_SESSION['errors'] as $key=>$e) {
                if($key > 0) $text .= '<br/>';
                $text .= "<p class='text-danger text-center m-0'>$e</p>";
            }
            $text .= '</div>';
            unset($_SESSION['errors']);
        }
        echo($text);
    }
?>