<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magepow\ProductTags\Model\Tag\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class IsActive implements OptionSourceInterface
{
    /**
     * @var \Magepow\ProductTags\Model\Tag
     */
    protected $producttags;

    public function __construct(\Magepow\ProductTags\Model\Tag $producttags)
    {
        $this->producttags = $producttags;
    }

    public function toOptionArray()
    {
        $availableOptions = $this->producttags->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
