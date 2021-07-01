<?php
//関数
function connect_to_db()
//データベースと接続する内容
{
    $dbn = 'mysql:dbname=gsacf_d08_11;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}
