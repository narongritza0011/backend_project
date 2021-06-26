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


    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $oldimage = $_POST['oldimage'];

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
                    $alert .= 'window.location.href = "?page=admin&function=update&id=' . $id . '"';
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
                    $alert .= 'window.location.href = "?page=admin&function=update&id=' . $id . '"';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                }
            }
        } else {
            //echo 'ประเภทไฟล์ไม่ถูกต้อง';
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("ประเภทไฟล์ไม่ถูกต้อง");';
            $alert .= 'window.location.href = "?page=admin&function=update&id=' . $id . '"';
            $alert .= '</script>';
            echo $alert;
            exit();
        }
    } else {
        $filename = $oldimage;
    }
    // echo $filename;

    //exit();
    $sql = "UPDATE tb_admin SET firstname = '$firstname', lastname = '$lastname', email = '$email'
        , phone = '$phone' , image = '$filename' WHERE id = '$id'";
    if (mysqli_query($connection, $sql)) {
        //echo "เพิ่มข้อมูลสำเร็จ";
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("เเก้ไขข้อมูลสำเร็จ");';
        $alert .= 'window.location.href = "?page=admin"';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);
}

?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">เเก้ไขข้อมูลผู้ดูเเลระบบ</h1>
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
                            <img id="preview" src="upload/admin/<?= $result['image'] ?>" class="rounded" width="150" height="150">

                        </div>
                        <button onclick="return triggerFile();" class="btn btn-success text-white">เลือกรูปภาพ</button>
                        <small>ไฟล์ประเภท JPEG กับ PNG เท่านั้น</small>
                        <input type="file" name="image" id="image" style="display:none;">
                        <input type="hidden" name="oldimage" value="<?= $result['image'] ?>">

                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Username</label>
                        <input type="text" value="<?= $result['user'] ?>" class="form-control" name="user" placeholder="ชื่อผู้ใช้" disabled required>
                    </div>

                    <hr class="mb-4 mt-4 ">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" value="<?= $result['firstname'] ?>" class="form-control" name="firstname" placeholder="" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" value="<?= $result['lastname'] ?>" class="form-control" name="lastname" placeholder="" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">อีเมล์</label>
                        <input type="email" value="<?= $result['email'] ?>" class="form-control" name="email" placeholder="" autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">เบอร์ติดต่อ</label>
                        <input type="text" value="<?= $result['phone'] ?>" class="form-control" name="phone" placeholder="" required>
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