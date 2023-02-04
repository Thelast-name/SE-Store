<?php
require_once('myscript/Myscript.php');
$db_handle = new myDBControl();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mystyle.css">
    <title>allProdcut</title>
</head>

<body>
    <?php include('layout/navbar.php'); ?>

    <div class="main">
        <div class="banner2">
        </div>
        <div class="product">
            <?php
            $product = $db_handle->Textquery("SELECT *, CONCAT(LEFT(Product_name, 13),'...') AS New_name, SUBSTRING(Type_name,LOCATE('-',Type_name)+1,50) AS New_type FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type = PRODUCT_TYPE.Type_no)");
            foreach ($product as $key => $value) {
            ?>
                <div class="crad">
                    <img src="<?php echo $product[$key]['Product_picture']; ?>" class="imgProduct">
                    <div class="Cradbody">
                        <p>Type: <?php echo $product[$key]['New_type']; ?></p>
                        <p>Name: <?php echo $product[$key]['New_name']; ?></p>
                        <p>Price: <?php echo $product[$key]['Product_price']; ?></p>
                        <p>Quantity: <?php echo $product[$key]['Product_count']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include('layout/footer.php'); ?>

</body>

</html>