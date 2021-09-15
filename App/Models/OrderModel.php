<?php

use App\Core\Database;

class OrderModel extends Database
{
    function orderProcess($data)
    {
        $data["orderday"] = date("Y-m-d");
        $data["delevery"] = date("Y-m-d", strtotime($data["orderday"] . "3 days"));
        $data["user"] = $_SESSION["user"]["id"];
        $status = "CXL";
        $stmt = $this->con->prepare("INSERT INTO ORDERS (order_date, delivery_date,id_user,id_status,total) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisi", $data["orderday"],   $data["delevery"], $data["user"], $status, $data["total"]);
        $isSuccess = $stmt->execute();
        if (!$isSuccess) {
            return  $stmt->error;
        }
        $id_order =  $this->con->insert_id;
        foreach ($data["cake"] as $index => $value) {
            $stmt = $this->con->prepare("INSERT INTO ORDER_DETAILS (id_order,id_cake,amount) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $id_order, $value["id"], $data["amountCake"][$index]);
            $stmt->execute();
        }
        $stmt = $this->con->prepare("DELETE FROM CART WHERE id_user = ?");
        $stmt->bind_param("i", $data["user"]);
        $stmt->execute();
        return;
    }
    function getById($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM ORDERS WHERE id_user = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
    function getOrderDetail($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM ORDER_DETAILS WHERE id_order = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
    function getStatus($id)
    {
        $stmt = $this->con->prepare("SELECT name FROM STATUS WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc()["name"];
        } else {
            return false;
        }
    }
    function all()
    {
        $stmt = $this->con->prepare("SELECT * FROM ORDERS ");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
    function getAllStatus()
    {
        $stmt = $this->con->prepare("SELECT * FROM STATUS ");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
    function updateStatus($data)
    {
        $stmt = $this->con->prepare("UPDATE ORDERS SET id_status = ? WHERE id = ?");
        $stmt->bind_param("si", $data['value'], $data['id']);
        $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result < 1) {
            return false;
        } else {
            return true;
        }
    }
    function delete($id)
    {
        $id = intval($id);
        $stmt = $this->con->prepare("DELETE FROM ORDERS WHERE id = ?");
        $stmt->bind_param("i", $id);
        $isSuccess = $stmt->execute();
        if (!$isSuccess) {
            return $stmt->error;
        } else if ($stmt->affected_rows <= 0) {
            return "Undefined Order ID: $id";
        }
        return true;
    }
    function getOrderById($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM ORDERS WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    function deleteOneProduct($id_order, $id_cake)
    {
        $id_order = intval($id_order);
        $id_cake = intval($id_cake);
        $stmt = $this->con->prepare("DELETE FROM ORDER_DETAILS WHERE id_order = ? AND id_cake=?");
        $stmt->bind_param("ii", $id_order, $id_cake);
        $isSuccess = $stmt->execute();
        if (!$isSuccess) {
            return $stmt->error;
        } else if ($stmt->affected_rows <= 0) {
            return "Undefined Order ID: $id_order";
        }
        return true;
    }
    function updatePrice($id_order, $price)
    {
        $stmt = $this->con->prepare("UPDATE ORDERS SET total = ? WHERE id = ?");
        $stmt->bind_param("ii", $price, $id_order);
        $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result < 1) {
            return false;
        } else {
            return true;
        }
    }
    function plusItem($id_order, $id_cake, $amount)
    {
        $stmt = $this->con->prepare("INSERT INTO ORDER_DETAILS(id_order,id_cake,amount) VALUE(?,?,?)");
        $stmt->bind_param("iii", $id_order, $id_cake, $amount);
        $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result < 1) {
            return false;
        } else {
            return true;
        }

        return true;
    }
    function updateAmount($id_order, $id_cake, $amount)
    {
        $stmt = $this->con->prepare("UPDATE ORDER_DETAILS SET amount = ? WHERE id_order=? and id_cake= ?");
        $stmt->bind_param("iii", $amount, $id_order, $id_cake);
        $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result < 1) {
            return false;
        } else {
            return true;
        }
    }
    function updateOrder($data, $id_order)
    {
        $id_order = intval($id_order);
        $price = filter_var($data["price"], FILTER_SANITIZE_NUMBER_INT);;
        $order_date = $data["order-date"];
        $delivery_date = $data["delivery-date"];
        $status = $data["status"];
        $stmt = $this->con->prepare("UPDATE ORDERS SET order_date = ?,delivery_date = ?,id_status=?,total=? WHERE id=?");
        $stmt->bind_param("sssii", $order_date, $delivery_date, $status, $price, $id_order);
        $result = $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result < 1) {
            return false;
        } else {
            return true;
        }
    }
    function store($data)
    {
        $stmt = $this->con->prepare("INSERT INTO ORDERS(order_date,delivery_date,id_user,id_status) VALUE(?,?,?,?)");
        $stmt->bind_param("ssis", $data["order-date"],  $data["delivery-date"], $data["id_user"], $data["status"]);
        $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result < 1) {
            return false;
        } else {
            return true;
        }
    }
}
