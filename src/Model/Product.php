<?php

namespace PSchwisow\ContainerCoding\Model;

class Product extends AbstractModel
{
    /**
     * Table to use
     *
     * @var string
     */
    protected $tableName = 'product';

    /**
     * Insert new record
     *
     * @param array $data
     * @return integer
     */
    public function insert($data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return parent::insert($data);
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
        $data['updated_at'] = date('Y-m-d H:i:s');
        return parent::update($data, $where);
    }
}
