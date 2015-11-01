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
            $products = $this->getProduct()->getTypeInstance(true)->getAssociatedProducts($this->getProduct());
            $this->setData('associated_products', $products);
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
        $lowestPrice = 0.00;
        foreach ($this->getAssociatedProducts() as $item) {
            $price = (float)$this->getPrice($item);
            if ($lowestPrice == 0.00 || $lowestPrice > $price) {
                $lowestPrice = $price;
            }
        }

        return $lowestPrice;
    }

    /**
     * The highest price available in the associated products.
     *
     * @return float|string
     */
    public function getHighestPrice()
    {
        $highestPrice = 0.00;
        foreach ($this->getAssociatedProducts() as $item) {
            $price = (float)$this->getPrice($item);
            if ($highestPrice == 0.00 || $highestPrice < $price) {
                $highestPrice = $price;
            }
        }

        return $highestPrice;
    }
}
