<?php

namespace App\Core;

use mysqli;

class Database
{
    protected $con;
    function __construct()
    {
        $this->con = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->con->connect_error) {
            die("Fail connection: " . $this->con->connect_error);
        }
        $this->con->set_charset("utf8");
    }
}
