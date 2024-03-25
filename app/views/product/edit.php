<?php
include_once "app/views/share/header.php"; ?>
<?php
if (isset($errors)) {
    echo "<ul>";
    foreach ($errors as $err) {
        echo "<li class='text-danger'>$err</li>";
    }
    echo "</ul>";
}

?>
<div class="card-body p-5">
    <form class="user" action="/chieu2-main/product/save" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product->id ?>">

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input value="<?= $product->name ?>" type="text" class="form-control form-control-user" id="name" name="name" placeholder="Product Name">
            </div>
            <div class="col-sm-6">
                <input value="<?= $product->price ?>" type="number" class="form-control form-control-user" id="price" name="price" placeholder="Product Price">
            </div>
        </div>
        <div class="form-group">
            <input value="<?= $product->description ?>" type="text" class="form-control form-control-user" id="description" name="description" placeholder="Product Description">
        </div>
        <div class="form-group">
            <?php
            if (empty($product->image) || !file_exists($product->image)) {
                echo "No Image!";
            } else {
                echo "<img src='/chieu2-main/" . $product->image . "'alt='product'/>";
            }
            ?>
        </div>

        <div class="form-group">
            <input type="file" class="form-control form-control-user" id="image" name="image">
        </div>
        <button class="btn btn-primary btn-user btn-block">
            Save Product
        </button>
    </form>
</div>

<?php
include_once "app/views/share/footer.php"; ?>