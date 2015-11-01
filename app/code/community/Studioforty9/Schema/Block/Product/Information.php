<?php

/**
 * Information Block
 *
 * Class Studioforty9_Schema_Block_Product_Information
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Product_Information extends Mage_Core_Block_Template
{
    /**
     * Gets the image file
     *
     * @param Mage_Catalog_Model_Product $_product
     *
     * @return string
     */
    public function getImageFile(Mage_Catalog_Model_Product $product)
    {
        $image = $this->_getImageFromProduct($product);
        $image = (!$image) ? $this->_getImageFromGallery($product) : $image;
        $image = trim($image);
        if (!$image) {
            return '';
        }

        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);

        return $url . 'catalog/product/' . $image;
    }

    /**
     * Get the image from the product.
     *
     * @param Mage_Catalog_Model_Product $product
     *
     * @return string
     */
    private function _getImageFromProduct(Mage_Catalog_Model_Product $product)
    {
        $image = $product->getImage();

        if (!$image && $image === 'no_selection') {
            return '';
        }

        return $image;
    }

    /**
     * Get the first image from the image gallery.
     *
     * @param Mage_Catalog_Model_Product $product
     *
     * @return string
     */
    private function _getImageFromGallery(Mage_Catalog_Model_Product $product)
    {
        $gallery = $product->getMediaGalleryImages();
        if (!$gallery->count()) {
            return '';
        }

        $image = $gallery->getFirstItem();
        if (!$image || !$image->hasFile()) {
            return '';
        }

        return $image->getFile();
    }
}
