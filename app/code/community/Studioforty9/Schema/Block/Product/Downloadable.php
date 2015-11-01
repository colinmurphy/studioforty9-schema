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
     * Get the downloadable products
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
            $this->setData('downloadable_products', $links);
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
     * The lowest price available for the downloadable product
     *
     * @return float
     */
    public function getLowestPrice()
    {
        return $this->formatPrice($this->getProduct()->getFinalPrice());
    }

    /**
     * The highest price available for the downloadable product
     *
     * @return float
     */
    public function getHighestPrice()
    {
        $highestPrice = $this->getProduct()->getFinalPrice();
        foreach ($this->getDownloadableProducts() as $link) {
            $highestPrice += (float)$link->getPrice();
        }

        return $this->formatPrice($highestPrice);
    }
}
