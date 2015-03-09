<?php

namespace PSchwisow\ContainerCoding\Tests\Entity;

use PSchwisow\ContainerCoding\Entity\Product;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for testSetSku
     *
     * @return array
     */
    public function dataSetSku()
    {
        return [
            [null, false],
            ['', false],
            [1234, false],
            ['AB-CD-12345', true]
        ];
    }

    /**
     * Test the setSku and getSku methods
     *
     * @param string $sku
     * @param boolean $isValid
     * @return void
     * @dataProvider dataSetSku
     */
    public function testSetSku($sku, $isValid)
    {
        $product = new Product();

        if (!$isValid) {
            $this->setExpectedException('DomainException', 'Invalid SKU: ');
        }

        $product->setSku($sku);
        $this->assertEquals($sku, $product->getSku());
    }
}
