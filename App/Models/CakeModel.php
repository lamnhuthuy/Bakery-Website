<?php

use App\Core\Database;

class CakeModel extends Database
{
    function all()
    {
        $sql = "SELECT * FROM cakes";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return;
    }
    function getByKey($key)
    {
        $key = "%" . $key . "%";
        $sql = "Select * from cakes where name like ? ";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return;
    }
    function getCakeByPage($page, $numberProduct)
    {

        $index = ($page - 1) * $numberProduct;
        $sql = "SELECT * FROM cakes order by id asc LIMIT $index,$numberProduct ";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return;
    }
    function getCakeByID($id)
    {
        $sql = "Select * from cakes where id= ? ";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else return;
    }
}
