<?php

namespace Magepow\ProductTags\Api;
use Magento\Framework\Api\SearchCriteriaInterface;
interface TagRepositoryInterface
{
    /**
     * Save Tag
     * @param \Magepow\ProductTags\Api\Data\TagInterface $tag
     * @return \Magepow\ProductTags\Api\Data\TagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Magepow\ProductTags\Api\Data\TagInterface $tag);
    /**
     * Retrieve Tag
     * @param string $tagId
     * @return \Magepow\ProductTags\Api\Data\TagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($tagId);
    /**
     * Retrieve Tag matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magepow\ProductTags\Api\Data\TagSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );
    /**
     * Delete Tag
     * @param bool $tagId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete($tagId);
    /**
     * Delete Tag by ID
     * @param string $tagId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($tagId);
    /**
     * Retrieve Tag
     * @param string $tagId
     * @return \Magepow\ProductTags\Api\Data\TagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getListTag($tagId);
}