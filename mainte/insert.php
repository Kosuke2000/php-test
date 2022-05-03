<?php


function insertContact($request)
{

    // DB接続 PDO
    require "db_conection.php";

    // 入力 DB保存, prepare->execute

    $parames = [
        'id' => null,
        'your_name' => $request["your_name"],
        'email' => $request["email"],
        "url" => $request["url"],
        "gender" => $request["gender"],
        'age' => $request["age"],
        "contact" => $request["contact"],
        "created_at" => null
    ];
    // $parames = [
    //     'id' => null,
    //     'your_name' => "お名前123",
    //     'email' => "bar@bar.com",
    //     "url" => "http://bar.com",
    //     "gender" => "1",
    //     'age' => "3",
    //     "contact" => "barbar",
    //     "created_at" => null
    // ];

    $count = 0;
    $columns = "";
    $values = "";


    foreach (array_keys($parames) as $key) {
        if ($count++ > 0) {
            $columns .= ",";
            $values .= ",";
        }

        $columns .= $key;
        $values .= ":" . $key;
    }

    $sql = "insert into contacts( $columns )values($values)"; // 名前付きプレースホルダ

    var_dump($sql);

    $stmt = $pdo->prepare($sql); //　プリペアードステートメント
    $stmt->execute($parames);
}
