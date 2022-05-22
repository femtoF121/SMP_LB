<?php

function openConnection(): PDO
{
    $dbName = $_SERVER['DOCUMENT_ROOT'] . '/db/cookdise.db';
    $pdo = new PDO("sqlite:$dbName");
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

function Sql_transaction($sqls, $params = []): bool
{
    $pdo = openConnection();
    try {
        $pdo->beginTransaction();

        $i = 0;
        foreach ($sqls as $sql) {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params[$i]);
            $i++;
        }

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "\nОшибка: " . $e->getMessage();
        return false;
    } finally {
        $pdo = null;
    }
}