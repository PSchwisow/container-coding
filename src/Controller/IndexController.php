<?php
namespace PSchwisow\ContainerCoding\Controller;


class IndexController extends BaseController
{
    public function index()
    {
        $this->app->render('index.twig');
    }
}
