<?php
/**
 * This file is part of the Magebit_PageListWidget package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit_PageListWidget
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com/>
 * @license   MIT
 */

namespace Magebit\PageListWidget\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DisplayMode implements OptionSourceInterface
{
    /**
     * Get display mode options.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'all', 'label' => __('All pages')],
            ['value' => 'specific', 'label' => __('Specific pages')],
        ];
    }
}
