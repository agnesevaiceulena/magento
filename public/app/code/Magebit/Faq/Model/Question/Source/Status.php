<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com/>
 * @license   MIT
 */
declare(strict_types=1);

namespace Magebit\Faq\Model\Question\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Get available statuses.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::STATUS_ENABLED, 'label' => __('Enabled')],
            ['value' => self::STATUS_DISABLED, 'label' => __('Disabled')],
        ];
    }

    /**
     * Get available statuses as a key-value pair array.
     *
     * @return array
     */
    public function getOptionArray()
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled'),
        ];
    }
}
