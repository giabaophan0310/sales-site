<?php
    session_start();
    include '../model/connect.php';
    include '../model/binhluan.php';
    if(isset($_SESSION['sid'])&&($_SESSION['sid'])>0){
            if((isset($_SESSION['suser'])) && $_SESSION['suser']!=''){
                $user= $_SESSION['suser'];
            }else {
                $user="";
            }

            if(isset($_POST['guibinhluan'])&&($_POST['guibinhluan'])){
                
                $name = $_POST['name'];
                $noidung = $_POST['noidung'];
                $idsp = $_POST['idsp'];
                $iduser = $_SESSION['sid'];

                thembl($name,$iduser,$idsp,$noidung);
            }

            $dsbl=showbl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <hr>
        <form action="binhluan.php" method="POST">
            <input type="hidden" name="idsp"value="<?= $idsp?>">
            <input type="text" name="name" id="" value="<?= $user?>">
            <textarea name="noidung" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="Gửi bình luận" name="guibinhluan">
        </form>
    <hr>

            <?php
                foreach($dsbl as $bl) {
                    echo $bl['name'].' - '.$bl['noidung']."<br>";
                }
            ?>
</body>
</html>
<?php
    }else{
        echo "<a href='login.php' target='_parent'>Bạn vui lòng đăng nhập!</a>;";

    }
?>