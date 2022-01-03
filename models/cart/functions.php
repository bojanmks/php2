<?php
    function addToCart($userId, $phoneId, $quantity) {
        global $conn;
        $cart = alreadyIsInCart($userId, $phoneId);
        try {
            if($cart) {
                $quantity += $cart->quantity;
                $exec = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
                $result = $exec->execute([$quantity, $cart->id]);
            } else {
                $exec = $conn->prepare("INSERT INTO cart(user_id, phone_id, quantity) VALUES (?, ?, ?)");
                $result = $exec->execute([$userId, $phoneId, $quantity]);
            }
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function alreadyIsInCart($userId, $phoneId) {
        global $conn;
        $exec = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND phone_id = ?");
        $exec->execute([$userId, $phoneId]);
        return $exec->fetch();
    }

    function getCartQuantity($userId) {
        global $conn;
        $exec = $conn->prepare("SELECT IFNULL(SUM(quantity), 0) as quantity FROM cart WHERE user_id = ?");
        $exec->execute([$userId]);
        $result = $exec->fetch();
        return $result->quantity;
    }

    function getCart($userId) {
        global $conn;
        $exec = $conn->prepare("SELECT c.id, c.quantity, p.name, p.price, p.id AS phone_id FROM cart c INNER JOIN phones p ON c.phone_id = p.id WHERE c.user_id = ? AND p.active = 1");
        $exec->execute([$userId]);
        $result = $exec->fetchAll();
        return $result;
    }

    function changeQuantity($id, $change) {
        $quantity = getItemQuantity($id);
        if(!$quantity) return false;
        switch($change) {
            case 'increase':
                $quantity++;
                break;
            case 'decrease':
                if($quantity > 1) $quantity--;
                break;
        }
        try {
            global $conn;
            $exec = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
            $result = $exec->execute([$quantity, $id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function getItemQuantity($id) {
        global $conn;
        $exec = $conn->prepare("SELECT quantity FROM cart WHERE id = ?");
        $exec->execute([$id]);
        $result = $exec->fetch();
        if($result) return $result->quantity;
        return false;
    }

    function removeItem($id) {
        try {
            global $conn;
            $exec = $conn->prepare("DELETE FROM cart WHERE id = ?");
            $result = $exec->execute([$id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function createOrder($userId, $name, $address, $cart) {
        $totalPrice = 0;
        foreach($cart as $c) {
            $totalPrice += $c->quantity * $c->price;
        }

        try {
            global $conn;
            $conn->beginTransaction();
            $exec = $conn->prepare("INSERT INTO orders(user_id, total_price, name, address) VALUES (?, ?, ?, ?)");
            $exec->execute([$userId, $totalPrice, $name, $address]);
            $orderId = $conn->lastInsertId();
            foreach($cart as $c) {
                $exec = $conn->prepare("INSERT INTO order_details(order_id, phone_id, quantity) VALUES (?, ?, ?)");
                $exec->execute([$orderId, $c->phone_id, $c->quantity]);
            }
            $conn->commit();
            clearCart($userId);
            return true;
        } catch (PDOException $ex) {
            $conn->rollBack();
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function clearCart($userId) {
        try {
            global $conn;
            $exec = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
            $result = $exec->execute([$userId]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }
?>