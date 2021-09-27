<?php
$conn = mysqli_connect("localhost", "root", "123321", "mkitdrunk");
//아이디 비교와 비밀번호 비교가 필요한 시점이다.
// 1차로 DB에서 비밀번호를 가져온다 
// 평문의 비밀번호와 암호화된 비밀번호를 비교해서 검증한다.
$email = $_POST['email'];
$password = $_POST['password'];

// DB 정보 가져오기 
$sql = "SELECT * FROM user_info WHERE id ='{$email}'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);
$hashedPassword = $row['pw'];
$row['no.'];
$row['user_name'];
$row['wallet_info'];

foreach($row as $key => $r){
    echo "{$key} : {$r} <br>";
}
// echo $row['no.'];
// DB 정보를 가져왔으니 
// 비밀번호 검증 로직을 실행하면 된다.
$passwordResult = password_verify($password, $hashedPassword);
if ($passwordResult === true) {
    // 로그인 성공
    // 세션에 id 저장
    session_start();
    $_SESSION['userId'] = $row['no.'];
    $_SESSION['username'] = $row['user_name'];
    $_SESSION['useraddress'] = $row['wallet_info'];
   // print_r($_SESSION);
   // echo $_SESSION['userId'];
    
?>
    <script>
        alert("로그인에 성공하였습니다.")
        location.href = "../main.html";
    </script>
<?php
} else {
    // 로그인 실패 
?>
    <script>
        alert("로그인에 실패하였습니다");
        history.back();
    </script>
<?php
}
?>