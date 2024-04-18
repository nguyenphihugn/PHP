<?php
include_once("app/views/share/header.php");
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách chi tiết đơn hàng</h6>
    </div>
    <div class="card-body">
        <a href="/chieu2-main" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-car"></i> <!-- Changed icon to a car -->
            </span>
            <span class="text">Về trang chủ</span>
        </a>
        <div class="table-responsive mt-4">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div style="display:flex;justify-content: space-between;">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                            role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending"
                                        style="width: 379.19px;">Mã đơn hàng</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending"
                                        style="width: 169.306px;">Mã sản phẩm</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 85.4398px;">
                                        Số lượng</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending" style="width: 85.4398px;">
                                        Giá sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $orderDetails->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr class="even">
                                    <td><?= $row['orderId'] ?></td>
                                    <td><?= $row['productId'] ?></td>
                                    <td><?= $row['quantity'] ?></td>
                                    <td><?= $row['price'] ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include_once("app/views/share/footer.php"); ?>