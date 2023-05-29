<?php declare(strict_types=1);

namespace App\Core;

use Doctrine\DBAL\DriverManager;

class Connection
{
    public function __construct(string $tableName)
    {
        $connectionParams = [
            'dbname' => $tableName,
            'user' => 'user',
            'password' => 'codelex',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
        $conn = DriverManager::getConnection($connectionParams);
    }
}