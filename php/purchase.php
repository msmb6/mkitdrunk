<?php 
  include  $_SERVER['DOCUMENT_ROOT']."/mkitdrunk/php/db.php"; 
  session_start(); 
    $amount = $_POST['useramount'];
	
    $bno = $_GET['id']; /* bno함수에 idx값을 받아와 넣음*/
	$sql2 = mq("select * from images where id='".$bno."'"); /* 받아온 idx값을 선택 */
	$board = $sql2->fetch_array();
    
    
    echo $amount;
    echo $board['title'];
    echo $board['owner'];
    echo $_SESSION['username'];

 ?>