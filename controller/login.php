<?php
    session_start();
    include "../model/user.php";
    include "../model/connect.php";
    //đăng nhập
    if(isset($_POST['login'])&&($_POST['login'])){
        $user=$_POST['user'];
        $pass=$_POST['pass'];

        $checkuser=checkuser($user,$pass);
        if(is_array($checkuser)) {
            $_SESSION['sid']=$checkuser['id'];
            $_SESSION['suser']=$checkuser['user'];
            $_SESSION['srole']=$checkuser['role'];
            if($_SESSION['srole']==1) 
                header('location: admin.php');
            else header('location: index.php');
        }else {
            $canhbao="<h2 style='color:red'>Vô hộ!</h2>";
        }
    }
    //đăng kí
    if(isset($_POST['signin'])&&($_POST['signin'])){
        $email=$_POST['email'];
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        if(!empty($user) && !empty($pass)) {
            //Thêm Tài Khoản
            add_taikhoan($email,$user,$pass);

            
            $checkuser=checkuser($user,$pass);
            if(is_array($checkuser)) {
                $_SESSION['sid']=$checkuser['id'];
                $_SESSION['suser']=$checkuser['user'];
                $_SESSION['srole']=$checkuser['role'];
            }
            if($_SESSION['srole']==1) 
                header('location: admin.php');
            else header('location: index.php');
        }else {
            $canhbao="<h2 style='color:red'>Nhập đủ hộ!</h2>";
        }
    }

    $signin = false;
    if(isset($_GET['signin'])&& $_GET['signin']==1)
        $signin = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../view/css/login.css">
    <title>Login</title>
</head>
    <header>
        <div class="row">
            <div class="logo">
                <a href="index.php"><img src="../view/img/logo.png" alt=""></a>
            </div>
        </div>
    </header>

<body>
    <?php
        $post = $input_email = $submit_name = $submit_value = $now = $intro = '';
        if($signin == true ){
            $post = 'login.php?act=user&signin=1';
            $input_email = '<input type="text" name="email" id="" placeholder="Địa chỉ Email"><br>';
            $submit_name = 'signin';
            $submit_value = 'Đăng ký';
            $intro = 'Đã là thành viên?';
            $now = 'Đăng nhập ngay!';
            $post_2 = 'login.php';
        }else {
            $post = 'login.php';
            $submit_name = 'login';
            $submit_value = 'Đăng nhập';
            $intro = 'Chưa phải thành viên?';
            $now = 'Đăng ký ngay!';
            $post_2 = 'login.php?act=user&signin=1';
        }
    ?>
    <div class="row">
        <div class="login_input_area">
                <div class="title_khachhang">
                    <?= $submit_value ?>
                </div>
                <div class="link_login">
                    <div class="link_login_son">
                        <a href="" title="Đăng nhập bằng Facebook" class="provide_fb">
                        <i class="fa fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
                <div class="hoac_la">
                    Hoặc
                    là 
                </div>
            <form action="<?= $post ?>" method="post">
            <?= $input_email ?>
            <input type="text" name="user" id="" required placeholder="User"><br>
            <input type="password" name="pass" id="" placeholder="Mật khẩu"><br>
            <input type="submit" value="<?= $submit_value ?>" required name="<?= $submit_name ?>">
            </form>
            <div class="boxcenter">
                <div class="forget_pass_area">
                    <a href="">Quên mật khẩu?</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="boxcenter_signin">
            <a href=<?= $post_2 ?>><?= $intro ?> <span><?= $now?></span></a>
        </div>
    </div>

    <?php
        if(isset($canhbao)&&($canhbao!=""))
        echo $canhbao; 
    ?>
</body>
</html>