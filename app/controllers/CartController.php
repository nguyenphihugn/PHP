<?php
class CartController
{
    private $cartModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->cartModel = new CartModel($this->db);
    }


    public function add($id)
    {
        $product = $this->cartModel->getProductById($id);
        if (empty($product)) {
            include_once 'app/views/share/not-found.php';
        } else {
            include_once 'app/views/product/addcart.php';
        }
    }

    public function addtocart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['id'] ?? '';
            if ($product_id == '') {
            } else {
                if (!isset($_SESSION)) {
                    session_start();
                }
                if (!isset($_SESSION['shoppingcart'])) {
                    $_SESSION['shoppingcart'] = array();
                }

                if (isset($_POST['add_to_cart'])) {
                    if (isset($_SESSION['shoppingcart'][$product_id])) {
                        $_SESSION['shoppingcart'][$product_id]++;
                    } else {
                        $_SESSION['shoppingcart'][$product_id] = 1;
                    }
                }
            }
        }
        header('Location: /chieu2-main/Cart/cart');
        //header('Location: /chieu2-main');
    }

    public function updateQuantity()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['id'] ?? '';
            $quantity = $_POST['quantity'] ?? '';

            if (!isset($_SESSION)) {
                session_start();
            }

            // Cập nhật số lượng sản phẩm trong session
            if (!empty($product_id) && !empty($quantity)) {
                $_SESSION['shoppingcart'][$product_id] = $quantity;
            }
        }
        // Phản hồi bất kỳ dữ liệu nào bạn muốn, ví dụ: 'Updated successfully'.
        echo 'Updated successfully';
    }

    public function deleteitem($id)
    {
        $product = $this->cartModel->getProductById($id);
        if (empty($product)) {
            include_once 'app/views/share/not-found.php';
        } else {
            $this->cartModel->deleteFromCartById($id);

            header('Location: /chieu2-main/Cart/cart?delete=true');
        }
    }

    public function cart()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $cartContent = $_SESSION['shoppingcart'] ?? array();

        $productInfos = array();

        foreach ($cartContent as $productId => $quantity) {
            $productInfo = $this->cartModel->get_product_info($productId);
            $productInfos[] = array(
                'id' => $productId,
                'name' => $productInfo['name'],
                'image' => $productInfo['image'],
                'price' => $productInfo['price'],
                'quantity' => $quantity
            );
        }
        include_once 'app/views/product/cart.php';
    }

    public function checkout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (empty($_SESSION['shoppingcart'])) {
            echo "Giỏ hàng của bạn đang trống. Không thể thanh toán.";
            return;
        }
        if (isset($_GET["pay"])) {
            $this->cartModel->checkout($_GET["pay"]);
            include_once 'app/views/payproducts/paid.php';
        }
        $this->cartModel->checkout(null);
    }
}
