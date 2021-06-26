<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_admin WHERE id = '$id'";
    $query = mysqli_query($connection, $sql);
    $result = mysqli_fetch_assoc($query);
}

if (isset($_POST) && !empty($_POST)) {
    // print_r($_POST);
    //echo'<pre>';
    //print_r($_FILES);
    //echo'</pre>';
    //exit();
    $pass = sha1(md5($_POST['pass']));
    $confirmpass = sha1(md5($_POST['confirmpass']));
    if ($pass != $confirmpass) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ยืนยันรหัสผ่านใหม่ไม่ถูกต้อง กรุณากรอกใหม่อีกครั้ง");';
        $alert .= 'window.location.href = "?page=admin&function=resetpassword&id='.$id.'";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        $sql = "UPDATE tb_admin SET pass = '$pass' WHERE id = '$id'";
        if (mysqli_query($connection, $sql)) {
            //echo "อัปเดตข้อมูลสำเร็จ";
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("รีเซ็ตรหัสผ่าน ชื่อผู้ใช้ : '.$result['user'].' สำเร็จ");';
            $alert .= 'window.location.href = "?page=admin";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
            mysqli_close($connection);
    }
}

?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">รีเซ็ตรหัสผ่าน ชื่อผู้ใช้ : <?= $result['user'] ?></h1>
    </div>
    <div class="col-auto ">
        <div class="d-flex justify-content-start">
            <a href="?page=<?= $_GET['page'] ?>" class="btn app-btn-secondary  mb-2 float-right">ย้อนกลับ</a>
        </div>
    </div>
</div>
<hr class="mb-4">
<div class="row g-4  settings-section">

    <div class="col-12 col-md-12">

        <div class="app-card app-card-settings shadow-sm p-4 ">

            <div class="app-card-body">

                <form action="" method="POST" enctype="multipart/form-data">


                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รหัสผ่านใหม่</label>
                        <input type="text" class="form-control" name="pass" placeholder="" required>
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ยืนยันรหัสผ่านใหม่</label>
                        <input type="text" class="form-control" name="confirmpass" placeholder="" required>
                    </div>



                    <button type="submit" class="btn app-btn-primary">บันทึก</button>
                </form>
            </div>
            <!--//app-card-body-->

        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->


<script type="text/javascript">
    function triggerFile() {

        $("#image").trigger("click");
        return false
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function() {
        readURL(this);
    });
</script>