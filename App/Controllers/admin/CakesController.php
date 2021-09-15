<?php

use App\Core\Controller;

class CakesController extends Controller
{
    private $cakeModel;
    private $categoryModel;

    function __construct()
    {
        $this->cakeModel = $this->model("CakeModel");
        $this->categoryModel = $this->model("CategoryModel");
    }
    function index()
    {
        $data["cake"] = $this->cakeModel->all();
        $this->view("/admin/cake/index", $data);
    }
    function edit($id)
    {
        $cake = $this->cakeModel->getCakeByID($id);
        if (!$cake) {
            header("Location: " . DOCUMENT_ROOT . "/admin/cakes");
        }
        $data["image"] = [];
        $data["image"] = $this->categoryModel->getImage($id);
        $data["cake"] =  $cake;
        $data["category"] = $this->categoryModel->all();
        $this->view("/admin/cake/edit", $data);
    }
    function create()
    {
        $data["category"] = $this->categoryModel->all();
        $this->view("/admin/cake/create", $data);
    }
    function store()
    {

        if (!isset($_POST)) {
            header("Location: " . DOCUMENT_ROOT . "/admin");
        }
        $data = $_POST;
        $data['name'] = $_POST['name'];
        $data['categoryId'] = intval($_POST['category']);
        $data['size'] = (int) filter_var($_POST["size"], FILTER_SANITIZE_NUMBER_INT);;
        $data['price'] = (int) filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_INT);;
        $data["sale"] = (int) filter_var($_POST["sale"], FILTER_SANITIZE_NUMBER_INT);
        $data['description'] = $_POST['description'];
        $duongdan = ROOT . DS . "public" . DS . "img" . DS . "cakes";
        for ($i = 1; $i <= 4; $i++) {
            $data["image$i"] = "";
            if (isset($_FILES["image$i"])) {
                if ($_FILES["image$i"]['name'] != "") {
                    $randomNum = time() + $i;
                    $imageName = str_replace(' ', '-', strtolower($_FILES["image$i"]['name']));
                    $imageExt = substr($imageName, strrpos($imageName, '.'));
                    $imageExt = str_replace('.', '', $imageExt);
                    $newImageName = $randomNum . '.' . $imageExt;
                    move_uploaded_file($_FILES["image$i"]["tmp_name"], $duongdan . DS . $newImageName);
                    $data["image$i"] = $newImageName;
                }
            }
        }
        $result = $this->cakeModel->store($data);
        if ($result == true) {
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = "Cake created  successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = " Cake created  unsuccessfully.";
        }
        header("Location: " . DOCUMENT_ROOT . "/admin/Cakes/create");
    }
    function update($id)
    {
        if (!isset($_POST)) {
            header("Location: " . DOCUMENT_ROOT . "/admin");
        }
        $data = $_POST;
        $data["id"] = $id;
        $data['name'] = $_POST['name'];
        $data['categoryId'] = intval($_POST['category']);
        $data['size'] = (int) filter_var($_POST["size"], FILTER_SANITIZE_NUMBER_INT);;
        $data['price'] = (int) filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_INT);;
        $data["sale"] = (int) filter_var($_POST["sale"], FILTER_SANITIZE_NUMBER_INT);
        $data['description'] = $_POST['description'];
        $duongdan = ROOT . DS . "public" . DS . "img" . DS . "cakes";
        $data["image"] = $this->categoryModel->getImage($id);
        for ($i = 1; $i <= 4; $i++) {
            $data["image$i"] = $data["image"][$i - 1]["image"];
        }
        for ($i = 1; $i <= 4; $i++) {
            if (isset($_FILES["image$i"])) {
                if ($_FILES["image$i"]['name'] != "") {
                    $randomNum = time() + $i;
                    $imageName = str_replace(' ', '-', strtolower($_FILES["image$i"]['name']));
                    $imageExt = substr($imageName, strrpos($imageName, '.'));
                    $imageExt = str_replace('.', '', $imageExt);
                    $newImageName = $randomNum . '.' . $imageExt;
                    move_uploaded_file($_FILES["image$i"]["tmp_name"], $duongdan . DS . $newImageName);
                    $oldImage = $data["image$i"];
                    if ($data["image$i"] != "") {
                        unlink(ROOT . DS . "public" . DS . "img" . DS . "cakes" . DS . $oldImage);
                    }
                    $data["image$i"] = $newImageName;
                }
            }
        }
        $result = $this->cakeModel->update($data);
        if ($result == true) {
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = " Cake updated successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Cake updated unsuccessfully.";
        }
        header("Location: " . DOCUMENT_ROOT . "/admin/Cakes/edit/" . $id);
    }
    function delete($id)
    {
        $data["image"] = $this->categoryModel->getImage($id);
        $result = $this->cakeModel->delete($id);
        if ($result === true) {
            for ($i = 1; $i <= 4; $i++) {
                if ($data["image"][$i - 1]["image"] != "") {
                    unlink(ROOT . DS . "public" . DS . "img" . DS . "cakes" . DS . $data["image"][$i - 1]["image"]);
                }
            }
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = " Cake deleted successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Can't delete cake because customers bought this cake.";
        }
        header("Location:" . DOCUMENT_ROOT . "/admin/cakes/index");
    }
}
