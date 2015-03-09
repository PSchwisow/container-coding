<?php

namespace PSchwisow\ContainerCoding\Service;

use PSchwisow\ContainerCoding\Model\Brand;
use PSchwisow\ContainerCoding\Model\Product;
use Slim\Slim;

class ServiceLayer
{
    /**
     * @var Slim
     */
    protected $app;

    /**
     * @var Brand
     */
    protected $brandModel;

    /**
     * @var Product
     */
    protected $productModel;

    public function __construct(Slim $app)
    {
        $this->app = $app;
        $this->brandModel = new Brand($app->connection);
        $this->productModel = new Product($app->connection);
    }

    /**
     * Get array of options for brand select element
     *
     * @return array
     */
    public function getBrandOptions()
    {
        return $this->brandModel->getBrandOptions();
    }

    /**
     * Insert a new product
     *
     * @param array $data
     * @return integer
     * @throws \DomainException if validation fails
     * @throws \RuntimeException for database failures
     */
    public function insertProduct($data)
    {
        // data validation
        $errors = [];
        if (empty($data['name'])) {
            $errors[] = 'Name cannot be empty';
        }
        if (empty($data['sku'])) {
            $errors[] = 'SKU cannot be empty';
        }
        if (!array_key_exists($data['brand_id'], $this->getBrandOptions())) {
            $errors[] = 'Invalid brand selected';
        }
        if (!empty($errors)) {
            throw new \DomainException('Data submitted was invalid: ' . implode(', ', $errors));
        }

        $productId = $this->productModel->insert($data);
        if ($productId > 0) {
            return $productId;
        } else {
            throw new \RuntimeException('Error saving product');
        }
    }
}
