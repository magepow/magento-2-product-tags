<?php

namespace Magepow\ProductTags\Api\Data;

interface TagSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Tag list.
     * @return \Magepow\ProductTags\Api\Data\TagInterface[]
     */
    public function getItems();

    /**
     * Set tag_name list.
     * @param \Magepow\ProductTags\Api\Data\TagInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
