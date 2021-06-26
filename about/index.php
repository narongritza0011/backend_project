<?php


$id = 0;
$sql = "SELECT * FROM tb_about WHERE id = '$id'";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);


if (isset($_POST) && !empty($_POST)) {

    // echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';
    // exit();


    $name = $_POST['name'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE tb_about SET name = '$name', description = '$description', address = '$address'
        , email = '$email' , phone = '$phone' WHERE id = '$id'";
    if (mysqli_query($connection, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("อัปเดตข้อมูลเกี่ยวกับฉันสำเร็จ");';
        $alert .= 'window.location.href = "?page=' . $_GET['page'] . '"';
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
        <h1 class="app-page-title mb-0">จัดการข้อมูลเกี่ยวกับฉัน</h1>
    </div>
    <div class="col-auto ">
        
    </div>
</div>
<hr class="mb-4">
<div class="row g-4  settings-section">

    <div class="col-12 col-md-12">

        <div class="app-card app-card-settings shadow-sm p-4 ">

            <div class="app-card-body">

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อ บุคคล / บริษัท / องค์กร</label>
                        <input type="text" value="<?= $result['name'] ?>" class="form-control" name="name" placeholder="ชื่อ บุคคล / บริษัท / องค์กร" required>
                    </div>


                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รายละเอียด</label>
                        <textarea class="form-control " style="height: 200px" name="description"><?= $result['description'] ?></textarea>
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ที่อยู่</label>
                        <textarea class="form-control " style="height: 80px" name="address" ><?= $result['address']?></textarea>
                    </div>


                    <div class="mb-3 col-lg-6">
                        <label class="form-label">อีเมล์</label>
                        <input type="email" value="<?= $result['email'] ?>" class="form-control " name="email" required>
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">เบอร์ติดต่อ</label>
                        <input value="<?= $result['phone'] ?>" class="form-control " name="phone" required>
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