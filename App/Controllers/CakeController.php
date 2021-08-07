<?php

use App\Core\Controller;

class CakeController extends Controller
{
    private $key;
    function __construct()
    {
        $this->key = $this->model("CakeModel");
    }
    function Index()
    {
        $limit = 8;
        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
        $data["page"] = $_GET["page"];
        $data["cake"] = $this->key->all();
        $data["cakePerPage"] = $this->key->getCakeByPage($_GET["page"], $limit);
        $data["pageCount"] = ceil(count($data["cake"]) / $limit);
        $this->view("\cake\index", $data);
    }
    function search()
    {
        $data["keyword"] = $_GET["keyword"];
        if ($data["keyword"] == "") {
            header("Location: " . DOCUMENT_ROOT);
            return;
        }
        $data["cake"] = $this->key->getByKey($_GET["keyword"]);
        if (!$data["cake"]) {
            $data["cake"] = [];
            $data["keyword"] = "No result";
        }
        $this->view("\cake\search", $data);
    }
    function detail($id)
    {

        $data["cakeID"] = $this->key->getCakeByID($id);
        $this->view("\cake\detailBakery", $data);
    }
}
