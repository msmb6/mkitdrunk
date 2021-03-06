<?php 
  include  $_SERVER['DOCUMENT_ROOT']."/mkitdrunk/php/db.php"; 
  session_start(); 
?>
<!Doctype html>
<html lang="ko"class="main">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <title>Itemlist</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/itemlist.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> 
    <!-- Bootstrapc JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $(".read_check").click(function(){
                var action_url = $(this).attr("data-action");
                $(location).attr("href",action_url); 
            });
        });
    </script>
</head>

<header>
  <div class="navbar navbar-light shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="../main.html" class="navbar-brand d-flex align-items-center">
        <img src="../images/logo.png" style="width: 7em; position: absolute; left: 0%" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarHeader" style="font-family: nanum;"> 
        <ul class="navbar-nav navbar-dark"> 
          <?php
          if (isset($_SESSION['userId'])) {
              
          ?>
          <li class="nav-item active"> 
            <a class="nav-link" href="../itemlist.html">????????????</a> 
          </li>
          <li class="nav-item active"> 
            <a class="nav-link" href="../upload.html">????????????</a> 
          </li>
          <li class="nav-item active"> 
            <a class="nav-link" href="../mypage_profile.html">???????????????</a> 
          </li>
          <li class="nav-item disabled" onclick="logout()">
              <a class="nav-link">????????????</a>
          </li>
          <?php
          } else {
          ?>
          <li class="nav-item disabled"> 
            <a class="nav-link" href="../login.html">?????????</a> 
          </li>
          <li class="nav-item disabled"> 
            <a class="nav-link" href="../checkout.html">????????????</a> 
          </li>
          <?php
          }
          ?>
        </ul>
    </div>
  </div>
</header>

<body>
  <section class="jumbotron text-center" style="margin-bottom: 0rem">
    <div class="container">
      <h1>???????????? NFT??? ??????????????????!</h1>
      <p class="lead text-muted">????????? NFT??? ?????? ??? ???????????? ?????? ??? ??????????????????! ?????? ??? ????????? NFT??? ??????????????? ??????????????????!</p>
      <p>
        <a href="upload.html" class="btn btn-primary my-2">NFT ????????????</a>
        <a href="pricing.html" class="btn btn-secondary my-2">ZAN ????????????</a>
      </p>
    </div>
  </section>
  <?php 
     $search_con = $_GET['search'];
  ?>

  <div class="album py-5 bg-light">
    
  <div>
    <form class="d-flex p-3 bd-highlight" style="left:0;" method="get" action="./search.php" >
      <input class="form-control me-3" type="search" placeholder="<?php echo $search_con; ?>" aria-label="Search" name="search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>   
  </div>
    
    <div class="container">
      <div class="row">  
        <?php
         

          if(isset($_GET['page'])){
          $page = $_GET['page'];
            }else{
              $page = 1;
            }
          $sql = mq("select * from images where title like '%$search_con%'");
          $row_num = mysqli_num_rows($sql);
          $list = 3; 
          $block_ct = 3; 
          $block_num = ceil($page/$block_ct); 
          $block_start = (($block_num - 1) * $block_ct) + 1; 
          $block_end = $block_start + $block_ct - 1; 
          $total_page = ceil($row_num / $list); 
          if($block_end > $total_page) $block_end = $total_page;
          $total_block = ceil($total_page/$block_ct); 
          $start_num = ($page-1) * $list; 
          $sql2 = mq("select * from images where title like '%$search_con%'  order by id desc limit $start_num, $list");  
          while($board = $sql2->fetch_array()){
            $title=$board["title"]; 
            if(strlen($title)>30)
              { 
               $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }
        ?>    
        <div class="col-md-6">
          <div class="card mb-4 shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="<?php echo $board['imgurl']; ?>" width="100%" height="auto" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title></svg>
            <div class="card-body" >
              <small>owned by <b><?php echo $board['owner']; ?></b> </small>
              <h2 class="card-text text-left"><?php echo $board['title']; ?></h2>
              <small><?php echo $board['hit']; ?> hits</small>
              <br><br>
              <h5 class="card-text text-right"><?php echo $board['price']; ?> ZAN</h5>
              
              
              <div class="card-button">
                <button type="button" style="margin-left: auto;" class="read_check btn btn-sm btn-outline-secondary" data-action="../iteminfo.html?id=<?=$board['id']?>" >???????????????</button>                      
              </div>
            </div>
          </div>
        </div>
        <?php } ?>           
        <div class="num">
        <div id="page_num">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php
                if($page <= 1)
                { 
                  echo "<li class='fo_re'>??????</li>"; 
                }else{
                  echo "<li><a href='?page=1&search=$search_con'>??????</a></li>"; 
                }
                if($page <= 1)
                { 
                  
                }else{
                $pre = $page-1;
                  echo "<li><a href='?page=$pre&search=$search_con'>??????</a></li>"; 
                }
                for($i=$block_start; $i<=$block_end; $i++){ 
                
                  if($page == $i){ 
                    echo "<li class='fo_re'>[$i]</li>"; 
                  }else{
                    echo "<li><a href='?page=$i&search=$search_con'>[$i]</a></li>"; 
                  }
                }
                if($block_num >= $total_block){ 
                }else{
                  $next = $page + 1; 
                  echo "<li><a href='?page=$next&search=$search_con'>??????</a></li>"; 
                }
                if($page >= $total_page){ 
                  echo "<li class='fo_re'>?????????</li>"; 
                }else{
                  echo "<li><a href='?page=$total_page&search=$search_con'>?????????</a></li>"; 
                }
              ?>
            </ul>
          </nav>
       </div>
      </div>
      </div>
    </div>
  </div>
</main>

<script>
  function logout() {
    console.log("hello");
    const data = confirm("???????????? ???????????????????");
    if (data) {
      location.href = "php/logoutProcess.php";
    }
  }
</script>
 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 
</body>
</html>
