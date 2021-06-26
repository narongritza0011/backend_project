<?php

if (isset($_POST) && !empty($_POST)) {

    //echo'<pre>';
    //print_r($_POST);
    //print_r($_FILES);
    //echo'</pre>';
    // exit();


    $category = $_POST['category'];

    $image = $_POST['image'];
    $status = $_POST['status'];



    $sql = "INSERT INTO category_product
              (category,image,status)
             VALUES ('$category','$image','$status')";
    if (mysqli_query($connection, $sql)) {
        //echo "เพิ่มข้อมูลสำเร็จ";
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("เพิ่มข้อมูลสินค้าสำเร็จ");';
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
        <h1 class="app-page-title mb-0">เพิ่มประเภทสินค้า</h1>
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
                        <label class="form-label">ที่อยู่รูปภาพ</label><br><small>(ต้องเพิ่มรูปภาพในไฟล์เเอพ)</small>
                        <input type="text" class="form-control mt-2" name="image" placeholder="assets/ชื่อรูปภาพ" required>
                    </div>





                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อประเภทสินค้า</label>
                        <input type="text" class="form-control" name="category" placeholder="" required>
                    </div>

                    
                     <div class="mb-3 col-lg-6">
                        <label class="form-label">สถานะ</label>
                        <select name="status" class="form-control" required>
                            <option value="" disabled>กำหนดการใช้งาน</option>
                            <option value="1"> เปิดใช้งาน</option>
                            <option value="2" disabled>ปิดใช้งาน</option>
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