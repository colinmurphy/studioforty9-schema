<?php

/**
 * Grouped Product
 *
 * Class Studioforty9_Schema_Block_Product_Grouped
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Product_Grouped extends Studioforty9_Schema_Block_Product
{
    /**
     * Get the products associated with this grouped product.
     *
     * @return array
     */
    public function getAssociatedProducts()
    {
        if (!$this->getData('associated_products')) {
            if (!$this->getProduct()) {
                return array();
            }
            $_products = $this->getProduct()
                ->getTypeInstance(true)
                ->getAssociatedProducts($this->getProduct());
            $this->setData('associated_products', $_products);
        }

        return $this->getData('associated_products');
    }

    /**
     * The lowest price available in the associated products.
     *
     * @return float|string
     */
    public function getLowestPrice()
    {
        $_lowestPrice = 0.00;
        foreach ($this->getAssociatedProducts() as $_item) {
            $_price = (float) $this->getPrice($_item);
            if ($_lowestPrice == 0.00 || $_lowestPrice > $_price) {
                $_lowestPrice = $_price;
            }
        }

        return $_lowestPrice;
    }

    /**
     * The highest price available in the associated products.
     *
     * @return float|string
     */
    public function getHighestPrice()
    {
        $_highestPrice = 0.00;
        foreach ($this->getAssociatedProducts() as $_item) {
            $_price = (float) $this->getPrice($_item);
            if ($_highestPrice == 0.00 || $_highestPrice < $_price) {
                $_highestPrice = $_price;
            }
        }

        return $_highestPrice;
    }
}
