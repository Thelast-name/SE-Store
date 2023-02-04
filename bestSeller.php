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
    <title>bestSeller</title>
</head>

<body>
    <?php include('layout/navbar.php'); ?>

    <div class="main">
        <div class="banner2">
        </div>
        <div class="product">
            <?php
            $product = $db_handle->Textquery("SELECT *, SUM(INVOICE_DETAIL.Product_num) AS sumNum FROM PRODUCT INNER JOIN INVOICE_DETAIL ON PRODUCT.Product_id = INVOICE_DETAIL.Product_id GROUP BY PRODUCT.Product_id ORDER BY sumNum DESC LIMIT 5");
            foreach ($product as $key => $value) {
            ?>
                <div class="crad">
                    <img src="<?php echo $product[$key]['Product_picture']; ?>" class="imgProduct">
                    <div class="Cradbody2">
                        <p>The Best: # <?php echo $key +1; ?></p>
                        <p>Name: <?php echo $product[$key]['Product_name']; ?></p>
                    </div>
                    <div class="crad-footer">
                        <a href="bestSeller.php?id=<?php echo $product[$key]['Product_id']; ?>&no=<?php echo $key+1; ?>" class="btn_pro_id">More detali..</a>
                    </div>
                </div>
            <?php } ?>
            <?php 
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $no_best = $_GET['no'];
                }else {
                    $id = $product[0]['Product_id'];
                    $no_best = 1;
                }
            ?>
        </div>
        <div class="display_product">
            <?php
            $sql_detali = $db_handle->Textquery("SELECT * FROM PRODUCT INNER JOIN PRODUCT_TYPE ON PRODUCT.Product_type = PRODUCT_TYPE.Type_no WHERE PRODUCT.Product_id = '$id' ");
            ?>
            <div class="img-product">
                <div class="text-center">
                    <p>The Best: # <?php echo $no_best; ?></p>
                    <p>Product ID: <?php echo $sql_detali[0]['Product_id']; ?></p>
                </div>
                <img src="<?php echo $sql_detali[0]['Product_picture']; ?>" class="detalis-img">
            </div>
            <div class="details-product">
                <p>Product Detail :</p>
                <div class="detali-text">
                    <p>procut Name-> <?php echo $sql_detali[0]['Product_name']; ?></p>
                    <p>procut Type-> <?php echo $sql_detali[0]['Type_name']; ?></p>
                    <p>procut Price-> <?php echo $sql_detali[0]['Product_price']; ?></p>
                    <p>Description-> <?php echo $sql_detali[0]['Product_detail']; ?></p>
                </div>
            </div>
        </div>
</body>

</html>