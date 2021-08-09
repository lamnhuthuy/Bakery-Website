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
}
