<?php
class CartModel
{
    private $conn;
    private $table_name = "products";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    function get_product_info($product_id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(array('id' => $product_id));
        $productInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        return $productInfo;
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " where id = $id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function deleteFromCartById($id)
    {

        if (isset($_SESSION['shoppingcart'][$id])) {
            unset($_SESSION['shoppingcart'][$id]);
        }
    }
    // public function checkout($pay)
    // {
    //     if (!isset($_SESSION)) {
    //         session_start();
    //     }

    //     if (empty($_SESSION['shoppingcart'])) {
    //         echo "Giỏ hàng của bạn đang trống. Không thể thanh toán.";
    //         return;
    //     }

    //     $this->conn->beginTransaction();

    //     try {

    //         $username = $_SESSION['username'];
    //         $usernameId = $this->getIdUser($username);
    //         $total_amount = 0;

    //         foreach ($_SESSION['shoppingcart'] as $product_id => $quantity) {
    //             $productInfo = $this->get_product_info($product_id);
    //             $total_amount += $productInfo['price'] * $quantity;
    //         }

    //         $stmt = $this->conn->prepare('INSERT INTO orders (accountId, total, isPaid) VALUES (?, ?, false)');
    //         $stmt->execute([$usernameId, $total_amount]);
    //         $order_id = $this->conn->lastInsertId();

    //         foreach ($_SESSION['shoppingcart'] as $product_id => $quantity) {
    //             $productInfo = $this->get_product_info($product_id);
    //             $price = $productInfo['price'];
    //             $stmt = $this->conn->prepare('INSERT INTO orderdetails (orderId, productId, quantity, price) VALUES (?, ?, ?, ?)');
    //             $stmt->execute([$order_id, $product_id, $quantity, $price]);
    //         }

    //         $this->conn->commit();

    //         unset($_SESSION['shoppingcart']);
    //         if ($pay) {
    //             $stmt = $this->conn->prepare('UPDATE orders set isPaid =true where orderId=? ');
    //             $stmt->execute([$order_id]);
    //             $this->conn->lastInsertId();

    //             header("Location: /chieu2-main/app/payproducts/paid.php?total_amount=$total_amount");
    //         } else
    //             echo "<h1>Đã thanh toán xong. Mã đơn hàng của bạn là: " . $order_id . ". Vui lòng kiểm tra thông tin đặt hàng</h1>";
    //     } catch (PDOException $e) {
    //         $this->conn->rollBack();
    //         echo "Lỗi trong quá trình thanh toán: " . $e->getMessage();
    //     }
    // }

    public function checkout($pay)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (empty($_SESSION['shoppingcart'])) {
            echo "Giỏ hàng của bạn đang trống. Không thể thanh toán.";
            return;
        }

        // Lấy địa chỉ từ trường nhập liệu
        $address = $_POST['address'];

        $this->conn->beginTransaction();

        try {

            $username = $_SESSION['username'];
            $usernameId = $this->getIdUser($username);
            $total_amount = 0;

            foreach ($_SESSION['shoppingcart'] as $product_id => $quantity) {
                $productInfo = $this->get_product_info($product_id);
                $total_amount += $productInfo['price'] * $quantity;
            }

            // Thêm địa chỉ vào câu lệnh INSERT
            $stmt = $this->conn->prepare('INSERT INTO orders (accountId, total, isPaid, address) VALUES (?, ?, false, ?)');
            $stmt->execute([$usernameId, $total_amount, $address]);
            $order_id = $this->conn->lastInsertId();

            foreach ($_SESSION['shoppingcart'] as $product_id => $quantity) {
                $productInfo = $this->get_product_info($product_id);
                $price = $productInfo['price'];
                $stmt = $this->conn->prepare('INSERT INTO orderdetails (orderId, productId, quantity, price) VALUES (?, ?, ?, ?)');
                $stmt->execute([$order_id, $product_id, $quantity, $price]);
            }

            $this->conn->commit();

            unset($_SESSION['shoppingcart']);
            if ($pay) {
                $stmt = $this->conn->prepare('UPDATE orders SET isPaid = true WHERE orderId = ?');
                $stmt->execute([$order_id]);
                $this->conn->lastInsertId();

                header("Location: /chieu2-main/app/payproducts/paid.php?total_amount=$total_amount");
            } else {
                header("Location: /chieu2-main/app/payproducts/paid.php?order_id=$order_id");
                //echo "<h1>Đã đặt hàng xong. Mã đơn hàng của bạn là: " . $order_id . ". Vui lòng đợi shop liên hệ</h1>";
            }
        } catch (PDOException $e) {
            $this->conn->rollBack();
            echo "Lỗi trong quá trình thanh toán: " . $e->getMessage();
        }
    }
    function getIdUser($username)
    {
        $stmt = $this->conn->prepare('SELECT id FROM accounts WHERE username = ?');
        $stmt->execute([$username]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['id'];
        } else {
            return null;
        }
    }
}