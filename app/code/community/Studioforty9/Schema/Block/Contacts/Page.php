<?php

/**
 * Schema CMS Page Block
 *
 * Class Studioforty9_Schema_Block_Contacts_Page
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Contacts_Page extends Mage_Core_Block_Template
{
    /**
     * Gets contact data
     *
     * @param $name
     * @param $configPath
     *
     * @return mixed
     */
    public function getContactData($name, $configPath)
    {
        $data = $this->getData($name);
        if (! $data) {
            $data = Mage::getStoreConfig($configPath);
        }
        return Mage::helper('core/string')->escapeHtml($data);
    }


    /**
     * @return string|false
     */
    public function getName()
    {
        return $this->getContactData('name', 'general/store_information/name');
    }

    /**
     * @return string|false
     */
    public function getAddress()
    {
        return $this->getContactData('address', 'general/store_information/address');
    }

    /**
     * @return string|false
     */
    public function getLocality()
    {
        $data = $this->getData('locality');
        if (! $data) {
            $data = $this->getMerchantCountry();
        }
        return Mage::helper('core/string')->escapeHtml($data);
    }

    /**
     * @return string|false
     */
    public function getMerchantCountry()
    {
        $country = Mage::getStoreConfig('general/store_information/merchant_country');
        if (! $country) {
            return false;
        }
        $country =  Mage::getModel('directory/country')->loadByCode($country);
        return $country->getName();
    }

    /**
     * @return string|false
     */
    public function getPhone()
    {
        return $this->getContactData('phone', 'general/store_information/phone');
    }

    /**
     * @return string|false
     */
    public function getOpeningHours()
    {
        return $this->getContactData('opening_hours', 'general/store_information/hours');
    }

    /**
     * @return string|false
     */
    public function getEmail()
    {
        return $this->getContactData('email', 'trans_email/ident_support/email');
    }
}
