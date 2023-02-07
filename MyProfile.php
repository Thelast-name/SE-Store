<?php 
  session_start(); 
  require_once('myscript/Myscript.php');
  $db_handle = new myDBControl();

  if(empty($_SESSION['username']) &&  empty($_SESSION['Id'])){
    header('location: login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/mystyle.css" />
  <title>My Profile</title>
</head>

<body>
  <div class="header">
    <div class="main">
      <div class="title">
        Member Zone
      </div>
      <ul class="menuber">
        <p>Hello! <?php echo $_SESSION['username']; ?></p>
        <li><a href="logout.php?logout=1">Logout</a></li>
      </ul>
    </div>
  </div>
  <?php 
    $id = $_SESSION['Id'];
    $myProfile = $db_handle->Textquery("SELECT *, SUM(INVOICE_DETAIL.Product_num) AS sum_pro, SUM(INVOICE_DETAIL.Product_num * INVOICE_DETAIL.Product_price) AS price, COUNT(DISTINCT INVOICE.Inv_no) AS n FROM CUSTOMER INNER JOIN INVOICE ON CUSTOMER.Cust_id = INVOICE.Inv_cust INNER JOIN INVOICE_DETAIL ON INVOICE.Inv_no = INVOICE_DETAIL.Inv_no WHERE Inv_cust = '$id'");
  ?>
  <div class="main">
    <h2 class="h23">My Profile</h2>
    <div class="page-login">
      <div class="col-1">
        <h3 class="h33">Member Data : <?php echo $myProfile[0]['Cust_id']; ?></h3>
        <div class="login">
          <div class="f">
            <label class="l">User Name</label>
            <input type="text" class="inp" value="<?php echo $myProfile[0]['Cust_UN']; ?>"/>
          </div>
          <div class="f">
            <label class="l">Password</label>
            <input type="text" class="inp" value="<?php echo $myProfile[0]['Cust_PW']; ?>"/>
          </div>
          <div class="f">
            <label class="l">Prename</label>
            <input type="text" class="inp" value="<?php echo $myProfile[0]['Cust_prename']; ?>" />
          </div>
          <div class="f">
            <label class="l">Member name</label>
            <input type="text" class="inp" value="<?php echo $myProfile[0]['Cust_firstname'] . " " . $myProfile[0]['Cust_lastname']; ?>" />
          </div>
          <div class="f">
            <label class="l">Member Level</label>
            <input type="text" class="inp" value="<?php echo $myProfile[0]['Cust_level']; ?>" />
          </div>
          <div class="f">
            <label class="l">Brithday</label>
            <input type="text" class="inp" value="<?php echo $myProfile[0]['Cust_birth']; ?>" />
          </div>
          <div class="f">
            <label class="l">Address</label>
            <textarea id="" cols="15" rows="5" class="inp"><?php echo $myProfile[0]['Cust_address']; ?></textarea>
          </div>
          <div class="f">
            <label class="l">Telephone</label>
            <input type="text" class="inp" value="<?php echo $myProfile[0]['Cust_tel']; ?>"/>
          </div>
        </div>
      </div>
      <div class="col-2">
        <h2>My Picture</h2>
        <img class="img-p" src="<?php echo $myProfile[0]['Cust_picture']; ?>"/>
        <div>
          <p>จำนวนซื้อ <?php echo $myProfile[0]['n']; ?> ครั้ง</p>
          <p>จำนวนสินค้า <?php echo $myProfile[0]['sum_pro']; ?> หน่วย</p>
          <p>จำนวนเงิน <?php echo $myProfile[0]['price']; ?> บาท</p>
        </div>
      </div>
    </div>
  </div>
  <?php include('layout/footer.php'); ?>
</body>

</html>