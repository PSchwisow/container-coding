<?php

namespace PSchwisow\ContainerCoding\Controller;

use PSchwisow\ContainerCoding\Service\ServiceLayer;

class ServiceLayerController extends BaseController
{
    public function addProductForm()
    {
        $service = new ServiceLayer($this->app);
        $this->app->render(
            'service-layer.twig',
            [
                'brand_options' => $service->getBrandOptions()
            ]
        );
    }

    public function addProductSubmit()
    {
        $service = new ServiceLayer($this->app);
        try {
            $productId = $service->insertProduct($this->request->post());
            $message = 'Record saved';
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
        }

        $this->app->render(
            'service-layer.twig',
            [
                'brand_options' => $service->getBrandOptions(),
                'message' => $message
            ]
        );
    }
}
