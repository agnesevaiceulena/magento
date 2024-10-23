<?php
/**
 * This file is part of the Magebit_BackOrder package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit_BackOrder
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */
declare(strict_types=1);

namespace Magebit\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get list of questions.
     *
     * @return \Magebit\Faq\Api\Data\QuestionInterface[]
     */
    public function getItems();

    /**
     * Set list of questions.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
