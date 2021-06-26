<?php
$user_login = $_SESSION['user_login'];
$sql = "SELECT * FROM orders";
$query = mysqli_query($connection, $sql);


?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ตารางออเดอร์ลูกค้า</h1>
    </div>
    <div class="col-auto">

    </div>
</div>

<hr class="mb-4">
<div class="row g-4  settings-section">
    <div class="col-12 col-md-12 ">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body ">

                <table class="table  table-hover" id="tableall">
                    <thead class="text-center ">
                        <tr>
                         
                            <th scope="col">หมายเลขคำสั่งซื้อ</th>
                            <th scope="col">เลขที่ผู้ใช้</th>
                            <th scope="col">วัน-เวลา</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">เมนู</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($query as $data) : ?>
                            <tr>
                                <td class="align-middle"><?= $data['invoice'] ?></td>
                                <td class="align-middle"><?= $data['id_user'] ?></td>
                                <td class="align-middle"><?= $data['order_at'] ?></td>
                                <td class="align-middle"><?= ($data['status'] == 1 ? '<span class="badge bg-success text-white">ปกติ</span>' : '<span class="badge bg-danger text-white">ยกเลิก</span>') ?></td>
                                <td class="align-middle">
                                <a href="?page=<?= $_GET['page'] ?>&function=view&id=<?= $data['invoice'] ?>" class="btn btn-sm btn-info text-white">ดูรายละเอียด</a>
                                    <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$data['id_orders']?>" class="btn btn-sm btn-warning text-white">เเก้ไข</a>
                                    <a onclick="return confirm('คุณต้องการลบ ชื่อผู้ใช้ : <?= $data['invoice'] ?> หรือไม่')" href="?page=<?= $_GET['page'] ?>&function=delete&id=<?= $data['id'] ?>"" class=" btn btn-sm btn-danger text-white">ลบ</a>
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