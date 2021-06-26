<?php
$user_login = $_SESSION['user_login'];
$sql = "SELECT * FROM user";
$query = mysqli_query($connection, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ตารางข้อมูลสมาชิก</h1>
    </div>
    <div class="col-auto">

    </div>
</div>

<hr class="mb-4">
<div class="row g-4  settings-section">
    <div class="col-12 col-md-12 ">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body ">
                <div class="d-flex justify-content-end ">

                    <table class="table  table-hover" id="tableall">
                        <thead class="text-center ">
                            <tr>
                                <th scope="col">หมายเลขผู้ใช้</th>
                                <th scope="col">ชื่อ - นามสกุล</th>
                                <th scope="col">อีเมล์</th>
                                <th scope="col">เบอร์ติดต่อ</th>
                                <th scope="col">ที่อยู่</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">วันที่สร้างบัญชี</th>
                                <th scope="col">เมนู</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach ($query as $data) : ?>
                                <tr>
                                    <td class="align-middle"><?= $data['id_user'] ?></td>
                                    <td class="align-middle"><?= $data['name'] ?></td>
                                    <td class="align-middle"><?= $data['email'] ?></td>
                                    <td class="align-middle"><?= $data['phone'] ?></td>
                                    <td class="align-middle"><?= $data['address'] ?></td>
                                    <td class="align-middle"><?= ($data['status'] == 1 ? '<span class="badge bg-success text-white">เปิดใช้งาน</span>' : '<span class="badge bg-danger text-white">ปิดใช้งาน</span>') ?></td>
                                    <td class="align-middle"><?= $data['created_at'] ?></td>
                                    <td class="align-middle">
                                        <a href="?page=<?= $_GET['page'] ?>&function=update&id=<?= $data['id_user'] ?>" class="btn btn-sm btn-warning text-white">เเก้ไข</a>
                                        <a onclick="return confirm('คุณต้องการลบ ชื่อผู้ใช้ : <?= $data['name'] ?> หรือไม่')" href="?page=<?= $_GET['page'] ?>&function=delete&id=<?= $data['id_user'] ?>"" class=" btn btn-sm btn-danger text-white">ลบ</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->
        </div>
    </div>
    <!--//row-->




    <script type="text/javascript">
        $(document).ready(function() {
            $('#tableall').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "ไม่มีข้อมูล",
                    "info": "เเสดง _START_ - _END_ จาก _TOTAL_ รายการทั้งหมด",
                    "infoEmpty": "เเสดง 0 - 0 จาก 0 รายการ",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "เเสดง _MENU_ รายการ",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "search": "ค้าหา:",
                    "zeroRecords": "ไม่มีข้อมูลที่ค้นหา",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "หน้าถัดไป",
                        "previous": "ก่อนหน้า"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                }
            });
        });
    </script>

    <?php
    mysqli_close($connection);
    ?>