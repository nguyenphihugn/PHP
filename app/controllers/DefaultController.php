<?php
class DefaultController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }
    public function Index()
    {

        if (!isset($_SESSION["username"])) {
            header("Location: /chieu2-main/accounts/login.php");
        }

        $products = $this->productModel->readAll();

        include_once 'app/views/share/index.php';
    }
}
