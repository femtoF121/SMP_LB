<?php

class DB
{
    private string $dbName = "db/cookdise.db";
    private PDO $pdo;

    public function openConnection(): PDO
    {
        $pdo = new PDO("sqlite:$this->dbName");
        $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);

        $this->pdo = $pdo;

        return $this->pdo;
    }

    public function closeConnection()
    {
        if ($this->pdo != "") {
            unset($this->pdo);
        }
    }

    public function execute($query, $params = [])
    {
        if ($query) {
            try {
                $stmt = $this->pdo->prepare($query);
                $stmt->execute($params);

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $exception) {
                return $exception->errorInfo;
            }
        }
        return null;
    }

    public function getTable($tableName)
    {
        try {
            $stmt = $this->pdo->query('SELECT * FROM '.$tableName);
            if($stmt) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return [];
        } catch (PDOException $exception) {
            return $exception->errorInfo;
        }
    }
}