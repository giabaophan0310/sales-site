<?php

function thembl($name,$iduser,$idsp,$noidung){
    
    $sql = "INSERT INTO comment (name,iduser,idsp, noidung)
            VALUES ('$name','$iduser','$idsp', '$noidung')";
    $conn=connect();
    $conn->exec($sql);
}


function showbl() {
    $sql="select * from comment order by id desc";
    $conn=connect();
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

?>