<?php

/**
 * Schema Block
 *
 * Class StudioForty9_Schema_Block_Product
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class StudioForty9_Schema_Block_Product extends Mage_Core_Block_Template
{
    /**
     * Sets the product
     *
     * @return $this|bool
     */
    protected function _beforeToHtml()
    {
        $_product = $this->getProduct();
        if (!$_product) {
            $this->setTemplate('');
            return $this;
        }

        if (! $this->getChild('information')) {
            $_block = Mage::getBlockSingleton('studioforty9_schema/product_information');
            $_block->setProduct($_product);
            $_block->setTemplate('studioforty9_schema/includes/information.phtml');
            $this->setChild('information', $_block);
        }

    }

    /**
     * Gets a product
     *
     * @return Mage_Catalog_Model_Product|mixed
     */
    public function getProduct()
    {
        $_product = $this->getData('product');
        if ($_product) {
            return $_product;
        }

        $_product = Mage::registry('current_product');
        if (!$_product) {
            return false;
        }
        return $_product;
    }

    /**
     * @param Mage_Catalog_Model_Product $_product
     *
     * @return float
     */
    public function getPrice(Mage_Catalog_Model_Product $_product)
    {
        return number_format($_product->getFinalPrice(), 2, '.', '');
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return Mage::app()->getStore()->getCurrentCurrencyCode();
    }

    /**
     * @param $_currency_code
     *
     * @return string
     */
    public function getCurrencySymbol($_currency_code)
    {
        return Mage::app()->getLocale()
            ->currency($_currency_code)
            ->getSymbol();
    }

}