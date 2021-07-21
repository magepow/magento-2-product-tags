<?php

namespace Magepow\ProductTags\Model\ResourceModel\Tag;
use \Magepow\ProductTags\Model\ResourceModel\AbstractCollection;

use Magepow\ProductTags\Api\Data\TagInterface;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'tag_id';
	protected $_eventPrefix = 'magepow_producttags_tag_collection';
	protected $_eventObject = 'tag_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Magepow\ProductTags\Model\Tag::class,
            \Magepow\ProductTags\Model\ResourceModel\Tag::class
        );
        $this->_map['fields']['tag_id'] = 'main_table.tag_id';
        $this->_map['fields']['store'] = 'store_table.store_id';
    }

    /**
     * Set first store flag
     *
     * @param bool $flag
     * @return $this
     */
    public function setFirstStoreFlag($flag = false)
    {
        $this->_previewFlag = $flag;
        return $this;
    }

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter_added')) {
            $this->performAddStoreFilter($store, $withAdmin);
        }
        return $this;
    }

    /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad()
    {
        $entityMetadata = $this->metadataPool->getMetadata(TagInterface::class);
        $this->performAfterLoad('magepow_producttags_store', $entityMetadata->getLinkField());
        $this->_previewFlag = false;

        return parent::_afterLoad();
    }

    /**
     * Perform operations before rendering filters
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        $entityMetadata = $this->metadataPool->getMetadata(TagInterface::class);
        $this->joinStoreRelationTable('magepow_producttags_store', $entityMetadata->getLinkField());
    }
}
