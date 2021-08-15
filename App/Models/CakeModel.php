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
}
