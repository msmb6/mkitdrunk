<?php
$conn = mysqli_connect("localhost", "root", "123321", "mkitdrunk");
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
// echo $hashedPassword;
$sql = "
    INSERT INTO user_info
    (id, pw, date, user_name, wallet_info)
    VALUES('{$_POST['email']}', '{$hashedPassword}', NOW(), '{$_POST['username']}', '{$_POST['address']}')
	";
// echo $sql;
$result = mysqli_query($conn, $sql);

if ($result === false) {
    echo "저장에 문제가 생겼습니다. 관리자에게 문의해주세요.";
    echo mysqli_error($conn);
} else {
?>
    <script>
        alert("회원가입이 완료되었습니다");
        location.href = "../checkout_e.html";
    </script>
<?php
}
?>