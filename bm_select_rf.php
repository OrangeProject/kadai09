<?php

//2. DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root', '');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．SQL作成実行
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY id DESC");
$status = $stmt->execute();


//４．エラー処理
$view = "";
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
  
}else{
    
  while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view .= '<p>';
      $view .= '<a href="bm_detail_rf.php?id='.$r["id"].'">';
      $view .= $r["title"]. " " .$r["url"];
      $view .= '</a>';
      $view .= '</p>';
  }
    
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>書籍</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand">一覧表示画面</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<p><a href="login.php">ログイン画面へ戻る</a></p>
<!-- Main[End] -->
<div id="footer-outer"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<?php
    if($_SESSION["kanri_flg"] == 1){
    echo '<script>$("#footer-outer").load("./footer.html #footer-inner");</script>';
    }else{
    echo '<script>$("#footer-outer").load("./footer_rf.html #footer-inner");</script>';
    }
?>
</body>
</html>
