<?php
session_start();
include("functions.php");
ssidChk();
//1.POSTでParamを取得
$id = $_POST["id"];
$title = $_POST["title"];
$url = $_POST["url"];
$comment = $_POST["comment"];

//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root', '');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE gs_bm_table SET title=:title,url=:url,comment=:comment WHERE id=:id");
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

header("Location: bm_select.php");
<div id="footer-outer"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<?php
    if($_SESSION["kanri_flg"] == 1){
    echo '<script>$("#footer-outer").load("./footer.html #footer-inner");</script>';
    }else{
    echo '<script>$("#footer-outer").load("./footer_rf.html #footer-inner");</script>';
    }
?>
?>
