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
        } else return;
    }
}
