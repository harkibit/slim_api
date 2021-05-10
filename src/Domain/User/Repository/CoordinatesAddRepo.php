<?php

namespace App\Domain\User\Repository;

use PDO;

/**
 * Repository.
 */
class CoordinatesAddRepo
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function insertCoo(array $coo): int
    {
        $row = [
            'city' => $coo['city'],
            'country' => $coo['country'],
            'longitude' => $coo['longitude'],
            'latitude' => $coo['latitude'],
        ];

        $sql = "INSERT INTO coordinates SET 
                city=:city, 
                country=:country, 
                longitude=:longitude, 
                latitude=:latitude;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}
