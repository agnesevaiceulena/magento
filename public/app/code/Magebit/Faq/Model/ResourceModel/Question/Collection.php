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
 * @author    Magebit <info@magebit.com/>
 * @license   MIT
 */
declare(strict_types=1);

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magebit\Faq\Model\Question as QuestionModel;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;

class Collection extends AbstractCollection
{
    /**
     * Initialize collection model and resource model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(QuestionModel::class, QuestionResource::class);
    }
}
