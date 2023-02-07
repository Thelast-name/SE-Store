<?php 
    require_once('myscript/Myscript.php');
    $db_handle = new myDBControl();

    if(isset($_GET['st'])) {
        $st = $_GET['st'];

        if(!empty($st)){
            if($st == 'A'){
             $eid = $_POST['eid'];   
             $uname = $_POST['uname'];   
             $passwd = $_POST['passwd'];   
             $prename = $_POST['prename'];   
             $fname = $_POST['fname'];   
             $lname = $_POST['lname'];   
             $position = $_POST['position'];   
             $code1 = $_POST['code1'];   
             $code2 = $_POST['code2'];   
             $bank = $_POST['bank'];
             $salary = $_POST['salary'];
             
             $insql = $db_handle->Execquery("INSERT INTO EMPLOYEE VALUES ('$uname', '$passwd', '$eid', '$prename', '$fname', '$lname', '$position', '$code1', '$code2', '$bank', '$salary', 'img/Member/$eid.jpg')");

             if($insql){
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');window.location = 'employee.php';</script>";
             }else {
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลไม่สำเร็จ');window.location = 'employee.php';</script>";
             }
            }
            if($st == 'D'){
                $id = $_GET['id'];
                $del = $db_handle->Execquery("DELETE FROM EMPLOYEE WHERE Emp_id = '$id'");

                if($del){
                    echo "<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');window.location = 'employee.php';</script>";
                }else{
                    echo "<script type='text/javascript'>alert('ลบข้อมูลไม่สำเร็จ');window.location = 'employee.php';</script>";
                }
            }

            if($st == 'V'){
                $eid = $_POST['eid'];   
                $uname = $_POST['uname'];   
                $passwd = $_POST['passwd'];   
                $prename = $_POST['prename'];   
                $fname = $_POST['fname'];   
                $lname = $_POST['lname'];   
                $position = $_POST['position'];   
                $code1 = $_POST['code1'];   
                $code2 = $_POST['code2'];   
                $bank = $_POST['bank'];
                $salary = $_POST['salary'];

                $upsql = $db_handle->Execquery("UPDATE EMPLOYEE SET Emp_UN = '$uname', Emp_PW = '$passwd', Emp_prename = '$prename', Emp_firstname = '$fname', Emp_lastname = '$lname', Emp_pos_id = '$position', Emp_code1 = '$code1',Emp_code2 = '$code2',Emp_bank = '$bank',Emp_salary = '$salary' , Emp_picture = 'img/Member/$eid.jpg' WHERE Emp_id = '$eid'");

                if($upsql){
                    echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ');window.location = 'employee.php';</script>";
                }else {
                    echo "<script type='text/javascript'>alert('แก้ไขข้อมูลไม่สำเร็จ');window.location = 'employee.php';</script>";
                }
            }
        }

    }

?>