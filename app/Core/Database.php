<?php declare(strict_types=1);

namespace App\Core;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class Database
{
    private ?Connection $connection = null;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV["DB_NAME"],
            'user' => $_ENV["DB_USER"],
            'password' => $_ENV["DB_PASSWORD"],
            'host' => $_ENV["DB_HOST"],
            'driver' => $_ENV["DB_DRIVER"],
        ];
        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function getDatabaseConnection(): Connection
    {
        return $this->connection;
    }
}