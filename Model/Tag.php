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
        \Magepow\ProductTags\Model\ResourceModel\Tag $resource,
        \Magepow\ProductTags\Model\ResourceModel\Tag\Collection $resourceCollection,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->tagDataFactory = $tagDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->_productCollectionFactory = $productCollectionFactory;
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

    public function loadByIdentifier($tag_code){
        if($tag_code){
            $tag_id = $this->getResource()->getTagIdByIdentifier($tag_code);
            if($tag_id) {
                $this->load((int)$tag_id);
                return $this;
            }
        }
        return false;
    }

    public function getRelatedReadonly(){
        return false;
    }

    /**
     * Get category products collection
     *
     * @return \Magento\Framework\Data\Collection\AbstractDb|false
     */
    public function getProductCollection()
    {
        if($tag_id = $this->getId()){
            $collection = $this->_productCollectionFactory->create()->setStoreId(
                $this->getStoreId()
            );
            $tag_product = $this->getResource()->getTable("magepow_producttags_product");
            $collection->getSelect()
                        ->join(array('tag_product' =>$tag_product), 'entity_id= tag_product.product_id',
                        array('position' => 'tag_product.position',
                            'tag_id' => 'tag_product.tag_id'
                        )
                    );
            $collection->getSelect()->where("tag_product.tag_id=".(int)$tag_id);
            return $collection;
        }
        return false;
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
