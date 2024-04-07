<?php
include_once "app/views/share/header.php"; ?>

<div class="card-body p-5">
    <form class="user" action="/chieu2-main/Cart/addtocart" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product->id ?>">

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input value="<?= $product->name ?>" readonly type="text" class="form-control form-control-user" id="name" name="name" placeholder="Product Name">
            </div>
            <button type="submit" name="add_to_cart" class="btn btn-primary btn-user btn-block">
                Confirm Add to Cart
            </button>
        </div>
    </form>
</div>

<?php
include_once "app/views/share/footer.php"; ?>