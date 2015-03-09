<?php

namespace PSchwisow\ContainerCoding\Model;

use Doctrine\DBAL\Connection;

abstract class AbstractModel
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * Table to use
     *
     * @var string
     */
    protected $tableName;

    /**
     * Constructor
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert new record
     *
     * @param array $data
     * @return integer
     */
    public function insert($data)
    {
        return $this->connection->insert($this->tableName, $data);
    }

    /**
     * Update table record
     *
     * @param array $data
     * @param array $where
     * @return integer
     */
    public function update($data, $where)
    {
        return $this->connection->update($this->tableName, $data, $where);
    }
}
