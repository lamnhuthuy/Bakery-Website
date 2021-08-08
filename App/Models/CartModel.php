<?php

use App\Core\Database;

class CartModel extends Database
{
    function addToCart($data)
    {
        if (!isset($data["id_cake"]) && !isset($data["id_user"])) {
            return false;
        }
        $cakeID = $data["id_cake"];
        $userID = $data["id_user"];
        $amount = 1;
        $amountInCart = $this->keyInCart($cakeID,  $userID);
        if ($amountInCart > 0) {
            $amount = $amountInCart + 1;
            $stmt = $this->con->prepare("UPDATE CART SET amount = ? WHERE id_user = ? AND id_cake = ?");
            $stmt->bind_param("iii", $amount, $userID,  $cakeID);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO CART(id_cake, id_user, amount) VALUES (?, ?, ?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("iii", $cakeID,  $userID, $amount);
            $stmt->execute();
        }

        return [
            "issuccess" => true,
            "numInCart" => $this->amountInCart($userID)
        ];
    }
    function keyInCart($cakeID,  $userID)
    {
        $sql = "Select * from cart where id_cake= ? and id_user= ? ";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ii", $cakeID, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc()["amount"];
        } else return false;
    }
    function amountInCart($userID)
    {
        $stmt = $this->con->prepare("SELECT COUNT(*) FROM CART WHERE id_user = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row()[0];
        } else return false;
    }
    function getCakeOfUser($userID)
    {
        $sql = "Select * from cart where id_user= ? ";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return false;
    }
    function updateCart($data)
    {
        if (!isset($data["id_cake"]) && !isset($data["id_user"])) {
            return false;
        }
        $cakeID = $data["id_cake"];
        $userID = $data["id_user"];
        $amount = $data["amount"];
        $stmt = $this->con->prepare("UPDATE CART SET amount = ? WHERE id_user = ? AND id_cake = ?");
        $stmt->bind_param("iii", $amount, $userID,  $cakeID);
        $stmt->execute();
        return true;
    }
    function deleteCart($data)
    {
        if (!isset($data["id_cake"]) && !isset($data["id_user"])) {
            return false;
        }
        $cakeID = $data["id_cake"];
        $userID = $data["id_user"];
        $stmt = $this->con->prepare("DELETE FROM CART WHERE id_user = ? AND id_cake = ?");
        $stmt->bind_param("ii", $userID,  $cakeID);
        $stmt->execute();
        return true;
    }
}
