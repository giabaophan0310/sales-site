<?php
    session_start();
    ob_start();
    include "../model/connect.php";
    include_once "../model/danhmuc.php";
    include_once "../model/sanpham.php";
     include "../global.php";
    //kiểm tra có phải admin hay không ?
        
    //load trang chủ
    $dsdm = dsdm();
    //$dssphot = showhot();
        //lấy dữ liệu cho trang chủ
    if(isset($_SESSION['sid'])&&($_SESSION['sid'])>0)
    {
        if($_SESSION['srole'] == 0)
             header('location: index.php');
        include_once "../view/admin/header.php";
        if(isset($_GET['act'])) {
            $act=$_GET['act'];
            switch ($act) {
                case 'qlsp':
                    //add dữ liệu
                    if(isset($_POST['them'])&&($_POST['them'])){
                        //lấy dữ liệu trên form
                        $check_null = true;
                        if(!empty($_POST['name']))
                            $name=$_POST['name'];
                        else $check_null = false;
                        $price=$_POST['price'];
                        $danhmuc=$_POST['danhmuc'];
                        $sale=$_POST['sale'];
                        $description=$_POST['description'];
                        $img=$_FILES['img']['name'];
                        $target_file = $imgpath . basename($img);
                        if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
                            $error_upload="Upload thành công";

                        }else {
                            $error_upload="";
                            $check_null = false;
                        }
                        if($check_null == true)
                            themsp($name,$img,$danhmuc,$price,$sale,$description);
                        else 
                            echo
                            '<script> alert("Lỗi: Kiểm tra lại dữ liệu nhập vào giùm!"); </script>';
                    }

                    //edit dữ liệu  
                    if(isset($_GET['idedit'])&&($_GET['idedit']>0)){
                        $pro=showsp_detail($_GET['idedit']);
                    }
                    if(isset($_POST['capnhat'])&&($_POST['capnhat'])){
                        $id=$_POST['id'];
                        $check_null = true;
                        if(!empty($_POST['name']))
                            $name=$_POST['name'];
                        else $check_null = false;
                        $price=$_POST['price'];
                        $danhmuc=$_POST['danhmuc'];
                        $sale=$_POST['sale'];
                        $description=$_POST['description'];
                        if($_FILES['img']['name']!='')
                        {
                            $img=$_FILES['img']['name'];
                            $target_file = $imgpath . basename($img);
                            if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
                                $error_upload="Upload thành công";

                            }else {
                                $error_upload="";
                                $check_null = false;
                            }
                        }else {
                            $img = '';
                        }
                        if($check_null == true)
                            capnhat($id,$name,$img,$danhmuc,$price,$sale,$description);
                        else 
                            echo
                            '<script> alert("Lỗi: Kiểm tra lại dữ liệu nhập vào giùm!"); </script>';
                    }
                    //delete dữ liệu
                    if(isset($_GET['iddel'])&&($_GET['iddel'])>0)
                        xoasp($_GET['iddel']);
                    //show dữ liệu
                    $dssp = showsp(0);
                    include_once "../view/admin/qlsp.php";
                    break;
                    //thoát
                    case'logout':
                        unset($_SESSION['suser']);
                        unset($_SESSION['sid']);
                        header('location: admin.php');
                    break;
                    case 'user':
                        //đăng ký
        
                        //đăng nhập
                        
                        //thoát
                        if(isset($_GET['logout'])&&($_GET['logout'])==1){
                            unset($_SESSION['sid']);
                            unset($_SESSION['name']);
                            header('location: login.php');
                        }
                        include "../view/index.php";
                        break;
                default:
                    include_once "../view/admin/home.php";
                    break;
            }
        }

        //include_once "../view/admin/qlsp.php";

        include_once "../view/admin/footer.php";

    }else{
        header('location: login.php');
    }   
?>