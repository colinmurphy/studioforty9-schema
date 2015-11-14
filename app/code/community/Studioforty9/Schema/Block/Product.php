<?php

/**
 * Schema Product Block
 *
 * Class Studioforty9_Schema_Block_Product
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Product extends Mage_Core_Block_Template
{
    /**
     * Sets the product
     *
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $product = $this->getProduct();
        if (!$product) {
            $this->setTemplate('');

            return $this;
        }

        if (!$this->getChild('information')) {
            /** @var Studioforty9_Schema_Block_Product_Information $block */
            $block = Mage::getBlockSingleton('studioforty9_schema/product_information');
            $block->setProduct($product);
            $block->setTemplate('studioforty9_schema/includes/information.phtml');
            $this->setChild('information', $block);
        }

        return $this;
    }

    /**
     * Gets a product
     *
     * @return Mage_Catalog_Model_Product|false
     */
    public function getProduct()
    {
        if ($this->hasData('product')) {
            return $this->getData('product');
        }
        $this->setData('product', Mage::registry('current_product'));

        return $this->getData('product');
    }

    /**
     * @param mixed $item
     *
     * @return float
     */
    public function getPrice($item)
    {
        return $this->formatPrice($item->getPrice());
    }

    /**
     * @param Mage_Catalog_Model_Product $product
     *
     * @return float
     */
    public function formatPrice($price)
    {
        return number_format($price, 2, '.', '');
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return Mage::app()->getStore()->getCurrentCurrencyCode();
    }

    /**
     * @param $currencyCode
     *
     * @return string
     */
    public function getCurrencySymbol($currencyCode)
    {
        return Mage::app()->getLocale()->currency($currencyCode)->getSymbol();
    }
}
