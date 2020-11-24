<?php
/**
 * @author Robert Rupa <office@konatsu.pl>
 */

namespace RobertRupa\AdditionalAttributeForSorting\Plugin;

use Magento\Catalog\Model\Config;
use RobertRupa\AdditionalAttributeForSorting\Model\Attribute;

class ConfigPlugin
{
    /**
     * Add sort order option to frontend
     * @param Config $catalogConfig
     * @param $options
     * @return mixed
     */
    public function afterGetAttributeUsedForSortByArray(
        Config $catalogConfig,
        $options
    ) {
        $options[Attribute::ATTRIBUTE_NAME] = __(Attribute::ATTRIBUTE_LABEL);
        return $options;
    }
}