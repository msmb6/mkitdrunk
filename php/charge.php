<?php
    $conn = mysqli_connect("localhost", "root", "123321", "mkitdrunk");
    mysqli_query($conn, "set session character_set_connection=utf8;");
    mysqli_query($conn, "set session character_set_results=utf8;");
    mysqli_query($conn, "set session character_set_client=utf8;"); 
    session_start();
    $sql  = "
    INSERT INTO charge (
        chargeaddress,
        chargeamount,
        username,
        idno,
        date
        
        
    ) VALUES (
        '{$_SESSION['useraddress']}',
        '{$_POST['chargeamount']}',
        '{$_SESSION['username']}',
        '{$_SESSION['userId']}',
        NOW()
        
       
    )";
$result = mysqli_query($conn, $sql);
if($result === false){
    echo mysqli_error($conn);
}else {
    ?>
        <script>
            alert("충전이 완료되었습니다");
            location.href = "../mypage_wallet.html";
        </script>
    <?php
    }

    echo $_POST['chargeamount'];
    

?>