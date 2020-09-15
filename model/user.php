<?php
    function checkuser($user,$pass){
        $sql="select * from user where user='".$user."' and pass='".$pass."'";
        $conn=connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    function add_taikhoan($email,$user,$pass){
        $sql="insert into user(email,user,pass) values ('$email','$user','$pass')";
        $conn=connect();
        $conn->exec($sql);
    }
?>