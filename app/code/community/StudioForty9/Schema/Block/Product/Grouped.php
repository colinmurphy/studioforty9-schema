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
     * Gets the image file
     *
     * @param Mage_Catalog_Model_Product $_product
     *
     * @return bool|string
     */
    public function getImageFile(Mage_Catalog_Model_Product $_product)
    {
        $_image = $_product->getImage();
        if (! $_image || $_image == 'no_selection')
        {
            $_image = $_product->getMediaGalleryImages()->getFirstItem();
            if (! $_image) {
                return false;
            }
            $_image = $_image->getFile();
            if (! $_image) {
                return false;
            }
        }
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)
        . 'catalog/product' . $_image;
    }

}