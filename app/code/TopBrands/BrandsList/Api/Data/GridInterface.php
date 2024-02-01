<?php

namespace TopBrands\BrandsList\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    public const ID = 'id';
    public const TITLE = 'title';
    public const IMAGE = 'image';
/**
 * Get ArticleId.
 *
 * @return int
 */
    public function getArticleId();

    /**
     * Set ArticleId.
     *
     * @param int $articleId
     */
    public function setArticleId($articleId);

    /**
     * Get Title.
     *
     * @return string
     */
    public function getTitle();

    // Uncomment the following lines when you add getImage and setImage methods
    // /**
    //  * Get Image.
    //  *
    //  * @return string
    //  */
    // public function getImage();

    // /**
    //  * Set Image.
    //  *
    //  * @param string $image
    //  */
    // public function setImage($image);

    /**
     * Set Title.
     *
     * @param string $title
     */
    public function setTitle($title);
}
