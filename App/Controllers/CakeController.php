<?php

use App\Core\Controller;

class CakeController extends Controller
{
    private $key;
    private $userModel;
    private $categoryModel;
    function __construct()
    {
        $this->key = $this->model("CakeModel");
        $this->userModel = $this->model("UserModel");
        $this->categoryModel = $this->model("CategoryModel");
    }
    function Index()
    {
        $limit = 12;
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
        $data["comments"] = [];
        $data["comments"] = $this->key->getComments($id);
        if ($data["comments"] != []) {
            foreach ($data["comments"] as $index => $value) {
                $data[$value["id"]] = $this->userModel->getById($value["id_user"]);
                $data["time"][$value["id"]] = $this->setTime($value["time"]);
                if (isset($_SESSION["user"])) {
                    $data["like"][$value["id"]] = $this->key->updateThich($_SESSION["user"]["id"], $value["id"]);
                }
            }
        }
        $data["cakeID"] = $this->key->getCakeByID($id);
        $data["image"] = $this->categoryModel->getImage($data["cakeID"]["id"]);
        $data["type"] = $this->categoryModel->getNameById($data["cakeID"]["id_cake_type"]);
        $this->view("\cake\detailBakery", $data);
    }
    function addComment()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time = date("H:i:s M d Y", time());
        $result = $this->key->addComment($_GET["id"], $time, $_GET["comment"]);
        echo json_encode($result);
    }
    function updateCommentAndLike()
    {
        $result = $this->key->updateComment($_GET["likes"], $_GET["id"], $_SESSION["user"]["id"]);
        echo json_encode($result);
    }
    function setTime($time)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $timestamp = strtotime($time);
        $seconds = time() - $timestamp;
        $interval = round($seconds / 31536000);
        if ($interval >= 1) {
            return ($interval . " years ago");
        }
        $interval = round($seconds / 2592000);
        if ($interval >= 1) {
            return ($interval . " months ago");
        }
        $interval = round($seconds / 86400);
        if ($interval >= 1) {
            if ($interval < 6) {
                return ($interval . " days ago");
            } else {
                return (date("M d Y",  $timestamp));
            }
        }
        $interval = round($seconds / 3600, 0, PHP_ROUND_HALF_DOWN);
        if ($interval >= 1) {
            return ($interval . " hours ago");
        }
        $interval = round($seconds / 60);
        if ($interval >= 1) {
            return ($interval . " mins ago");
        }
        return "just now";
    }
}
