<?php

namespace Magepow\ProductTags\Api;

interface ProductsManagementInterface
{

    /**
     * Get List Product by Identyfier
     * @param string $tagCode
     * @return \Magepow\ProductTags\Api\Data\TagProductLinkInterface[]|false
     */
    public function getProducts($tagCode);
}
