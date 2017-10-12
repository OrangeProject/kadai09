
<?php
session_start();
include("functions.php");
ssidChk();
//1. POST受信
$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri"];

//2. DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root', '');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//３．SQL作成実行
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg)VALUES(NULL, :name, :lid, :lpw, :kanri_flg, 0)");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_STR);
$status = $stmt->execute();

//４．エラー処理
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
  
}else{
  header("Location: user_select.php");
  exit;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User登録画面</title>
    
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
