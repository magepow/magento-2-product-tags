<?php

namespace Magepow\ProductTags\Block;

class ListTags extends \Magepow\ProductTags\Block\AbstractProductTags 
{

    /**
     * @return string
     */
    public function getListTags()
    {
        // how to get store name and build utl
        return __($this->_storeManager->getStore()->getName(), $this->getUrl('producttags'));
    }
}
