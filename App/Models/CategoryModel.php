<?php

use App\Core\Database;

class CategoryModel extends Database
{
    function all()
    {
        $sql = "SELECT * FROM cake_type";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return false;
    }
    function getNameById($id)
    {
        $sql = "SELECT * FROM cake_type where id=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc()["name"];
        } else return;
    }
    function getImage($id)
    {
        $sql = "SELECT * FROM images where id_cake=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return;
    }
    function getCakeByID_type($id_type)
    {
        $sql = "SELECT * FROM cakes where id_cake_type=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id_type);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return;
    }
    function sort($id_type, $id)
    {
        if ($id == 1) {
            $by = "sale";
            $type = "asc";
        } else if ($id == 2) {
            $by = "sale";
            $type = "desc";
        } else if ($id == 3) {
            $by = "name";
            $type = "asc";
        } else if ($id == 4) {
            $by = "size";
            $type = "asc";
        }

        $sql = "SELECT * FROM cakes where id_cake_type=? order by $by $type";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id_type);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return;
    }
    function getCakeType($id)
    {
        $sql = "SELECT * FROM cake_type where id=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else return false;
    }
    function store($data)
    {
        $stmt = $this->con->prepare("INSERT INTO CAKE_TYPE(name,description,image) VALUE(?,?,?)");
        $stmt->bind_param("sss", $data["name"],  $data["description"], $data["image"]);
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
        $stmt = $this->con->prepare("DELETE FROM CAKE_TYPE WHERE id = ?");
        $stmt->bind_param("i", $id);
        $isSuccess = $stmt->execute();
        if (!$isSuccess) {
            return $stmt->error;
        } else if ($stmt->affected_rows <= 0) {
            return "Undefined Category ID: $id";
        }
        return true;
    }
    function update($data)
    {
        $stmt = $this->con->prepare("UPDATE CAKE_TYPE SET name = ?, description = ?,image=? WHERE id = ?");
        $stmt->bind_param("sssi", $data['name'], $data['description'], $data["image"], $data["id"]);
        $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result < 1) {
            return false;
        } else {
            return true;
        }
    }
}
