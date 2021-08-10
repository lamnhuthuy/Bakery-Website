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
            foreach ($data["order"] as $index => $value) {
                $data["order_detail"][$value["id"]] = $this->orderModel->getOrderDetail($value["id"]);
                foreach ($data["order_detail"][$value["id"]] as $count => $cake) {
                    $idCake = $cake["id_cake"];
                    $data["cake_detail"][$value["id"]][$idCake] = $this->cakeModel->getCakeByID($idCake);
                }
                $data["status"][$value["id"]] = $this->orderModel->getStatus($value["id_status"]);
            }

            $this->view("/profile/profile", $data);
        }
    }
}
