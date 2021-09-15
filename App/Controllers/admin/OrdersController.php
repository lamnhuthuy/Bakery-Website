<?php

use App\Core\Controller;

class OrdersController extends Controller
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
        $data["orders"] = $this->orderModel->all();
        foreach ($data["orders"] as $index => $value) {
            $data["user"][$value["id"]] = $this->userModel->getById($value["id_user"]);
            $data["status"][$value["id"]] = $this->orderModel->getStatus($value["id_status"]);
        }
        $data["stt"] = $this->orderModel->getAllStatus();
        $this->view("/admin/order/index", $data);
    }
    function delete($id)
    {
        $result = $this->orderModel->delete($id);
        if ($result === true) {
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = "Order deleted successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Order deleted unsuccessfully.";
        }
        header("Location:" . DOCUMENT_ROOT . "/admin/orders/index");
    }
    function updateState()
    {
        if (isset($_GET)) {
            $result = $this->orderModel->updateStatus($_GET);
            echo json_encode($result);
        } else {
            header("Location: " . DOCUMENT_ROOT . "/admin/cakes");
        }
    }
    function edit($id)
    {
        $data["orders"] = $this->orderModel->getOrderById($id);
        $data["user"] = $this->userModel->getById($data["orders"]["id_user"]);
        $data["stt"] = $this->orderModel->getAllStatus();
        $data["order_detail"] = $this->orderModel->getOrderDetail($id);
        $this->view("/admin/order/edit", $data);
    }
    function update($id_order)
    {
        if (!isset($_POST)) {
            header("Location:" . DOCUMENT_ROOT . "/admin/orders/edit/" . $id_order);
        }
        $result = $this->orderModel->updateOrder($_POST, $id_order);
        if ($result === true) {
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = "Order updated  successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Nothing to change.";
        }
        header("Location:" . DOCUMENT_ROOT . "/admin/orders/edit/" . $id_order);
    }
    function deleteOneProduct($id_order, $id_cake)
    {

        $result = $this->orderModel->deleteOneProduct($id_order, $id_cake);
        $tong = $this->updatePrice($id_order);
        $res = $this->orderModel->updatePrice($id_order, $tong);
        if ($result === true && $res === true) {
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = "Cake deleted  in order successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Cake deleted in order unsuccessfully.";
        }
        header("Location:" . DOCUMENT_ROOT . "/admin/orders/edit/" . $id_order);
    }
    function updatePrice($id)
    {
        $data["order_detail"] = $this->orderModel->getOrderDetail($id);
        $data["total"] = 0;
        foreach ($data["order_detail"] as $index => $value) {
            $data["cake"] = $this->cakeModel->getCakeByID($value["id_cake"]);
            $data["total"] += $value["amount"] * $data["cake"]["sale"];
        }
        return  $data["total"];
    }
    function plus($id_order)
    {
        if (!isset($_POST)) {
            header("Location:" . DOCUMENT_ROOT . "/admin/orders/edit/" . $id_order);
        }
        $data["order-details"] = $this->orderModel->getOrderDetail($id_order);
        $temp = true;
        foreach ($data["order-details"] as $index => $value) {
            if ($_POST["id"] == $value["id_cake"]) {
                $result = $this->orderModel->updateAmount($id_order, $_POST["id"], $_POST["amount"]);
                $temp = false;
                break;
            }
        }
        if ($temp == true) {
            $result = $this->orderModel->plusItem($id_order, $_POST["id"], $_POST["amount"]);
        }
        $tong = $this->updatePrice($id_order);
        $res = $this->orderModel->updatePrice($id_order, $tong);
        if ($result === true && $res === true) {
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = "Cake Updated in order successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Can not found  a cake where id=" . $_POST["id"] . "";
        }
        header("Location:" . DOCUMENT_ROOT . "/admin/orders/edit/" . $id_order);
    }
    //AJAX UPDATE TOTAL
    function getToTal()
    {
        $result = $this->orderModel->updateAmount($_GET["id_order"], $_GET["id_cake"], $_GET["amount"]);
        if ($result) {
            $total = $this->updatePrice($_GET["id_order"]);
        }
        $data["mes"] = $result;
        $data["total"] = $total;
        echo json_encode($data);
    }
    //AJAX GET USER
    function getUser()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $result = $this->userModel->getById($id);
            if ($result !== false) {
                echo json_encode(true);
            } else  echo json_encode(false);
        }
    }
    function create()
    {
        $data["stt"] = $this->orderModel->getAllStatus();
        $this->view("/admin/order/create", $data);
    }
    function store()
    {

        if (!isset($_POST)) {
            header("Location: " . DOCUMENT_ROOT . "/admin");
        }
        $data["id_user"] = $_POST["user"];
        $data["order-date"] = date("Y-m-d", strtotime($_POST["order-date"]));
        $data["delivery-date"] = date("Y-m-d", strtotime($_POST["delivery-date"]));
        $data["status"] = $_POST["status"];
        $result = $this->orderModel->store($data);
        if ($result === true) {
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = " Order created successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = " Order created failed.";
        }
        header("Location:" . DOCUMENT_ROOT . "/admin/orders/create");
    }
}
