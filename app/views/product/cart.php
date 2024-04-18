<?php
include_once("app/views/share/header.php");

?>

<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($errors)) {
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li class='text-danger'>" . $error . "</li>";
    }
    echo "</ul>";
}
if (isset($_GET['delete'])) {
    echo "
    <div class='alert alert-success'>
  <strong>Success!</strong> Xoá thành công
</div>";
}

?>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Giỏ hàng của bạn</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 mb-4">

                <div style="display:flex; justify-content: space-between;">
                    <a href="/chieu2-main" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-home"></i>
                        </span>
                        <span class="text">Về trang chủ</span>
                    </a>
                    <div>
                        <a id="paymentButton" class="btn btn-warning btn-icon-split" href="#">
                            <span class="icon text-white-50">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Thanh toán</span>
                        </a>
                        <a href="/chieu2-main/OrderDetails/readAll" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Chi Tiết Đơn Hàng </span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr role="row">

                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 379.19px;">Name</th>

                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 85.4398px;">
                                        Image</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 163.565px;">Price</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 163.565px;">Quantity</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 135px;">
                                        Action (Delete)</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($productInfos as $product) : ?>
                                    <tr class="even">
                                        <td><?= $product['name'] ?></td>
                                        <td>
                                            <?php if (empty($product['image']) || !file_exists($product['image'])) : ?>
                                                Image Not Found!
                                            <?php else : ?>
                                                <img src="/chieu2-main/<?= $product['image'] ?>" alt="product img" class='w-100'>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity" value="<?= $product['quantity'] ?>" onchange="updateQuantity(this, <?= $product['id'] ?>, <?= $product['price'] ?>)">
                                        </td>
                                        <td id="price<?= $product['id'] ?>"><?= $product['price'] ?></td>
                                        <td>
                                            <a href="/chieu2-main/Cart/deleteitem/<?= $product['id'] ?>" class="text-danger">Delete</a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                                <div class="mt-4">
                                    <h3>Tổng tiền</h3>
                                    <div class="total-price">
                                        <p id="totalPrice"><?= calculateTotalPrice($productInfos) ?></p>
                                        <?php
                                        function calculateTotalPrice($productInfos)
                                        {
                                            $totalPrice = 0;

                                            foreach ($productInfos as $product) {
                                                $quantity = $product['quantity'];
                                                $price = $product['price'];
                                                $subtotal = $quantity * $price;
                                                $totalPrice += $subtotal;
                                            }

                                            return $totalPrice;
                                        }
                                        ?>
                                    </div>
                                </div>

                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận thanh toán</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="/chieu2-main/Cart/checkout" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="address">Nhập địa chỉ giao hàng</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ">
                    </div>
                    <p>Bạn có chắc chắn muốn thanh toán không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="add_to_cart" class="btn btn-primary">
                        Xác nhận thanh toán
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    function updateQuantity(input, productId, price) {
        var newQuantity = input.value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/chieu2-main/Cart/updateQuantity", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                console.log(xhr.responseText);
                var updatedPrice = price * newQuantity;
                document.getElementById("price" + productId).innerText = updatedPrice;

                // Cập nhật lại tổng tiền
                var totalPrice = calculatePrice();
                document.getElementById("totalPrice").innerText = totalPrice;
            }
        };

        xhr.send("id=" + productId + "&quantity=" + newQuantity);
    }

    function calculatePrice() {
        var prices = document.querySelectorAll("td[id^='price']");
        var total = 0;
        for (var i = 0; i < prices.length; i++) {
            var price = parseInt(prices[i].innerText);
            total += price;
        }
        return total;
    }

    $(document).ready(function() {
        // When the payment button is clicked, show the modal
        $("#paymentButton").click(function() {
            $("#paymentModal").modal("show");
        });
    });
</script>
<?php
include_once("app/views/share/footer.php"); ?>