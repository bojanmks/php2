<?php
    function getNavLinks() {
        return executeQuery("SELECT * FROM page_links pl INNER JOIN link_categories lc ON pl.link_category = lc.lc_id WHERE lc.name = 'nav'");
    }
?>