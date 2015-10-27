<?php

/**
 * Configurable Product
 *
 * Class Studioforty9_Schema_Block_Product_Configurable
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Product_Configurable extends Studioforty9_Schema_Block_Product_Grouped
{
    /**
     * Get the products associated with this grouped product.
     *
     * @return array|false
     */
    public function getAssociatedProducts()
    {
        if (!$this->getData('associated_products')) {
            if (!$this->getProduct()) {
                return false;
            }

            $block = Mage::getBlockSingleton('catalog/product_view_type_configurable');
            $block->setProduct($this->getProduct());
            $products = Mage::helper('core')->jsonDecode($block->getJsonConfig());
            $this->setBasePrice($products['basePrice']);
            $this->setData('associated_products', $products['attributes']);
        }

        return $this->getData('associated_products');
    }

    /**
     * @param array $item
     *
     * @return float
     */
    public function getPrice($item)
    {
        return $this->formatPrice($this->getBasePrice() + $item['price']);
    }

    /**
     * The lowest price available in the associated products.
     *
     * @return float|string
     */
    public function getLowestPrice()
    {
        $lowestPrice = 0.00;
        foreach ($this->getAssociatedProducts() as $id => $attributes) {
            foreach ($attributes['options'] as $attrId => $item) {
                $price = (float)$this->getPrice($item);
                if ($lowestPrice == 0.00 || $lowestPrice > $price) {
                    $lowestPrice = $price;
                }
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
        foreach ($this->getAssociatedProducts() as $id => $attributes) {
            foreach ($attributes['options'] as $attrId => $item) {
                $price = (float)$this->getPrice($item);
                if ($highestPrice == 0.00 || $highestPrice < $price) {
                    $highestPrice = $price;
                }
            }
        }
        return $highestPrice;
    }

}
