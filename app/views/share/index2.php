<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
    <style>
    .icon-hover:hover {
        border-color: #3b71ca !important;
        background-color: white !important;
    }

    .icon-hover:hover i {
        color: #3b71ca !important;
    }
    </style>
</head>

<body>
    <!--Main Navigation-->
    <?php
    include_once "app/views/share/header.php"; ?>

    <!-- sidebar + content -->
    <section class="">
        <div class="container">
            <div class="row">

                <!-- content -->
                <div class="col-lg-9">
                    <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
                        <strong class="d-block py-2">32 Items found </strong>
                        <div class="ms-auto">
                            <select class="form-select d-inline-block w-auto border pt-1">
                                <option value="0">Best match</option>
                                <option value="1">Recommended</option>
                                <option value="2">High rated</option>
                                <option value="3">Randomly</option>
                            </select>
                            <div class="btn-group shadow-0 border">
                                <a href="#" class="btn btn-light" title="List view">
                                    <i class="fa fa-bars fa-lg"></i>
                                </a>
                                <a href="#" class="btn btn-light active" title="Grid view">
                                    <i class="fa fa-th fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </header>

                    <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12">
                            <div class="card shadow-0 border rounded-3">
                                <div class="card-body">
                                    <div class="row g-0">
                                        <div class="col-xl-3 col-md-4 d-flex justify-content-center">
                                            <div
                                                class="bg-image hover-zoom ripple rounded ripple-surface me-md-3 mb-3 mb-md-0">

                                                <?php
                                                    if (empty($row["image"]) || !file_exists($row["image"])) {
                                                        echo "No Image!";
                                                    } else {
                                                        echo "<img  src='/chieu2-main/" . $row["image"] . "' class='w-100' alt='product ' />";
                                                    }
                                                    ?>
                                                <a href="#!">
                                                    <div class="hover-overlay">
                                                        <div class="mask"
                                                            style="background-color: rgba(253, 253, 253, 0.15);"></div>
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
                                                <h4 class="mb-1 me-1"><?= $row["price"] ?></h4>
                                                <!-- <span class="text-danger"><s>$49.99</s></span> -->
                                            </div>
                                            <h6 class="text-success">Free shipping</h6>
                                            <div class="mt-4">
                                                <button class="btn btn-primary shadow-0" type="button">Buy this</button>
                                                <a href="#!" class="btn btn-light border px-2 pt-2 icon-hover"><i
                                                        class="fas fa-heart fa-lg px-1"></i></a>
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
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- Pagination -->
                </div>
            </div>
        </div>
    </section>

</body>

</html>