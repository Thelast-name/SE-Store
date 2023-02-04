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
  <title>Member</title>
</head>

<body>

  <div class="header">
    <div class="main">
      <div class="title">
        Member Zone
      </div>
      <ul class="menuber">
        <p>Hello! <?php echo $_SESSION['username']; ?></p>
        <li><a href="employee.php">Employee</a></li>
        <li><a href="member.php">Member</a></li>
        <li><a href="logout.php?logout=1">Logout</a></li>
      </ul>
    </div>
  </div>

  <div class="mian">
    <h2 class="h23">Member Management</h2>
    <div class="page-login ba">
      <div class="col-1">
        <div class="d">
          <p class="lp">Display All Data</p>
          <button class="btn-i">New Data</button>
        </div>
        <table class="tb">
          <?php
          $cus = $db_handle->Textquery("SELECT * FROM CUSTOMER");
          foreach ($cus as $n => $val) {
          ?>

            <tr>
              <td class="tdt"><?php echo $cus[$n]['Cust_id']; ?></td>
              <td class="tdt"><?php echo $cus[$n]['Cust_prename'] . $cus[$n]['Cust_firstname'] . " " . $cus[$n]['Cust_lastname']; ?></td>
              <td class="tdt">
                <button class="btn-v"><a href="?id=<?php echo $cus[$n]['Cust_id']; ?>">view</a></button>
                <button class="btn-d">delete</button>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
      <div class="col-2">
        <?php 
        if(!empty($_GET['id'])){
          $id = $_GET['id'];
          $sp = $db_handle->Textquery("SELECT * FROM CUSTOMER INNER JOIN MEMBER_LEVEL ON CUSTOMER.Cust_level = MEMBER_LEVEL.Lev_id WHERE Cust_id = '$id' ");
        }else {
          $id = '';
          $sp = $db_handle->Textquery("SELECT * FROM CUSTOMER INNER JOIN MEMBER_LEVEL ON CUSTOMER.Cust_level = MEMBER_LEVEL.Lev_id WHERE Cust_id = '$id' ");
        }
        ?>
        <p>id: <?php echo $sp[0]['Cust_id']; ?></p>
        <div class="f">
          <label class="l">User Name</label>
          <input type="text" name="" class="inp" value="<?php echo $sp[0]['Cust_UN']; ?>" />
        </div>
        <div class="f">
          <label class="l">Password</label>
          <input type="text" name="" class="inp" value="<?php echo $sp[0]['Cust_PW']; ?>" />
        </div>
        <div class="f">
          <label class="l">Prename</label>
          <input type="text" name="" class="inp" value="<?php echo $sp[0]['Cust_prename']; ?>"/>
        </div>
        <div class="f">
          <label class="l">Member name</label>
          <input type="text" name="" class="inp" value="<?php echo $sp[0]['Cust_firstname'] . " " . $sp[0]['Cust_lastname']; ?>" />
        </div>
        <div class="f">
          <label class="l">Member Level</label>
          <input type="text" name="" class="inp" value="<?php echo $sp[0]['Lev_descript']; ?>"/>
        </div>
        <div class="f">
          <label class="l">Brithday</label>
          <input type="text" name="" class="inp" value="<?php echo $sp[0]['Cust_birth']; ?>"/>
        </div>
        <div class="f">
          <label class="l">Address</label>
          <textarea name="" id="" cols="15" rows="5" class="inp"><?php echo $sp[0]['Cust_address']; ?></textarea>
        </div>
        <div class="f">
          <label class="l">Telephone</label>
          <input type="text" name="" class="inp" value="<?php echo $sp[0]['Cust_tel']; ?>" />
        </div>
        <div class="bu">
          <img class="pim" src="<?php echo $sp[0]['Cust_picture']; ?>" />
          <button class="btn-i">Insert/Update data</button>
        </div>
      </div>
    </div>
  </div>
  <?php include('layout/footer.php'); ?>

</body>

</html>