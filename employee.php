<?php
session_start();
require_once('myscript/Myscript.php');
$db_handle = new myDBControl();

// if(empty($_SESSION['username']) &&  empty($_SESSION['Id'])){
//   header('location: login.php');
// }
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
    <h2 class="h23">Employee Management</h2>
    <div class="page-login ba">
      <div class="col-1">
        <div class="d">
          <p class="lp">Display All Data</p>
          <button class="btn-i"><a href="?st=A">New Data</a></button>
        </div>
        <table class="tb">
          <?php
          $cus = $db_handle->Textquery("SELECT * FROM EMPLOYEE");
          foreach ($cus as $n => $val) {
          ?>

            <tr>
              <td class="tdt"><?php echo $cus[$n]['Emp_id']; ?></td>
              <td class="tdt"><?php echo $cus[$n]['Emp_prename'] . $cus[$n]['Emp_firstname'] . " " . $cus[$n]['Emp_lastname']; ?></td>
              <td class="tdt">
                <button class="btn-v"><a href="?st=V&id=<?php echo $cus[$n]['Emp_id']; ?>">view</a></button>
                <button class="btn-d"><a href="empro.php?st=D&id=<?php echo $cus[$n]['Emp_id']; ?>" onclick="return confirm('ยีนยันการลบ?');">delete</a></button>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
      <div class="col-2">
        <?php
        $id = $cus[0]['Emp_id'];
        if (isset($_GET['st'])) {
          $st = $_GET['st'];
          if (!empty($_GET['st']) == 'V') {
            if (!empty($_GET['id'])) {
              $id = $_GET['id'];
            }
          }

          if ($_GET['st'] == "A") {
            $id = "";
          }
        }
        $sp = $db_handle->Textquery("SELECT * FROM EMPLOYEE INNER JOIN POSITION ON EMPLOYEE.Emp_pos_id = POSITION.Pos_id WHERE Emp_id = '$id' ");
        ?>
        <form action="empro.php?st=<?php echo $st; ?>" method="post">
          <div class="f">
            <label class="l">Employee ID</label>
            <input type="text" name="eid" class="inp" value="<?php echo $sp[0]['Emp_id']; ?>" />
          </div>
          <div class="f">
            <label class="l">User Name</label>
            <input type="text" name="uname" class="inp" value="<?php echo $sp[0]['Emp_UN']; ?>" />
          </div>
          <div class="f">
            <label class="l">Password</label>
            <input type="text" name="passwd" class="inp" value="<?php echo $sp[0]['Emp_PW']; ?>" />
          </div>
          <div class="f">
            <label class="l">Prename</label>
            <input type="text" name="prename" class="inp" value="<?php echo $sp[0]['Emp_prename']; ?>" />
          </div>
          <div class="f">
            <label class="l">Member name</label>
            <input type="text" name="fname" class="inp" value="<?php echo $sp[0]['Emp_firstname']; ?>" />
            <input type="text" name="lname" class="inp" value="<?php echo $sp[0]['Emp_lastname']; ?>" />
          </div>
          <div class="f">
            <label class="l">Position</label>
            <select name="position" class="inp">
              <?php
              $positons = $db_handle->Textquery("SELECT * FROM POSITION");
              foreach ($positons as $k => $v) {
              ?>
                <option value="<?php echo $positons[$k]['Pos_id']; ?>"><?php echo $positons[$k]['Pos_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="f">
            <label class="l">Personnel Code</label>
            <input type="text" name="code1" class="inp" value="<?php echo $sp[0]['Emp_code1']; ?>" />
          </div>
          <div class="f">
            <label class="l">Security Code</label>
            <input type="text" name="code2" class="inp" value="<?php echo $sp[0]['Emp_code2']; ?>" />
          </div>
          <div class="f">
            <label class="l">Bank Account</label>
            <input type="text" name="bank" class="inp" value="<?php echo $sp[0]['Emp_bank']; ?>" />
          </div>
          <div class="f">
            <label class="l">Salary</label>
            <input type="text" name="salary" class="inp" value="<?php echo $sp[0]['Emp_salary']; ?>" />
          </div>
          <div class="bu">
            <img class="pim" src="<?php echo $sp[0]['Emp_picture']; ?>" />
            <button class="btn-i" type="submit">Insert/Update data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include('layout/footer.php'); ?>

</body>

</html>