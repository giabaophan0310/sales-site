<?php

    function dsdm() {
        $conn = connect();
        $sql = "select * from danhmuc order by sort desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    function dsdm_1() {
        $conn = connect();
        $sql = "select * from danhmuc_1 order by sort desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    // function dsdm2() {
    //     $conn = connect();
    //     $sql = "select * from danhmuc where hot=1 order by sort desc";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute();
    //     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     return $stmt->fetchAll();
    // }

    function getnamecata($id){
        $sql="select * from danhmuc where id=".$id;
        $conn = connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }
?>