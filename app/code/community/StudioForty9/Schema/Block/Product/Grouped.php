<?php

/**
 * Grouped Product
 *
 * Class StudioForty9_Schema_Block_Product_Grouped
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class StudioForty9_Schema_Block_Product_Grouped
    extends StudioForty9_Schema_Block_Product
{
    /**
     * Get Associated Products
     *
     * @return false|array
     */
    public function getAssociatedProduct()
    {
        if (!$this->getData('associated_products')) {
            $_products = $this->getProduct()->getTypeInstance(true)
                ->getAssociatedProducts($this->getProduct());

            $this->setAssociatedProducts($_products);
        }
        return $this->getData('associated_products');
    }

    /**
     * This gets the lowest price
     *
     * @return float|string
     */
    public function getLowestPrice()
    {
        $_lowestPrice = '0.00';
        foreach ($this->getAssociatedProduct() as $_item) {
            $_price = $this->getPrice($_item);
            if ($_lowestPrice == '0.00' || $_lowestPrice > $_price) {
                $_lowestPrice = $_price;
            }
        }

        return $_lowestPrice;
    }

    /**
     * This gets the highest price
     *
     * @return float|string
     */
    public function getHighestPrice()
    {
        $_highestPrice = '0.00';
        foreach ($this->getAssociatedProduct() as $_item) {
            $_price = $this->getPrice($_item);
            if ($_highestPrice == '0.00' || $_highestPrice < $_price) {
                $_highestPrice = $_price;
            }
        }

        return $_highestPrice;
    }

}