<?php

namespace Magepow\ProductTags\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TagsManagementInterface
{

    /**
     * Retrieve Tag matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magepow\ProductTags\Api\Data\TagSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getTags(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );
}
