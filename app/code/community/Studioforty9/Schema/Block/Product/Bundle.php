<?php

/**
 * Bundle Product
 *
 * Class Studioforty9_Schema_Block_Product_Bundle
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Product_Bundle extends Studioforty9_Schema_Block_Product
{
    /**
     * The lowest price available for the bundle product
     *
     * @return float
     */
    public function getLowestPrice()
    {
        $price = Mage::getModel('bundle/product_price')->getTotalPrices($this->getProduct(), 'min', 1);
        return $this->formatPrice($price);
    }

    /**
     * The highest price available for the bundle product
     *
     * @return float
     */
    public function getHighestPrice()
    {
        $price = Mage::getModel('bundle/product_price')->getTotalPrices($this->getProduct(), 'max', 1);
        return $this->formatPrice($price);
    }
}
