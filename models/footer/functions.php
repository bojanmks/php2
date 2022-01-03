<?php
    function getFooterLinks() {
        return executeQuery("SELECT * FROM footer_links");
    }
?>