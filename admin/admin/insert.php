<?php

if (isset($_POST) && !empty($_POST)) {
    // print_r($_POST);
    //echo'<pre>';
    //print_r($_FILES);
    //echo'</pre>';
    //exit();

    $user = $_POST['user'];
    $pass = sha1(md5($_POST['pass']));
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    if (!empty($user)) {
        $sql_check = "SELECT * FROM tb_admin WHERE user = '$user'";
        $query_check = mysqli_query($connection, $sql_check);
        $row_check = mysqli_num_rows($query_check);
        if ($row_check > 0) {
            //echo 'ชื่อผู้ใช้ ซ้ำกรุณากรอกใหม่อีกครั้ง';
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("ชื่อผู้ใช้ ซ้ำกรุณากรอกใหม่อีกครั้ง");';
            $alert .= 'window.location.href = "?page=admin&function=add"';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                $extension = array("jpeg", "jpg", "png");
                $target = 'upload/admin/';
                $filename = $_FILES['image']['name'];
                $filetmp = $_FILES['image']['tmp_name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (in_array($ext, $extension)) {
                    if (!file_exists($target . $filename)) {
                        if (move_uploaded_file($filetmp, $target . $filename)) {
                            $filename = $filename;
                        } else {
                            //echo 'เพิ่มไฟล์เข้า folder ไม่สำเร็จ';
                            $alert = '<script type="text/javascript">';
                            $alert .= 'alert("เพิ่มไฟล์เข้า folder ไม่สำเร็จ");';
                            $alert .= 'window.location.href = "?page=admin&function=add"';
                            $alert .= '</script>';
                            echo $alert;
                            exit();
                        }
                    } else {
                        $newfilename = time() . $filename;
                        if (move_uploaded_file($filetmp, $target . $newfilename)) {
                            $filename = $newfilename;
                        } else {
                            //  echo 'รูปภาพไม่สามารถบันทึกเข้า folder ได้';
                            $alert = '<script type="text/javascript">';
                            $alert .= 'alert("รูปภาพไม่สามารถบันทึกเข้า");';
                            $alert .= 'window.location.href = "?page=admin&function=add"';
                            $alert .= '</script>';
                            echo $alert;
                            exit();
                        }
                    }
                } else {
                    //echo 'ประเภทไฟล์ไม่ถูกต้อง';
                    $alert = '<script type="text/javascript">';
                    $alert .= 'alert("ประเภทไฟล์ไม่ถูกต้อง");';
                    $alert .= 'window.location.href = "?page=admin&function=add"';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                    
                }
            } else {
                $filename = '';
            }
            // echo $filename;

            //exit();

            $sql = "INSERT INTO tb_admin
              (firstname,lastname,email,phone,user,pass,image)
             VALUES ('$firstname','$lastname','$email','$phone','$user','$pass','$filename')";
            if (mysqli_query($connection, $sql)) {
                //echo "เพิ่มข้อมูลสำเร็จ";
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("เพิ่มข้อมูลสำเร็จ");';
                $alert .= 'window.location.href = "?page=admin"';
                $alert .= '</script>';
                echo $alert;
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }

            mysqli_close($connection);
        }
    }
}
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">เพิ่มข้อมูลผู้ดูเเลระบบ</h1>
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
                    <div class="mb-3">
                        <label class="form-label ">รูปภาพประจำตัว </label>
                        <div class="mb-3">
                            <img id="preview" class="rounded" width="150" height="150">

                        </div>
                        <button onclick="return triggerFile();" class="btn btn-success text-white">เลือกรูปภาพ</button>
                        <small>ไฟล์ประเภท JPEG กับ PNG เท่านั้น</small>
                        <input type="file" name="image" id="image" style="display:none;">
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="user" placeholder="ชื่อผู้ใช้" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" name="pass" placeholder="ตัวอักษร a-z ตัวเลข 0-9" required>
                    </div>
                    <hr class="mb-4 mt-4 ">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="firstname" value="<?= (isset($_POST['firstname']) && !empty($_POST['firstname']) ? $_POST['firstname'] : '') ?>" placeholder="" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="lastname" value="<?= (isset($_POST['lastname']) && !empty($_POST['lastname']) ? $_POST['lastname'] : '') ?>" placeholder="" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">อีเมล์</label>
                        <input type="email" class="form-control" name="email" value="<?= (isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : '') ?>" placeholder="" autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" name="phone" placeholder="" value="<?= (isset($_POST['phone']) && !empty($_POST['phone']) ? $_POST['phone'] : '') ?>" required>
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