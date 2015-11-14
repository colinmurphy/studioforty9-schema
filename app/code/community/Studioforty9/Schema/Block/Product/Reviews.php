<?php

/**
 * Product Reviews
 *
 * Class Studioforty9_Schema_Block_Product_Reviews
 *
 * @category  StudioForty9
 * @package   Schema
 * @author    Colin Murphy <colin@studioforty9.com>
 * @copyright 2015 StudioForty9
 */
class Studioforty9_Schema_Block_Product_Reviews extends Mage_Core_Block_Template
{
    /**
     * @var $_reviewCollection Mage_Review_Model_Resource_Review_Collection
     */
    protected $_reviewCollection;

    /**
     * Checks to see if Reviews are enabled
     *
     * @return Mage_Core_Block_Abstract
     */
    protected function _beforeToHtml()
    {
        if (!$this->isReviewsEnabled()) {
            $this->setTemplate('');
            return parent::_beforeToHtml();
        }

        if (!$this->_setReviews()) {
            $this->setTemplate('');
            return parent::_beforeToHtml();
        }

        return parent::_beforeToHtml();
    }

    /**
     * Checks to see if Reviews are enabled
     *
     * @return bool
     */
    public function isReviewsEnabled()
    {
        return (bool)Mage::helper('core')->isModuleEnabled('Mage_Review');
    }

    /**
     * Sets Product Reviews
     *
     * @return bool
     */
    protected function _setReviews()
    {
        $product = $this->getProduct();
        if (!$product) {
            return false;
        }

        /** @var Mage_Review_Model_Resource_Review_Collection $collection */
        $collection = Mage::getModel('review/review')->getCollection()->addStoreFilter(Mage::app()->getStore()->getId())
            ->addStatusFilter(Mage_Review_Model_Review::STATUS_APPROVED)->addEntityFilter(
                'product', $this->getProduct()->getId()
            )->setDateOrder();

        if (!$collection->count()) {
            return false;
        }

        $this->_reviewCollection = $collection;
        return true;
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
     * @return Mage_Review_Model_Resource_Review_Collection
     */
    public function getReviews()
    {
        return $this->_reviewCollection;
    }

    /**
     * Formats a rating number
     *
     * @param $number
     *
     * @return string
     */
    public function formaRatingtNumber($number)
    {
        return number_format($number, 2, '.', '');
    }

    /**
     * Gets the aggregate ratings
     *
     * @return bool|float
     */
    public function getAggregateRating()
    {
        $collection = Mage::getModel('rating/rating_option_vote')
            ->getResourceCollection()
            ->setEntityPkFilter($this->getProduct()->getId())
            ->setStoreFilter(Mage::app()->getStore()->getId());
        return $this->getAverageRatingByCollection($collection);
    }

    /**
     * Get Reviews Total
     *
     * @return int
     */
    public function getReviewTotal()
    {
        return $this->getReviews()->count();
    }

    /**
     * Gets the average rating for the review
     *
     * @param Mage_Review_Model_Review $review
     *
     * @return bool|float
     */
    public function getAverageRatingByReview(Mage_Review_Model_Review $review)
    {
        $collection = Mage::getModel('rating/rating_option_vote')
            ->getResourceCollection()
            ->setReviewFilter($review->getId())
            ->setStoreFilter(Mage::app()->getStore()->getId());

        $rating = $this->getAverageRatingByCollection($collection);
        if (!$rating) {
            return false;
        }
        return $this->formaRatingtNumber($rating);
    }

    /**
     * Gets the average rating of a collection
     *
     * @param Mage_Rating_Model_Resource_Rating_Option_Vote_Collection $collection
     *
     * @return bool|float
     */
    public function getAverageRatingByCollection(Mage_Rating_Model_Resource_Rating_Option_Vote_Collection $collection)
    {
        if (!$collection->count()) {
            return false;
        }

        $ratingValue = 0;
        $count = 0;
        /** @var Mage_Rating_Model_Rating_Option_Vote $rating */
        while ($rating = $collection->fetchItem()) :
            $ratingValue += $rating->getValue();
            $count++;
        endwhile;

        return $this->formaRatingtNumber($ratingValue/$count);
    }
}
