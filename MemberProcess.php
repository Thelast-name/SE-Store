<?php 
    require_once('myscript/Myscript.php');
    $db_handle = new myDBControl();

    if(isset($_GET['st'])) {
        $st = $_GET['st'];

        if(!empty($st)){
            if($st == 'A'){
             $cid = $_POST['cid'];   
             $uname = $_POST['Uname'];   
             $passwd = $_POST['passwd'];   
             $prename = $_POST['prename'];   
             $fname = $_POST['fname'];   
             $lname = $_POST['lname'];   
             $nlevel = $_POST['nlevel'];   
             $brith = $_POST['brith'];   
             $address = $_POST['address'];   
             $tel = $_POST['tel'];
             
             $insql = $db_handle->Execquery("INSERT INTO CUSTOMER VALUES ('$uname', '$passwd', '$cid', '$prename', '$fname', '$lname', '$nlevel', '$brith', '$address', '$tel ', 'img/Member/$cid.jpg')");

             if($insql){
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');window.location = 'member.php';</script>";
             }else {
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลไม่สำเร็จ');window.location = 'member.php';</script>";
             }
            }
            if($st == 'D'){
                $id = $_GET['id'];
                $del = $db_handle->Execquery("DELETE FROM CUSTOMER WHERE Cust_id = '$id'");

                if($del){
                    echo "<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');window.location = 'member.php';</script>";
                }else{
                    echo "<script type='text/javascript'>alert('ลบข้อมูลไม่สำเร็จ');window.location = 'member.php';</script>";
                }
            }

            if($st == 'V'){
                $cid = $_POST['cid'];   
                $uname = $_POST['Uname'];   
                $passwd = $_POST['passwd'];   
                $prename = $_POST['prename'];   
                $fname = $_POST['fname'];   
                $lname = $_POST['lname'];   
                $nlevel = $_POST['nlevel'];   
                $brith = $_POST['brith'];   
                $address = $_POST['address'];   
                $tel = $_POST['tel'];

                $upsql = $db_handle->Execquery("UPDATE CUSTOMER SET Cust_UN = '$uname',Cust_PW = '$passwd',Cust_prename = '$prename',Cust_firstname = '$fname',Cust_lastname = '$lname',Cust_level = '$nlevel',Cust_birth = '$brith',Cust_address = '$address',Cust_tel = '$tel',Cust_picture = 'img/Member/' WHERE Cust_id = '$cid'");

                if($upsql){
                    echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ');window.location = 'member.php';</script>";
                }else {
                    echo "<script type='text/javascript'>alert('แก้ไขข้อมูลไม่สำเร็จ');window.location = 'member.php';</script>";
                }
            }
        }

    }

?>