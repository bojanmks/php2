<?php
    function getAdminLinks() {
        return executeQuery("SELECT * FROM page_links pl INNER JOIN link_categories lc ON pl.link_category = lc.lc_id WHERE lc.name = 'admin'");
    }

    function getAllUsers() {
        return executeQuery("SELECT * FROM users u INNER JOIN roles r ON u.role = r.role_id");
    }

    function getAllBrands() {
        return executeQuery("SELECT * FROM brands");
    }

    function getAllOS() {
        return executeQuery("SELECT * FROM operating_systems");
    }

    function getAllOrders() {
        return executeQuery("SELECT * FROM orders o LEFT OUTER JOIN users u ON o.user_id = u.id");
    }

    function getAllMessages() {
        return executeQuery("SELECT message_id, u.username, cm.name, cm.email, message FROM contact_messages cm LEFT OUTER JOIN users u ON u.id = cm.user_id");
    }

    function deleteMessage($id) {
        try {
            global $conn;
            $exec = $conn->prepare("DELETE FROM contact_messages WHERE message_id = ?");
            $result = $exec->execute([$id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function deleteOrder($id) {
        try {
            global $conn;
            $conn->beginTransaction();
            $exec = $conn->prepare("DELETE FROM order_details WHERE order_id = ?");
            $result = $exec->execute([$id]);
            if($result) {
                $exec = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
                $result = $exec->execute([$id]);
                if($result) {
                    $conn->commit();
                }
            }
            return $result;
        } catch (PDOException $ex) {
            $conn->rollBack();
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function deleteOS($id) {
        try {
            global $conn;
            $exec = $conn->prepare("SELECT * FROM phones WHERE os = ?");
            $exec->execute([$id]);
            $phones = $exec->fetchAll();
            if(count($phones)) {
                return false;
            } else {
                $exec = $conn->prepare("DELETE FROM operating_systems WHERE id = ?");
                $result = $exec->execute([$id]);
            }
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function deleteBrand($id) {
        try {
            global $conn;
            $exec = $conn->prepare("SELECT * FROM phones WHERE brand = ?");
            $exec->execute([$id]);
            $phones = $exec->fetchAll();
            if(count($phones)) {
                return false;
            } else {
                $exec = $conn->prepare("DELETE FROM brands WHERE id = ?");
                $result = $exec->execute([$id]);
            }
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function deletePhone($id) {
        try {
            global $conn;
            $exec = $conn->prepare("SELECT * FROM order_details WHERE phone_id = ?");
            $exec->execute([$id]);
            $orders = $exec->fetchAll();
            if(count($orders)) {
                return false;
            } else {
                $conn->beginTransaction();
                $exec = $conn->prepare("DELETE FROM cart WHERE phone_id = ?");
                $result = $exec->execute([$id]);
                if($result) {
                    $exec = $conn->prepare("DELETE FROM phones WHERE id = ?");
                    $result = $exec->execute([$id]);
                    if($result) {
                        $conn->commit();
                    }
                }
            }
            return $result;
        } catch (PDOException $ex) {
            $conn->rollBack();
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function deleteUser($id) {
        if($_SESSION['user']->id == $id) return false;
        try {
            global $conn;
            $conn->beginTransaction();
            $exec = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
            $result = $exec->execute([$id]);
            if($result) {
                $exec = $conn->prepare("UPDATE orders SET user_id = NULL WHERE user_id = ?");
                $result = $exec->execute([$id]);
                if($result) {
                    $exec = $conn->prepare("UPDATE contact_messages SET user_id = NULL WHERE user_id = ?");
                    $result = $exec->execute([$id]);
                    if($result) {
                        $exec = $conn->prepare("DELETE FROM users WHERE id = ?");
                        $result = $exec->execute([$id]);
                        if($result) {
                            $conn->commit();
                        }
                    }
                }
            }
            return $result;
        } catch (PDOException $ex) {
            $conn->rollBack();
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function addBrand($name) {
        try {
            global $conn;
            $exec = $conn->prepare("INSERT INTO brands(name) VALUES (?)");
            $result = $exec->execute([$name]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function getBrand($column, $value) {
        global $conn;
        $exec = $conn->prepare("SELECT * FROM brands WHERE $column = ?");
        $exec->execute([$value]);
        return $exec->fetch();
    }

    function editBrand($id, $name) {
        try {
            global $conn;
            $exec = $conn->prepare("UPDATE brands SET name = ? WHERE id = ?");
            $result = $exec->execute([$name, $id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function addOS($name) {
        try {
            global $conn;
            $exec = $conn->prepare("INSERT INTO operating_systems(name) VALUES (?)");
            $result = $exec->execute([$name]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function getOS($column, $value) {
        global $conn;
        $exec = $conn->prepare("SELECT * FROM operating_systems WHERE $column = ?");
        $exec->execute([$value]);
        return $exec->fetch();
    }

    function editOS($id, $name) {
        try {
            global $conn;
            $exec = $conn->prepare("UPDATE operating_systems SET name = ? WHERE id = ?");
            $result = $exec->execute([$name, $id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function getOrder($column, $value) {
        global $conn;
        $exec = $conn->prepare("SELECT * FROM orders WHERE $column = ?");
        $exec->execute([$value]);
        return $exec->fetch();
    }

    function editOrder($id, $name, $address) {
        try {
            global $conn;
            $exec = $conn->prepare("UPDATE orders SET name = ?, address = ? WHERE order_id = ?");
            $result = $exec->execute([$name, $address, $id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function getAllRoles() {
        return executeQuery("SELECT * FROM roles");
    }

    function addUser($username, $email, $encPassword, $role) {
        try {
            global $conn;
            $exec = $conn->prepare("INSERT INTO users(username, email, password, role) VALUES (?, ?, ?, ?)");
            $result = $exec->execute([$username, $email, $encPassword, $role]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function editUserWithPassword($id, $username, $email, $encPassword, $role, $active) {
        try {
            global $conn;
            $exec = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ?, role = ?, active = ? WHERE id = ?");
            $result = $exec->execute([$username, $email, $encPassword, $role, $active, $id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function editUserWithoutPassword($id, $username, $email, $role, $active) {
        try {
            global $conn;
            $exec = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ?, active = ? WHERE id = ?");
            $result = $exec->execute([$username, $email, $role, $active, $id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function getPhone($column, $value) {
        global $conn;
        $exec = $conn->prepare("SELECT * FROM phones WHERE $column = ?");
        $exec->execute([$value]);
        return $exec->fetch();
    }

    function addPhone($name, $price, $os, $brand, $originalImageLocation, $smallImageLocation) {
        try {
            global $conn;
            $exec = $conn->prepare("INSERT INTO phones(name, price, os, brand, image, image_small) VALUES (?, ?, ?, ?, ?, ?)");
            $result = $exec->execute([$name, $price, $os, $brand, $originalImageLocation, $smallImageLocation]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function editPhoneWithImage($id, $name, $price, $os, $brand, $active, $originalImageName, $smallImageName) {
        try {
            global $conn;
            $exec = $conn->prepare("UPDATE phones SET name = ?, price = ?, os = ?, brand = ?, active = ?, image = ?, image_small = ? WHERE id = ?");
            $result = $exec->execute([$name, $price, $os, $brand, $active, $originalImageName, $smallImageName, $id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }

    function editPhoneWithoutImage($id, $name, $price, $os, $brand, $active) {
        try {
            global $conn;
            $exec = $conn->prepare("UPDATE phones SET name = ?, price = ?, os = ?, brand = ?, active = ? WHERE id = ?");
            $result = $exec->execute([$name, $price, $os, $brand, $active, $id]);
            return $result;
        } catch (PDOException $ex) {
            updateErrorLog($ex->getMessage());
            return false;
        }
    }
?>