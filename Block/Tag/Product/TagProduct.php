<?php

namespace Magepow\ProductTags\Block\Tag\Product;

class TagProduct extends \Magento\Framework\View\Element\Template
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
            $limit = $this->_helper->getConfigModule('general/number_tags');
            $limit = $limit ?? 10;
            $collection = $this->_tagFactory->create()->getCollection()
            ->addFieldToFilter("status", 1)->setOrder("tag_id","DESC")
            ->setPageSize($limit);
        return $collection;
    }
}
