<?php

namespace Magebit\PageListWidget\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DisplayMode implements OptionSourceInterface
{
    public function toOptionArray()
    {
      return [
            ['value' => 'all', 'label' => __('All pages')],
            ['value' => 'specific', 'label' => __('Specific pages')],
        ];
    }
}
