<?php
if (isset($_POST) && !empty($_POST)) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    $user = $_POST['user'];
    $pass = sha1(md5($_POST['pass']));
   // echo sha1(md5($pass));
   // exit();
    $sql = "SELECT * FROM tb_admin WHERE user = '$user' AND pass = '$pass'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_num_rows($query);
    if ($row > 0) {
        $result = mysqli_fetch_assoc($query);
        $_SESSION['user_login'] = $result['user'];
        $_SESSION['image_login'] = $result['image'];
  
        //echo "เข้าสู่ระบบสำเร็จ";
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("เข้าสู่ระบบสำเร็จ");';
        $alert .= 'window.location.href = ""';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        //echo "ชื่อผู้ใช้เเละรหัสผ่านไม่ถูกต้อง";
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ชื่อผู้ใช้เเละรหัสผ่านไม่ถูกต้อง");';
        $alert .= 'window.location.href = ""';
        $alert .= '</script>';
        echo $alert;
        exit();
    }
}
//print_r($_SESSION);
?>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="" src="upload/custom/favicon2.png" height="200px" width="200px" alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-5">ระบบจัดการสินค้า</h2>
                    <div class="auth-form-container text-start">
                        <form action="" method="post" class="auth-form login-form">
                            <div class="email mb-3">
                                
                                <input name="user" type="text" class="form-control signin-email" placeholder="ชื่อผู้ใช้" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="password mb-3">

                                <input name="pass" type="password" class="form-control signin-password" placeholder="รหัสผ่าน" required="required">
                                <div class="extra mt-3 row justify-content-between">
                                    <!--    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="RememberPassword">
                                            <label class="form-check-label" for="RememberPassword">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <!--//col-6-->
                                    <!--  <div class="col-6">
                                        <div class="forgot-password text-end">
                                            <a href="reset-password.html">Forgot password?</a>
                                        </div>
                                    </div>
                                    <!--//col-6-->
                                </div>
                                <!--//extra-->
                            </div>
                            <!--//form-group-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">เข้าสู่ระบบ</button>
                            </div>
                        </form>

                        <!-- <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup.html">here</a>.</div>-->
                    </div>
                    <!--//auth-form-container-->

                </div>
                <!--//auth-body-->

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                        <small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Narongrit</a> for developers</small>

                    </div>
                </footer>
                <!--//app-auth-footer-->
            </div>
            <!--//flex-column-->
        </div>
        <!--//auth-main-col-->
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder">
            </div>
            <div class="auth-background-mask"></div>
            <div class="auth-background-overlay p-3 p-lg-5">
                <div class="d-flex flex-column align-content-end h-100">
                    <div class="h-100"></div>
                    <!--  <div class="overlay-content p-3 p-lg-4 rounded">
                        <h5 class="mb-3 overlay-title">Explore Portal Admin Template</h5>
                        <div>Portal is a free Bootstrap 5 admin dashboard template. You can download and view the template license <a href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">here</a>.</div>
                    </div>-->
                </div>
            </div>
            <!--//auth-background-overlay-->
        </div>
        <!--//auth-background-col-->

    </div>
    <!--//row-->
