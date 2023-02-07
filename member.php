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
          <button class="btn-i"><a href="?st=A">New Data</a></button>
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
                <button class="btn-v"><a href="?st=V&id=<?php echo $cus[$n]['Cust_id']; ?>">view</a></button>
                <button class="btn-d"><a href="MemberProcess.php?st=D&id=<?php echo $cus[$n]['Cust_id']; ?>" onclick="return confirm('ยีนยันการลบ?');">delete</a></button>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
      <div class="col-2">
        <?php 
        $id = $cus[0]['Cust_id'];
         if(isset($_GET['st'])){
          $st = $_GET['st'];
          if(!empty($_GET['st']) == 'V'){
            if(!empty($_GET['id'])){
              $id = $_GET['id'];
            }
          }
          
          if($_GET['st'] == "A"){
            $id = "";
          }
        }
        $sp = $db_handle->Textquery("SELECT * FROM CUSTOMER INNER JOIN MEMBER_LEVEL ON CUSTOMER.Cust_level = MEMBER_LEVEL.Lev_id WHERE Cust_id = '$id' ");
        ?>
        <form action="MemberProcess.php?st=<?php echo $st; ?>" method="post">
        <div class="f">
          <label class="l">Member ID</label>
          <input type="text" name="cid" class="inp" value="<?php echo $sp[0]['Cust_id']; ?>"/>
        </div>
        <div class="f">
          <label class="l">User Name</label>
          <input type="text" name="Uname" class="inp" value="<?php echo $sp[0]['Cust_UN']; ?>" />
        </div>
        <div class="f">
          <label class="l">Password</label>
          <input type="text" name="passwd" class="inp" value="<?php echo $sp[0]['Cust_PW']; ?>" />
        </div>
        <div class="f">
          <label class="l">Prename</label>
          <input type="text" name="prename" class="inp" value="<?php echo $sp[0]['Cust_prename']; ?>"/>
        </div>
        <div class="f">
          <label class="l">Member name</label>
          <input type="text" name="fname" class="inp" value="<?php echo $sp[0]['Cust_firstname']; ?>" />
          <input type="text" name="lname" class="inp" value="<?php echo $sp[0]['Cust_lastname']; ?>" />
        </div>
        <div class="f">
          <label class="l">Member Level</label>
          <select name="nlevel" class="inp">
            <?php 
            $mem_le = $db_handle->Textquery("SELECT * FROM MEMBER_LEVEL");
              foreach($mem_le as $key => $v){ ?>
                <option value="<?php echo $mem_le[$key]['Lev_id']; ?>"><?php echo $mem_le[$key]['Lev_descript']; ?></option>
              <?php }?>
          </select>
        </div>
        <div class="f">
          <label class="l">Brithday</label>
          <input type="text" name="brith" class="inp" value="<?php echo $sp[0]['Cust_birth']; ?>"/>
        </div>
        <div class="f">
          <label class="l">Address</label>
          <textarea name="address" cols="15" rows="5" class="inp"><?php echo $sp[0]['Cust_address']; ?></textarea>
        </div>
        <div class="f">
          <label class="l">Telephone</label>
          <input type="text" name="tel" class="inp" value="<?php echo $sp[0]['Cust_tel']; ?>" />
        </div>
        <div class="bu">
          <img class="pim" src="<?php echo $sp[0]['Cust_picture']; ?>" />
          <button class="btn-i" type="submit">Insert/Update data</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php include('layout/footer.php'); ?>

</body>

</html>