<?php
/**
 * @author Robert Rupa <office@konatsu.pl>
 */

namespace RobertRupa\AdditionalAttributeForSorting\Block\Product\ProductList;

use Magento\Catalog\Block\Product\ProductList\Toolbar;
use Magento\Framework\Data\Collection;
use RobertRupa\AdditionalAttributeForSorting\Model\Attribute;

class ToolbarOverride extends Toolbar
{
    /**
     * Set collection to pager
     *
     * @param Collection $collection
     * @return $this
     */
    public function setCollection($collection) {
        $this->_collection = $collection;
        $this->_collection->setCurPage($this->getCurrentPage());

        // we need to set pagination only if passed value integer and more that 0
        $limit = (int)$this->getLimit();
        if ($limit) {
            $this->_collection->setPageSize($limit);
        }

        // switch between sort order options
        if ($this->getCurrentOrder()) {
            // create custom query for created_at option
            switch ($this->getCurrentOrder()) {
                case Attribute::ATTRIBUTE_NAME:
                    if ($this->getCurrentDirection() == 'desc') {
                        $this->_collection->setOrder(Attribute::ATTRIBUTE_NAME,'DESC');
                    } elseif ($this->getCurrentDirection() == 'asc') {
                        $this->_collection->setOrder(Attribute::ATTRIBUTE_NAME,'ASC');
                    }
                    break;
                default:
                    $this->_collection->setOrder($this->getCurrentOrder(), $this->getCurrentDirection());
                    break;
            }
        }

        return $this;
    }
}