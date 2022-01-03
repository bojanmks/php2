<?php
    function getSliderImages() {
        return executeQuery("SELECT * FROM slider_images");
    }
?>