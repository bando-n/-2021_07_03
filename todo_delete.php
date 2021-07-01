<?php
// var_dump($_GET);
// exit();
// idをgetで受け取る
// 関数ファイル読み込み
include("functions.php");
// 送信されたidをgetで受け取る

$pdo = connect_to_db();
$id = $_GET['id'];
// idを指定して更新するSQLを作成 -> 実行の処理
$sql = 'DELETE FROM todo_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

header('Location:todo_read.php');
