<?php
//admin: thêm sp
    function themsp($name,$img,$danhmuc,$price,$sale,$description){
        $conn=connect();
        $sql = "INSERT INTO sanpham (name,img,id_danhmuc, price, sale,mo_ta)
                VALUES ('".$name."','".$img."','".$danhmuc."', '".$price."',  '".$sale."','".$description."')";
        $conn->exec($sql);
    }
//Xóa sản phẩm admin
function xoasp($iddel){
    $sql = "DELETE FROM sanpham WHERE id= ".$iddel ;
    $conn=connect();
    $conn->exec($sql);
}

function capnhat($id,$name,$img,$danhmuc,$price,$sale,$description) {
    $sql = "UPDATE sanpham SET name='$name', id_danhmuc='$danhmuc', price='$price', sale='$sale', mo_ta='$description'";
    if($img!='')
        $sql.=", img='$img'";
    $sql.= " WHERE id=".$id;
    $conn=connect();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

//Show sản phẩm chi tiết
function showsp_detail($id) {
    $sql="select * from sanpham where 1";
    // $sql="select sp.*, dm.name as 'dm_name' from sanpham sp inner join danhmuc dm on sp.id_danhmuc = dm.id where 1";
    if($id>0) $sql.=" AND id=" .$id;
    $conn=connect();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch(); //lấy ra 1 mảng
}

//show tất cả sản phẩm
function showsp($idcat) {

    $sql="select sp.*, dm.name as 'dm_name' from sanpham sp inner join danhmuc dm on sp.id_danhmuc = dm.id where 1";
    if($idcat>0){
        $sql.=" AND id_danhmuc=".$idcat;
    }
    $sql.=" order by id desc";
    $conn=connect();
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}


function showdssp_view(){
    $sql="select * from sanpham order by view desc";
    $conn=connect();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

?>