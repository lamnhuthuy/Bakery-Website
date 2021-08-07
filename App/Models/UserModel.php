<?php

use App\Core\Database;

class UserModel extends Database
{
    function register($data)
    {
        if (isset($_POST)) {
            $name = $data['username'];
            $email = $data['email'];
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $role = 1;
            $stmt = $this->con->prepare("INSERT INTO USERS(name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $name, $email, $password, $role);
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
        $stmt = $this->con->prepare("SELECT id, name, phone, email, avatar FROM USERS WHERE email = ?");
        $stmt->bind_param("s", $email);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}
