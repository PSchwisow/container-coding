<?php

namespace PSchwisow\ContainerCoding\Model;

class Brand extends AbstractModel
{
    /**
     * Table to use
     *
     * @var string
     */
    protected $tableName = 'brand';

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

    /**
     * Get array of options for brand select element
     *
     * @return array
     */
    public function getBrandOptions()
    {
        $data = $this->connection->fetchAll("SELECT * FROM $this->tableName");
        $out = array();
        foreach ($data as $row) {
            $out[$row['brand_id']] = $row['name'];
        }
        return $out;
    }
}
