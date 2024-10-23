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

namespace Magebit\Faq\Api;
interface QuestionManagementInterface
{
    /**
     * Enable a specific question by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function enableQuestion($id);

    /**
     * Disable a specific question by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function disableQuestion($id);
}
