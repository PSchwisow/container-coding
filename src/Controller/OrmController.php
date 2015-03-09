<?php
namespace PSchwisow\ContainerCoding\Controller;

use PSchwisow\ContainerCoding\Service\OrmServiceLayer;

class OrmController extends BaseController
{
    public function addProductForm()
    {
        $service = new OrmServiceLayer($this->app->entityManager);
        $this->app->render(
            'orm.twig',
            [
                'brand_options' => $service->getBrandOptions()
            ]
        );
    }

    public function addProductSubmit()
    {
        $service = new OrmServiceLayer($this->app);
        try {
            $productId = $service->insertProduct($this->request->post());
            $message = 'Record saved';
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
        }

        $this->app->render(
            'orm.twig',
            [
                'brand_options' => $service->getBrandOptions(),
                'message' => $message
            ]
        );
    }
}
