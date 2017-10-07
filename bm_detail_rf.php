<?php
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"];  

//2.DB接続など
$pdo = db_con();

//３．データ取得
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id);
$status = $stmt->execute();

//４．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $row = $stmt->fetch(); //$row["name"]
}


//４.　データ表示

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
//$stmt = $pdo->prepare("UPDATE gs_bm_table SET title=:title,url=:url,comment=:comment WHERE id=:id");
//$stmt->bindValue(':title', $title);
//$stmt->bindValue(':url', $url);
//$stmt->bindValue(':comment', $comment);
//$stmt->bindValue(':id', $id);
//$status = $stmt->execute();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand"    >詳細画面</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
  <div class="jumbotron">
   <fieldset>
    <legend>書籍</legend>
     <label>タイトル：<?=$row["title"]?></label><br>
     <label>URL：<?=$row["url"]?></label><br>
    <label>コメント：<?=$row["comment"]?></label><br>
     <input type="hidden" name="id" value="<?=$id?>">
    </fieldset>
  </div>
  <p><a href="bm_select_rf.php">戻る</a></p>
<!-- Main[End] -->


</body>
</html>
