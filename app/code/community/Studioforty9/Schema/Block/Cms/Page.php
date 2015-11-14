<?php

/**
 * Schema CMS Page Block
 *
 * Class Studioforty9_Schema_Block_Cms_Page
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Cms_Page extends Mage_Core_Block_Template
{
    /**
     * Sets the product
     *
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $page = $this->getPage();
        if (!$page) {
            $this->setTemplate('');
            return $this;
        }
        return $this;
    }

    /**
     * Gets a page
     *
     * @return Mage_Cms_Model_Page|false
     */
    public function getPage()
    {
        if ($this->hasData('page')) {
            return $this->getData('page');
        }
        $this->setData('page', Mage::getSingleton('cms/page'));

        return $this->getData('page');
    }

    /**
     * Gets the page title
     *
     * @return string
     */
    public function getTitle()
    {
        $title = $this->getPage()->getTitle();
        return Mage::helper('core/string')->escapeHtml($title);
    }

    /**
     * Gets the page headline
     *
     * @return string|false
     */
    public function getHeadline()
    {
        $title = $this->getPage()->getContentHeading();
        if (!$title) {
            return false;
        }
        return Mage::helper('core/string')->escapeHtml($title);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getPage()->getContent();
    }

    /**
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->getPage()->getCreationTime();
    }

    /**
     * @return string
     */
    public function getModifiedDate()
    {
        return $this->getPage()->getUpdateTime();
    }

    /**
     * @param string $date
     *
     * @return string
     */
    public function formatSchemaDate($date)
    {
        return $this->formatDate($date, Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
    }

}
