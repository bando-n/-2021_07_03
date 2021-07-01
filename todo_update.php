<?php
// 各値をpostで受け取る
$id = $_POST['id'];
$todo = $_POST['todo'];
$deadline = $_POST['deadline'];


include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();

// idを指定して更新するSQLを作成(UPDATE文)
$sql = "UPDATE todo_table SET todo=:todo, deadline=:deadline,
updated_at=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
// 各値をpostで受け取る
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し,以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常に実行された場合は一覧ページファイルに移動し,処理を実行する
    header("Location:todo_read.php");
    exit();
}
