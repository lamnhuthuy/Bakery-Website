<?php

use App\Core\Controller;

class CustomersController extends Controller
{
    private $userModel;
    private $cakeModel;
    private $orderModel;
    function __construct()
    {
        $this->userModel = $this->model("UserModel");
        $this->orderModel = $this->model("OrderModel");
        $this->cakeModel = $this->model("CakeModel");
    }
    function index()
    {
        $data["users"] = $this->userModel->all();
        $this->view("/admin/customer/index", $data);
    }
    function detail($id)
    {
        $data["user"] = $this->userModel->getById($id);
        $data["order"] = $this->orderModel->getById($id);
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
        $this->view("/admin/customer/detail", $data);
    }
    function delete($id)
    {
        $data["image"] = $this->userModel->getById($id)["avatar"];
        $result = $this->userModel->delete($id);
        if ($result === true) {
            if ($data["image"] != "" && $data["image"] != "userdefault.png") {
                unlink(ROOT . DS . "public" . DS . "upload" . DS . "userAvatar" . DS . $data["image"]);
            }
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = "Customer deleted successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Customer deleted unsuccessfully.";
        }
        header("Location:" . DOCUMENT_ROOT . "/admin/customers/index");
    }
}
