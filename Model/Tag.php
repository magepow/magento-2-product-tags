<?php

namespace Magepow\ProductTags\Model;
use Magepow\ProductTags\Api\Data\TagInterface;
use Magepow\ProductTags\Api\Data\TagInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Tag extends \Magento\Framework\Model\AbstractModel
{
    protected $tagDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'magepow_producttags_tag';

    /**
     * @var _stockconfig
     */
    protected $_stockConfig;

     /**
     * @var \Magento\CatalogInventory\Helper\Stock
     */
    protected $_stockFilter;

    /**
     * Catalog product visibility
     *
     * @var \Magento\Catalog\Model\Product\Visibility
     */
    protected $_catalogProductVisibility;

    /**
     * Product collection factory
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_productCollectionFactory;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TagInterfaceFactory $tagDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Magento\CatalogInventory\Helper\Stock $stockFilter,
        \Magento\CatalogInventory\Model\Configuration $stockConfig,
        \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magepow\ProductTags\Model\ResourceModel\Tag $resource,
        \Magepow\ProductTags\Model\ResourceModel\Tag\Collection $resourceCollection,
        array $data = []
    ) {
        $this->tagDataFactory   = $tagDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->_stockFilter     = $stockFilter;
        $this->_stockConfig     = $stockConfig;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_catalogProductVisibility = $catalogProductVisibility;

        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

   
    public function getDataModel()
    {
        $tagData = $this->getData();
        
        $tagDataObject = $this->tagDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $tagDataObject,
            $tagData,
            TagInterface::class
        );
        
        return $tagDataObject;
    }

    /**
     * Retrieve array of product id's for category
     *
     * The array returned has the following format:
     * array($productId => $position)
     *
     * @return array
     */
    public function getProductsPosition()
    {
        if (!$this->getId()) {
            return [];
        }

        $array = $this->getData('products_position');
        if ($array === null) {
            $array = $this->getResource()->getProductsPosition($this);
            $this->setData('products_position', $array);
        }

        return $array;
    }

    public function loadByIdentifier($tag_code)
    {
        if($tag_code){
            $tag_id = $this->getResource()->getTagIdByIdentifier($tag_code);
            if($tag_id) {
                $this->load((int)$tag_id);
                return $this;
            }
        }

        return false;
    }

    public function getRelatedReadonly()
    {
        return false;
    }

    /**
     * Get category products collection
     *
     * @return \Magento\Framework\Data\Collection\AbstractDb|false
     */
    public function getProductCollection()
    {   
        $tagId = $this->getId();
        if($tagId){
            $collection = $this->_productCollectionFactory->create();
            $collection->setVisibility($this->_catalogProductVisibility->getVisibleInCatalogIds());      

            $collection->joinField(
                'position', 'magepow_producttags_product', 'position', 'product_id=entity_id', null, 'inner'
            )->joinField(
                'tag_id', 'magepow_producttags_product', 'tag_id', 'product_id=entity_id', null, 'inner'
            )->groupByAttribute('entity_id');

            $collection->addAttributeToFilter('tag_id', $tagId)
                    ->addAttributeToSort('position', 'ASC')
                    ->addStoreFilter();
            if ($this->_stockConfig->isShowOutOfStock() != 1) {
                $this->_stockFilter->addInStockFilterToCollection($collection);
            }

            return $collection;
        }
    }

     /**
     * Receive page store ids
     *
     * @return int[]
     */
    public function getStores()
    {
        return $this->hasData('stores') ? $this->getData('stores') : (array)$this->getData('store_id');
    }

    /**
     * Check if page identifier exist for specific store
     * return page id if page exists
     *
     * @param string $identifier
     * @param int $storeId
     * @param bool $isAdmin
     * @return int
     */
    public function checkIdentifier($identifier, $storeId, $isAdmin = false)
    {
        return $this->_getResource()->checkIdentifier($identifier, $storeId, $isAdmin);
    }
   
}
