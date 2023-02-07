<?php
require_once('myscript/Myscript.php');
$db_handle = new myDBControl();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mystyle.css">
    <title>Login Se store</title>
</head>

<body>
    <?php include('layout/navbar.php'); ?>

    <div class="main">
        <div class="banner2"></div>
        <div class="page-login">
            <div class="col-1">
                <h3 class="h">Welcome to SE-Store System:</h3>
                <?php
                if (isset($_SESSION['error'])) {
                ?>
                    <div class="error">
                        <?php 
                        echo $_SESSION['error']; 
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
                <form action="lnp.php" method="post">
                    <div class="login">
                        <div class="username">
                            <label class="s">User name:</label>
                            <input class="i" type="text" name="username" placeholder="User name" value="E0001">
                        </div>
                        <div class="pass">
                            <label class="s">Password:</label>
                            <input class="i" type="password" name="pass" placeholder="Password" value="qwerty">
                        </div>
                        <p class="fg"><a href="#">forgot password ?</a></p>
                        <button class="bli" type="submit" name="login">Login</button>
                    </div>
                </form>
            </div>
            <div class="col-2">
                <img class="a-img" src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80/">
                <div class="contact">
                    <p>Website: </p>
                    <p>Facebook: </p>
                    <p>Line-id: </p>
                </div>
            </div>
        </div>
        <div class="text-footer">
            <h3>Software Engineering, LPRU</h3>
            <pre class="t">
                โดยผลิตบัณฑิตที่มีความรู้และทักษะการพัฒนาซอฟต์แวร์อย่างเป็นระบบ มีความเป็นมืออาชีพใน
                การพัฒนาซอฟต์แวร์เป็นทีม มีความสามารถประยุกต์ใช้ศาสตร์และเทคโนโลยีคอมพิวเตอร์อย่าง
                มีประสิทธิภาพ เห็นคุณค่าของทรัพย์สินทางปัญญา และมีคุณธรรมจริยธรรมในวิชาชีพ
            </pre>
        </div>
    </div>

    <?php include('layout/footer.php'); ?>
</body>

</html>