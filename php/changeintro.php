<?php 
  include  $_SERVER['DOCUMENT_ROOT']."/mkitdrunk/php/db.php"; 
  session_start(); 
    
    $id = $_SESSION['userId'];
    
    $introduction = $_POST["newintro"];
    $introduction = str_replace("\n","<br>", $introduction);

    $sql = "
    UPDATE user_info SET 
    
    user_name = '{$_POST['newname']}',
    introduction = '{$introduction}'
    
    WHERE id = $id
    ";

    $result = mysqli_query($db, $sql);

    $_SESSION['username'] = $_POST['newname'];
    $_SESSION['userintro'] = $introduction;
    if($result === false) {
        echo mysqli_error($db);
    }else {
        ?>
            <script>
                alert("변경이 완료되었습니다");
                location.href = "../mypage_profile.html";
            </script>
        <?php
        }
    


 ?>