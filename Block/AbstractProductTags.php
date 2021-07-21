<?php

namespace Magepow\ProductTags\Block;

class AbstractProductTags extends \Magento\Framework\View\Element\Template
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

    /**
     * [getTagCollection]
     *@throws Magepow\ProductTags\Model\TagFactory
     */
    public function getTagCollection()
    {   
        $default_limit = $this->_helper->getConfigModule('general/number_tags_sidebar');
        if($this->hasData("number_tags")){
            $limit = (int)$this->getData("number_tags");
        }else{
            $limit = $default_limit;
        }
        $limit = $limit ?? 10;
        $collection = $this->_tagFactory->create()
        ->getCollection()->addFieldToFilter("status", 1)
        ->addStoreFilter($this->_storeManager->getStore())
        ->setOrder("tag_id","DESC")
        ->setPageSize($limit);
        return $collection;
    }

    /**
     * @return number
     */    
    public function getProductCount(\Magepow\ProductTags\Model\Tag $tag)
    {
        $collection = $tag->getProductCollection();
        return $collection->count();
    }

}