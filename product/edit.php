<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id_product = '$id'";
    $query = mysqli_query($connection, $sql);
    $result = mysqli_fetch_assoc($query);
}

if (isset($_POST) && !empty($_POST)) {



    $id_category = $_POST['id_category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $status = $_POST['status'];




    $sql = "UPDATE product SET id_category = '$id_category', name = '$name', description = '$description'
        , price = '$price' , image = '$image', status = '$status' WHERE id_product = '$id'";
    if (mysqli_query($connection, $sql)) {
        //echo "เพิ่มข้อมูลสำเร็จ";
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("เเก้ไขข้อมูลสินค้าสำเร็จ");';
        $alert .= 'window.location.href = "?page=' . $_GET['page'] . '"';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);
}
$sql1 = "SELECT * FROM category_product ";
$query1 = mysqli_query($connection, $sql1);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">เเก้ไขข้อมูลสินค้า</h1>
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
                        <label class="form-label">รหัสสินค้า</label>
                        <input type="text" value="<?= $result['id_product'] ?>" class="form-control" name="id_product" placeholder="" disabled required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">วัน-เวลา ที่สร้างสินค้า</label>
                        <input type="text" value="<?= $result['created_at'] ?>" class="form-control" disabled placeholder="" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รูปภาพ</label><br><small>(กรุณาใช้ image address ในการใส่รูปภาพ)</small>
                        <input type="text" value="<?= $result['image'] ?>" class="form-control mt-2" name="image" placeholder="" required>
                    </div>


                    <div class="mb-3 col-lg-6">

                        <label class="form-label">ประเภทสินค้า</label>
                        <select name="id_category" class="form-control" required>
                            <option value="" disabled>เลือกประเภทสินค้า</option>
                            <?php foreach ($query1 as $data) : ?>
                                <option value="<?= $data['id_category'] ?>" <?= $result['id_category'] == $data['id_category'] ? 'selected' : '' ?>><?= $data['category'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อสินค้า</label>
                        <input type="text" value="<?= $result['name'] ?>" class="form-control" name="name" placeholder="" required>
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รายละเอียดสินค้า</label>
                        <textarea class="form-control " value="<?= $result['description'] ?>" style="height: 150px" name="description"><?= $result['description'] ?></textarea>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ราคา</label>
                        <input type="text" value="<?= $result['price'] ?>" class="form-control" name="price" placeholder="" required>
                    </div>

                    <div class="mb-3 col-lg-6">

                        <label class="form-label">สถานะ</label>
                        <select name="status" class="form-control" required>
                            <option value="" disabled>กำหนดการใช้งาน</option>

                            <option value="1"> เปิดใช้งาน</option>
                            <option value="0">ปิดใช้งาน</option>

                        </select>
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