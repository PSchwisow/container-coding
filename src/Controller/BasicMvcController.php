<?php
namespace PSchwisow\ContainerCoding\Controller;

use PSchwisow\ContainerCoding\Model\Brand;
use PSchwisow\ContainerCoding\Model\Product;

class BasicMvcController extends BaseController
{
    public function addProductForm()
    {
        $brandModel = new Brand($this->app->connection);
        $this->app->render(
            'basic-mvc.twig',
            [
                'brand_options' => $brandModel->getBrandOptions()
            ]
        );
    }

    public function addProductSubmit()
    {
        $productModel = new Product($this->app->connection);
        $brandModel = new Brand($this->app->connection);
        $brandOptions = $brandModel->getBrandOptions();

        // data validation
        $data = $this->request->post();
        $errors = [];
        if (empty($data['name'])) {
            $errors[] = 'Name cannot be empty';
        }
        if (empty($data['sku'])) {
            $errors[] = 'SKU cannot be empty';
        }
        if (!array_key_exists($data['brand_id'], $brandOptions)) {
            $errors[] = 'Invalid brand selected';
        }

        if (empty($errors)) {
            $productId = $productModel->insert($data);
            if ($productId > 0) {
                $message = 'Record saved';
            } else {
                $message = 'Error saving record';
            }
        } else {
            $message = 'Data submitted was invalid';
        }

        $this->app->render(
            'basic-mvc.twig',
            [
                'brand_options' => $brandOptions,
                'message' => $message,
                'errors' => $errors
            ]
        );
    }
}
