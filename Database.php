<?php

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dns = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dns, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function fetch() {
        return $this->statement->fetch();
    }

    public function fetchOrAbort()
    {
        $result = $this->fetch();

        if (! $result) {
            abort(Response::NOT_FOUND);
        }

        return $result;
    }

    public function fetchAll() {
        return $this->statement->fetchAll();
    }
}