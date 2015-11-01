<?php

/**
 * Downloadable Product
 *
 * Class Studioforty9_Schema_Block_Product_Downloadable
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Product_Downloadable extends Studioforty9_Schema_Block_Product
{
    /**
     * Get the products associated for this configurable giproduct.
     *
     * @return array|false
     */
    public function getDownloadableProducts()
    {
        if (!$this->getData('downloadable_products')) {
            if (!$this->getProduct()) {
                return false;
            }

            /** @var Mage_Downloadable_Model_Product_Type $products */
            $products = $this->getProduct()->getTypeInstance();
            $links = $products->getLinks();

            if (empty($links)) {
                return false;
            }
            $this->setData('downloadable_products', $products->getLinks());
        }

        return $this->getData('downloadable_products');
    }

    /**
     * @param $item
     *
     * @return float
     */
    public function getPrice($item)
    {
        return $this->formatPrice($this->getProduct()->getFinalPrice() + $item->getPrice());
    }

    /**
     * The lowest price available in the associated products.
     *
     * @return float|string
     */
    public function getLowestPrice()
    {
        $lowestPrice = $this->getProduct()->getFinalPrice();
        foreach ($this->getDownloadableProducts() as $link) {
            $price = (float)$this->getPrice($link);
            if ($lowestPrice > $price) {
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
        $highestPrice = $this->getProduct()->getFinalPrice();
        foreach ($this->getDownloadableProducts() as $link) {
            $price = (float)$this->getPrice($link);
            if ($highestPrice < $price) {
                $highestPrice = $price;
            }
        }

        return $highestPrice;
    }
}
