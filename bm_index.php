<?php
session_start();
include("functions.php");
ssidChk();
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
    <div class="navbar-header"><a class="navbar-brand" href="bm_select.php">書籍</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<form method="post" action="bm_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍登録</legend>
     <label>タイトル：<input type="text" name="title"></label><br>
     <label>url：<input type="text" name="url"></label><br>
     <label>コメント<textArea name="comment" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
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
