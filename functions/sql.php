<?php

function openConnection(): PDO
{
    $pdo = new PDO('mysql:host=localhost;dbname=pz3_gallery','root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

function Sql_exec($sql, $params = []): array
{
    $pdo = openConnection();

    $res = $pdo->prepare($sql);
    $res->execute($params);

    $ret = [];
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $ret[] = $row;
    }

    $pdo = null;
    return $ret;
}

function Sql_transaction($sqls, $params = []) {
    $pdo = openConnection();
    try {

        $pdo->beginTransaction();

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Ошибка: " . $e->getMessage();
    } finally {
        $pdo = null;
    }
}