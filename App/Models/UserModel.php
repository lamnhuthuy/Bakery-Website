<?php

use App\Core\Database;

class UserModel extends Database
{
    function register($data)
    {
        if (isset($_POST)) {
            $name = $data['username'];
            $email = $data['email'];
            $phone = $data["phone"];
            $address = $data["address"];
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $role = 1;
            $image = "userdefault.png";
            $stmt = $this->con->prepare("INSERT INTO USERS(name, email, password, role,avatar,phone,address) VALUES (?, ?, ?, ?, ?,?,?)");
            $stmt->bind_param("sssisss", $name, $email, $password, $role, $image, $phone, $address);
            $stmt->execute();
            $result = $stmt->affected_rows;
            if ($result < 1) {
                return false;
            } else {
                return true;
            }
        }
    }
    function authenticate($data)
    {
        $email = $data['email'];
        $password = $data['password'];
        $stmt = $this->con->prepare("SELECT * FROM USERS WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $passwordHashed = $result->fetch_assoc()['password'];
            $isValidPassword = password_verify($password, $passwordHashed);
            if ($isValidPassword == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function getByEmail($email)
    {
        $stmt = $this->con->prepare("SELECT id, name, phone, address, email, avatar FROM USERS WHERE email = ?");
        $stmt->bind_param("s", $email);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    function getById($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM USERS WHERE id = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    function updateUser($data)
    {

        $stmt = $this->con->prepare("UPDATE USERS SET name = ?, phone= ?, address= ?,email= ?,avatar=? WHERE id = ?");
        $stmt->bind_param("sssssi", $data['name'], $data['phone'], $data['address'], $data['email'], $data['image'], $data['id']);
        $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result < 1) {
            return false;
        } else {
            $_SESSION["user"] = $this->getByEmail($data["email"]);
            return true;
        }
    }
    function all()
    {
        $sql = "SELECT id, name, phone, address, email, avatar FROM USERS WHERE role = 1";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else return false;
    }
    function delete($id)
    {
        $id = intval($id);
        $stmt = $this->con->prepare("DELETE FROM USERS WHERE id = ?");
        $stmt->bind_param("i", $id);
        $isSuccess = $stmt->execute();
        if (!$isSuccess) {
            return $stmt->error;
        } else if ($stmt->affected_rows <= 0) {
            return "Undefined Cake ID: $id";
        }
        return true;
    }
    function getAdmin($data)
    {
        $stmt = $this->con->prepare("SELECT * FROM USERS WHERE id = ? and role=0");
        $stmt->bind_param("i", $data["id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $passwordHashed = $result->fetch_assoc()['password'];
            $isValidPassword = password_verify($data["password"], $passwordHashed);
            if ($isValidPassword == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
