
<?php
session_start();
include("functions.php");
ssidChk();

//1. POST受信
$title = $_POST["title"];
$url = $_POST["url"];
$comment = $_POST["comment"];

//2. DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root', '');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//３．SQL作成実行
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, title, url, comment, regist_date)VALUES(NULL, :title, :url, :comment, sysdate())");
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

//４．エラー処理
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
  
}else{
  header("Location: bm_index.php");
  exit;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>課題7</title>
    
    <link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
    
</head>
<body>
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
