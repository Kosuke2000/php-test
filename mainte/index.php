<?php

require "db_conection.php";

// ユーザー入力なし query

// $sql = "select * from contacts where id = 2";
// $stmt = $pdo->query($sql); // ステートメント
// $result = $stmt->fetchAll();

// ユーザー入力あり
$sql = "select * from contacts where id = :id"; // 名前付きプレースホルダ

$result = $stmt->fetchAll();

echo "<pre>";
var_dump($result);
echo "</pre>";

// トランザクション
$pdo->beginTransaction();

try {
    // sql処理
    $stmt = $pdo->prepare($sql); //　プリペアードステートメント
    $stmt->bindValue("id", 1, PDO::PARAM_INT); // 紐付け
    $stmt->execute();

    $pdo->commit();
} catch (PDOException $e) {

    $pdo->rollBack(); // 更新のキャンセル
};
