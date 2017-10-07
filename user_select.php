<?php

//2. DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root', '');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．SQL作成実行
$stmt = $pdo->prepare("SELECT * FROM gs_user_table ORDER BY id DESC");
$status = $stmt->execute();


//４．エラー処理
$view = "";
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
  
}else{
    
  while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view .= '<p>';
      $view .= '<a href="user_update_view.php?id='.$r["id"].'">';
      $view .= $r["name"]. " " .$r["lid"];
      $view .= '</a>';
      $view .= '<a href="user_delete.php?id='.$r["id"].'">';
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
<title>ユーザ一覧</title>
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
      <a class="navbar-brand" href="user_index.php">ユーザ登録</a>
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

</body>
</html>
