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
        //Tuong tu viec khoi tao doi tuong $auth = new Auth();
        if (!Auth::isLoggedIn()) {
            header("Location: /chieu2-main/account/login");
        }

        $products = $this->productModel->readAll();
        include_once 'app/views/share/index.php';
    }
}
