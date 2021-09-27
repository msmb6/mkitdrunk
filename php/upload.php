<?php


$target_dir = "../../uploads/";
$target_file = $target_dir . basename($_FILES["fileSelector"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
session_start();

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileSelector"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileSelector"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileSelector"]["tmp_name"], $target_file)) {
		/*database에 업로드 정보를 기록하자.
		- 파일이름(혹은 url)
		- 파일사이즈
		- 파일형식
		*/
		$filename = $_FILES["fileSelector"]["name"];
		$imgurl = "http://localhost/uploads/". $_FILES["fileSelector"]["name"];
		$size = $_FILES["fileSelector"]["size"];

        $title = $_POST["title"];
        $price = $_POST["price"];
        $amount = $_POST["amount"];

        $firstowner = $_SESSION['username'];
        $owner = $_SESSION['username'];

        $link = $_POST["link"];
        $exposition = $_POST["exposition"];
        $exposition = nl2br(addslashes($exposition));
        $exposition = str_replace("\n","<br/>", $exposition);

		
		$conn = mysqli_connect("localhost", "root", "123321", "mkitdrunk");
        mysqli_query($conn, "set session character_set_connection=utf8;");
        mysqli_query($conn, "set session character_set_results=utf8;");
        mysqli_query($conn, "set session character_set_client=utf8;");
        
		//images 테이블에 이미지정보를 저장하자.
		$sql = "insert into images(filename, imgurl, size, date, title, price, amount, first_owner, owner, link,  exposition) 
        values('$filename','$imgurl','$size', NOW(), '$title', '$price', '$amount' , '$firstowner', '$owner', '$link', '$exposition')";

		mysqli_query($conn,$sql);
		mysqli_close($conn);
        ?>

    <script>
        alert("등록이 완료되었습니다.");
        location.href = "../upload_e.html";
    </script>

    <?php
        echo "<p>The file ". basename( $_FILES["fileSelector"]["name"]). " has been uploaded.</p>";
		echo "<br><img src=/uploads/". basename( $_FILES["fileSelector"]["name"]). " width=400>";
		echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
    } else {
        echo "<p>Sorry, there was an error uploading your file.</p>";
		echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
    }
}
?>