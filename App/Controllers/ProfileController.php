<?php

use App\Core\Controller;

class ProfileController extends Controller
{
    private $userModel;
    private $orderModel;

    function __construct()
    {
        $this->userModel = $this->model("UserModel");
        $this->orderModel = $this->model("OrderModel");
        $this->cakeModel = $this->model("CakeModel");
    }
    function Index()
    {
        if (isset($_SESSION["user"])) {
            $data["user"] = $this->userModel->getById($_SESSION["user"]["id"]);
            $data["order"] = $this->orderModel->getById($_SESSION["user"]["id"]);
            if ($data["order"] != []) {
                foreach ($data["order"] as $index => $value) {
                    $data["order_detail"][$value["id"]] = $this->orderModel->getOrderDetail($value["id"]);
                    foreach ($data["order_detail"][$value["id"]] as $count => $cake) {
                        $idCake = $cake["id_cake"];
                        $data["cake_detail"][$value["id"]][$idCake] = $this->cakeModel->getCakeByID($idCake);
                    }
                    $data["status"][$value["id"]] = $this->orderModel->getStatus($value["id_status"]);
                }
            } else {
                $data["order"] = [];
            }
            $this->view("/profile/profile", $data);
        }
    }
    function update()
    {
        if ($this->userModel->getByEmail($_POST["email"]) != false) {
            $_SESSION["updateProfile"] = "false";
            header("Location: " . DOCUMENT_ROOT);
            return;
        }
        if (!isset($_POST)) {
            header("Location: " . DOCUMENT_ROOT);
        }
        $data['id'] = $_SESSION["user"]["id"];
        $data['name'] = $_POST["username"];
        $data['phone'] = $_POST["phone"];
        $data['address'] = $_POST["address"];
        $data['email'] = $_POST["email"];
        $data['image'] = $this->userModel->getById($data['id'])["avatar"];
        $duongdan = ROOT . DS . "public" . DS . "upload" . DS . "userAvatar";
        if (isset($_FILES["avatar"])) {
            if ($_FILES["avatar"]['name'] != "") {
                $randomNum = time();
                $imageName = str_replace(' ', '-', strtolower($_FILES["avatar"]['name']));
                $imageExt = substr($imageName, strrpos($imageName, '.'));
                $imageExt = str_replace('.', '', $imageExt);
                $newImageName = $randomNum . '.' . $imageExt;
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $duongdan . DS . $newImageName);
                $oldImage = $data['image'];
                if ($data['image'] != "" && $data['image'] != "userdefault.png") {
                    unlink(ROOT . DS . "public" . DS . "upload" . DS . "userAvatar" . DS . $oldImage);
                }
                $data["image"] = $newImageName;
            }
        }
        $result = $this->userModel->updateUser($data);
        if ($result == true) {
            $_SESSION["updateProfile"] = "true";
            header("Location: " . DOCUMENT_ROOT);
        } else {
            $_SESSION["updateProfile"] = "false";
            header("Location: " . DOCUMENT_ROOT);
        }
    }
}
