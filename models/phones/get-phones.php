<?php
    require_once("../../config/connection.php");
    // creating the query
    $query = "SELECT * FROM phones WHERE active = 1";
    $params = [];
    if(isset($_GET['search'])) {
        $query .= " AND name LIKE ?";
        $search = "%" . $_GET['search'] . "%";
        array_push($params, $search);
    }
    if(isset($_GET['os'])) {
        $placeholders = implode(',', array_fill(0, count($_GET['os']), '?'));
        $query .= " AND os IN ($placeholders)";
        foreach($_GET['os'] as $os) {
            array_push($params, $os);
        }
    }
    if(isset($_GET['brand'])) {
        $placeholders = implode(',', array_fill(0, count($_GET['brand']), '?'));
        $query .= " AND brand IN ($placeholders)";
        foreach($_GET['brand'] as $brand) {
            array_push($params, $brand);
        }
    }
    if(isset($_GET['maxPrice'])) {
        if(preg_match("/^[0-9]+(\.[0-9]*)?$/", $_GET['maxPrice'])) {
            $query .= " AND price <= ?";
            $maxPrice = floatval($_GET['maxPrice']);
            array_push($params, $maxPrice);
        }
    }
    $orderValues = ['1', '2', '3', '4'];
    if(isset($_GET['order'])) {
        $order = $_GET['order'];
        if(in_array($order, $orderValues)) {
            $text = '';
            switch($order) {
                case '1':
                    $text = "name";
                    break;
                case '2':
                    $text = "name DESC";
                    break;
                case '3':
                    $text = "price";
                    break;
                case '4':
                    $text = "price DESC";
                    break;
            }
            $query .= " ORDER BY $text";
        }
    }
    // executing the query
    global $conn;
    $exec = $conn->prepare($query);
    $exec->execute($params);
    $result = $exec->fetchAll();
    $numberOfPhones = count($result);
    // getting only 6 phones
    $phonesPerPage = $_GET['phonesPerPage'];
    $page = ($_GET['page'] - 1) * $phonesPerPage;
    $phones = [];
    for($i = $page; $i < $phonesPerPage + $page; $i++) {
        if($i >= count($result)) break;
        array_push($phones, $result[$i]);
    }
    // response
    $response = ['phones' => $phones, 'numberOfPhones' => $numberOfPhones];
    http_response_code(200);
    header("Content-type: application/json");
    echo(json_encode($response));
?>