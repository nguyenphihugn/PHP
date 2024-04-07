<?php
include_once "app/views/share/header.php"; ?>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                            role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row =  $productInfos->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr class="odd">
                                    <th><?= $row["id"] ?></th>
                                    <th><?= $row["name"] ?></th>
                                    <th><?= $row["description"] ?></th>

                                    <th><?php
                                            if (empty($row["image"]) || !file_exists($row["image"])) {
                                                echo "No Image!";
                                            } else {
                                                echo "<img src='/chieu2-main/" . $row["image"] . "'alt='product'/>";
                                            }
                                            ?>
                                    </th>
                                    <th><?= $row["price"] ?></th>
                                    <th>
                                        <a href="/chieu2-main/cart/delete/<?= $row['id'] ?>">Delete</a>
                                    </th>
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
include_once "app/views/share/footer.php"; ?>