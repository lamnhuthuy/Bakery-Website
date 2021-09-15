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
        } else return false;
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
        } else return false;
    }
    function getComments($id)
    {
        $sql = "Select * from comments where id_cake= ? ";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return;
    }
    function addComment($id, $time, $comment)
    {
        $id_cake = $id;
        $id_user = $_SESSION["user"]["id"];
        $like = 0;
        $sql = "Insert into Comments(id_cake,id_user,comment,time,likes) values(?,?,?,?,?) ";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("iissi", $id_cake, $id_user, $comment,  $time, $like);
        $result = $stmt->execute();
        return   true;
    }
    function updateComment($like, $comment, $user)
    {
        $stmt = $this->con->prepare("UPDATE Comments SET likes = ? WHERE id = ? ");
        $stmt->bind_param("ii", $like, $comment);
        $stmt->execute();
        $kq = $this->updateThich($user, $comment);
        if ($kq == 1) {
            $stmt = $this->con->prepare("DELETE FROM Thich WHERE id_comment = ? AND id_user = ?");
            $stmt->bind_param("ii",  $comment, $user);
            $stmt->execute();
        } else {
            $sql = "Insert into thich(id_comment,id_user) values(?,?) ";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("ii",  $comment, $user);
            $stmt->execute();
        }
    }
    function updateThich($id, $comment)
    {
        $sql = "Select * from thich where id_user= ? and id_comment=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ii", $id, $comment);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->num_rows;
        } else return 0;
    }
    function store($data)
    {
        $stmt = $this->con->prepare("INSERT INTO CAKES(name,price,size,description,id_cake_type,image,sale) VALUE(?,?,?,?,?,?,?)");
        $stmt->bind_param("siisisi", $data["name"],  $data["price"],  $data["size"],  $data["description"],  $data["categoryId"], $data["image1"], $data["sale"]);
        $isSuccess = $stmt->execute();
        if (!$isSuccess) {
            return  $stmt->error;
        }
        $id_cake =  $this->con->insert_id;
        for ($i = 1; $i <= 4; $i++) {
            $stmt = $this->con->prepare("INSERT INTO IMAGES(id_cake,image) VALUE(?,?)");
            $stmt->bind_param("is", $id_cake, $data["image$i"]);
            $stmt->execute();
            $result = $stmt->affected_rows;
        }
        if ($result < 1) {
            return false;
        } else {
            return true;
        }
    }
    function update($data)
    {
        $stmt = $this->con->prepare("UPDATE CAKES SET name=?,price=?,size=?,description=?,id_cake_type=?,image=?,sale=? WHERE id=?");
        $stmt->bind_param("siisisii", $data["name"],  $data["price"],  $data["size"],  $data["description"],  $data["categoryId"], $data["image1"], $data["sale"], $data["id"]);
        $isSuccess = $stmt->execute();
        if (!$isSuccess) {
            return  $stmt->error;
        }
        $stmt = $this->con->prepare("DELETE FROM IMAGES WHERE id_cake = ?");
        $stmt->bind_param("i", $data["id"]);
        $stmt->execute();

        for ($i = 1; $i <= 4; $i++) {
            $stmt = $this->con->prepare("INSERT INTO IMAGES(id_cake,image) VALUE(?,?)");
            $stmt->bind_param("is", $data["id"], $data["image$i"]);
            $stmt->execute();
            $result = $stmt->affected_rows;
        }
        if ($result < 1) {
            return "false";
        } else {
            return "true";
        }
    }
    function delete($id)
    {
        $id = intval($id);
        $stmt = $this->con->prepare("DELETE FROM CAKES WHERE id = ?");
        $stmt->bind_param("i", $id);
        $isSuccess = $stmt->execute();

        if (!$isSuccess) {
            return $stmt->error;
        } else if ($stmt->affected_rows <= 0) {
            return "Undefined Cake ID: $id";
        }
        return true;
    }
}
