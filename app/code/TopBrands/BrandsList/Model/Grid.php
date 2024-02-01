<?php

namespace TopBrands\BrandsList\Model;

use TopBrands\BrandsList\Api\Data\GridInterface;

class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
    /**
     * Cache tag for this resource
     */
    public const CACHE_TAG = 'topbrands_grid';

    /**
     * Cache tag for this resource
     *
     * @var string
     */
    protected $_cacheTag = 'topbrands_grid';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'topbrands_grid';

    /**
     * Initialize model
     */
    protected function _construct()
    {
        $this->_init(\TopBrands\BrandsList\Model\ResourceModel\Grid::class);
    }

    /**
     * Get Article Id
     *
     * @return int
     */
    public function getArticleId()
    {
        return $this->getData(self::id);
    }

    /**
     * Set Article Id
     *
     * @param int $articleId
     * @return $this
     */
    public function setArticleId($articleId)
    {
        return $this->setData(self::id, $articleId);
    }

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    // Uncomment and complete the following methods if needed:

    // /**
    //  * Get Email
    //  *
    //  * @return string
    //  */
    // public function getEmail()
    // {
    //     return $this->getData(self::EMAIL);
    // }

    // /**
    //  * Set Email
    //  *
    //  * @param string $email
    //  * @return $this
    //  */
    // public function setEmail($email)
    // {
    //     return $this->setData(self::EMAIL, $email);
    // }
}
