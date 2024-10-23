<?php
/**
 * This file is part of the Magebit_BackOrder package.
 *
 * @copyright Copyright (c) 2024 Magebit, Ltd.
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */
declare(strict_types=1);

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface for managing FAQ questions in the repository.
 */
interface QuestionRepositoryInterface
{
    /**
     * Get question by ID.
     *
     * @param int $id
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     */
    public function getById($id);

    /**
     * Save a question.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     */
    public function save(QuestionInterface $question);

    /**
     * Delete a question.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return bool
     */
    public function delete(QuestionInterface $question);

    /**
     * Delete question by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteById($id);

    /**
     * Get list of questions based on search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);
}
