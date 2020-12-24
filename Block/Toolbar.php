<?php

namespace Magepow\ProductTags\Block;

class Toolbar extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        // how to get store name and build url
        return __($this->_storeManager->getStore()->getName(), $this->getUrl('contacts'));
    }
}
