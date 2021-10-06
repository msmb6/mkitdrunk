<?php 
  include  $_SERVER['DOCUMENT_ROOT']."/mkitdrunk/php/db.php"; 
  session_start(); 
    $bno = $_GET['id']; /* bno함수에 idx값을 받아와 넣음*/
	  $sql2 = mq("select * from images where id='".$bno."'"); /* 받아온 idx값을 선택 */
	  $board = $sql2->fetch_array();

    $amount = $_POST['useramount'];
    $price = $board['price'] * $amount;
  
    $msql  = "
    INSERT INTO payment (
        seller,
        buyer,
        amount,
        price,
        date,
        selleradd,
        buyeradd
    ) VALUES (
        '{$board['owner']}',
        '{$_SESSION['username']}',
        '{$amount}',
        '{$price}',
        NOW(),
        '{$board['selleradd']}',
        '{$_SESSION['useraddress']}'
    )";

    $usql = "
    UPDATE images SET owner = '{$_SESSION['username']}' WHERE id = '{$bno}'
    ";

    $result = mysqli_query($db, $msql);
    $result2 = mysqli_query($db, $usql);

if(($result === false) | ($result2 === false)){
    echo mysqli_error($db);
}else {
    ?>
        <script>
            alert("구매가 완료되었습니다");
            location.href = "../itemlist.html";
        </script>
    <?php
    }



 ?>