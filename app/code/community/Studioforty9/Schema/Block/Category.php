<?php

/**
 * Schema category Block
 *
 * Class Studioforty9_Schema_Block_Category
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Category extends Mage_Core_Block_Template
{
    /**
     * Sets the category
     *
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $category = $this->getCategory();
        if (!$category) {
            $this->setTemplate('');
        }

        return $this;
    }

    /**
     * Gets a category
     *
     * @return Mage_Catalog_Model_Category|false
     */
    public function getCategory()
    {
        if ($this->hasData('category')) {
            return $this->getData('category');
        }
        $this->setData('category', Mage::registry('current_category'));

        return $this->getData('category');
    }

    /**
     * Get Category Name
     *
     * @return mixed
     */
    public function getName()
    {
        return Mage::helper('core/string')->escapeHtml($this->getCategory()->getName());
    }

    /**
     * Get Category Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->getCategory()->getDescription();
    }

    /**
     * @return string
     */
    public function getCreatedDate()
    {
        $time = strtotime($this->getCategory()->getCreatedAt());
        return date('Y-m-d G:i:s', $time);
    }

    /**
     * @return string
     */
    public function getModifiedDate()
    {
        $time = strtotime($this->getCategory()->getUpdatedAt());
        return date('Y-m-d G:i:s', $time);
    }
}