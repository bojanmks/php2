<?php
    function getAllPhones() {
        return executeQuery("SELECT p.id AS phone_id, p.name AS phone_name, price, active, b.name AS brand_name, os.name AS os_name FROM phones p INNER JOIN brands b ON p.brand = b.id INNER JOIN operating_systems os ON p.os = os.id ORDER BY p.name");
    }

    function getBrands() {
        return executeQuery("SELECT * FROM brands ORDER BY name");
    }

    function getOperatingSystems() {
        return executeQuery("SELECT * FROM operating_systems ORDER BY name");
    }

    function getPhoneById($id) {
        global $conn;
        $exec = $conn->prepare("SELECT * FROM phones WHERE id = ?");
        $exec->execute([$id]);
        return $exec->fetch();
    }

    function getBrandById($id) {
        global $conn;
        $exec = $conn->prepare("SELECT * FROM brands WHERE id = ?");
        $exec->execute([$id]);
        return $exec->fetch();
    }

    function getOSById($id) {
        global $conn;
        $exec = $conn->prepare("SELECT * FROM operating_systems WHERE id = ?");
        $exec->execute([$id]);
        return $exec->fetch();
    }
?>