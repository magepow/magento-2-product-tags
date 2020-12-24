<?php

namespace Magepow\ProductTags\Block\Tag\Product;

class ListProduct extends \Magento\Framework\View\Element\Template
{
    protected $resultPageFactory;

    protected $_tagFactory;

    protected $_tagcollection;

    protected $_helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magepow\ProductTags\Model\TagFactory $tagFactory,
        \Magepow\ProductTags\Helper\Data $helper,
        array $data = []
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_tagFactory = $tagFactory;
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }
    
    public function getTagCollection()
    {
            $limit = $this->_helper->getConfigModule('general/number_tags_sidebar');
            $limit = $limit ?? 10;
            $tag = $this->_tagFactory->create();
            $collection = $tag->getCollection()->addFieldToFilter("status", 1)
            ->setOrder("tag_id","DESC")->setPageSize($limit);
        return $collection;
    }
}
