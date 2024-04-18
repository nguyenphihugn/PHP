<?php
include_once "app/views/share/header.php"; ?>

<!-- sidebar + content -->
<section class="">
    <div class="container">
        <div class="row">

            <h1> Sản phẩm đang được bán tại Q3H Fishing Shop</h1>
            <!-- content -->
            <div class="col-lg-9">

                <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12">
                            <div class="card shadow-0 border rounded-3">
                                <div class="card-body">
                                    <div class="row g-0">
                                        <div class="col-xl-3 col-md-4 d-flex justify-content-center">
                                            <div class="bg-image hover-zoom ripple rounded ripple-surface me-md-3 mb-3 mb-md-0">

                                                <?php
                                                if (empty($row["image"]) || !file_exists($row["image"])) {
                                                    echo "No Image!";
                                                } else {
                                                    echo "<img  src='/chieu2-main/" . $row["image"] . "' class='w-100' alt='product ' />";
                                                }
                                                ?>
                                                <a href="#!">
                                                    <div class="hover-overlay">
                                                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-5 col-sm-7">
                                            <h5><?= $row["name"] ?></h5>


                                            <p class="text mb-4 mb-md-0">
                                                <th><?= $row["description"] ?></th>
                                            </p>
                                        </div>
                                        <div class="col-xl-3 col-md-3 col-sm-5">
                                            <div class="d-flex flex-row align-items-center mb-1">
                                                <h4 class="mb-1 me-1"><?= $row["price"] ?> VND</h4>
                                                <!-- <span class="text-danger"><s>$49.99</s></span> -->
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <form class="user mb-2" action="/chieu2-main/Cart/addtocart" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <button type="submit" name="add_to_cart" class="btn btn-outline-secondary">Add To Cart</button>
                                                    </form>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="d-flex align-items-center mt-1">
                                                        <a href="/chieu2-main/product/edit/<?= $row['id'] ?>" class="btn btn-light border px-2 pt-2 icon-hover-blue mr-2"><i class="fas fa-edit fa-lg px-1"></i></a>
                                                        <a href="/chieu2-main/product/delete/<?= $row['id'] ?>" class="btn btn-light border px-2 pt-2 icon-hover-red"><i class="fas fa-trash fa-lg px-1"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>


                <hr />

                <!-- Pagination -->

                <!-- Pagination -->
            </div>
        </div>
    </div>
</section>

<?php
include_once "app/views/share/footer.php"; ?>