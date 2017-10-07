<?php
session_start();
include("functions.php");
ssidChk();

//2. DB接続
$pdo = db_con();

//３．SQL作成実行
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY id DESC");
$status = $stmt->execute();


//４．エラー処理
$view = "";
if($status==false){
  queryError($stmt);
}else{
    
  while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view .= '<p>';
      $view .= '<a href="bm_update_view.php?id='.$r["id"].'">';
      $view .= $r["title"]. " " .$r["url"];
      $view .= '</a>';
      $view .= '<a href="bm_delete.php?id='.$r["id"].'">';
      $view .= '[削除]';
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
      <a class="navbar-brand" href="bm_index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->
<div id="footer-outer"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
        $("#footer-outer").load("./footer.html #footer-inner");
</script>
</body>
</html>
