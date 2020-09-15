<?php
    include "../model/connect.php";
    include_once "../model/danhmuc.php";
    include_once "../model/sanpham.php";
    include "../model/user.php";
    include "../global.php";
    session_start();
    //load trang chủ
    connect();
    //connect();
    $dsdm = dsdm();
    $dsdm_1 = dsdm_1();
    // $dsdm2 = dsdm2();
    //$dssphot = showhot();

    include_once "../view/header.php";
    if(isset($_GET['act'])) {
        $act=$_GET['act'];

        switch ($act) {
            case 'nhanvan':
                $dssp = showsp($iddm);
                include_once "../view/nhanvan.php";
                break;

            case 'product':
                if(isset($_GET['idcat'])&&($_GET['idcat']>0)){
                    $iddm=$_GET['idcat'];
                    $catalogname=getnamecata($iddm);
                }else{
                    $iddm=0;
                    $catalogname ="";
                }
                $dssp=showsp($iddm);
                

                include_once "../view/product.php";
                break;

            case 'productDetail':
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    $pro=showsp_detail($_GET['id']);
                }
                include "../view/productDetail.php";
                break;

            case 'user':

                if(isset($_SESSION['sid'])&&($_SESSION['sid'])>0){
                    //thoát
                    if(isset($_GET['logout'])&&($_GET['logout'])==1){
                        unset($_SESSION['sid']);
                        unset($_SESSION['name']);
                        header('location: index.php');
                    }
                }else {
                    header('location: login.php');
                }

                break;
            
            default:
                include_once "../view/home.php";
                break;
        }
    }
else {
    include_once "../view/home.php";
}
    include_once "../view/footer.php";


?>