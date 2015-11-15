<?php

/**
 * Schema Helper
 *
 * Class Studioforty9_Schema_Helper_Data
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @param string $date
     *
     * @return string
     */
    public function formatSchemaDate($date)
    {
        return Mage::helper('core')->formatDate($date, Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
    }
}