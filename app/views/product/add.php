<?php
include_once "app/views/share/header.php"; ?>


<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="/chieu2-main/product/save" method="post" enctype="multipart/form-data">
                    <h1 class="mt-5">Add Products</h1>
                    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mt-5">
                    </div>

                    <?php
                    if (isset($errors)) {
                        echo "<ul>";
                        foreach ($errors as $err) {
                            echo "<li class='text-danger'>$err</li>";
                        }
                        echo "</ul>";
                    }

                    ?>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Product Name">
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="number" class="form-control form-control-lg" id="price" name="price" placeholder="Product Price">
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" class="form-control form-control-lg" id="description" name="description" placeholder="Product Description">
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="file" class="form-control form-control-lg" id="image" name="image">
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include_once "app/views/share/footer.php"; ?>