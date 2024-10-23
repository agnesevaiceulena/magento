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

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\QuestionManagementInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionManagement implements QuestionManagementInterface
{
    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * QuestionManagement constructor.
     *
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->questionRepository = $questionRepository;
    }

    /**
     * Enable a question by ID.
     *
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     */
    public function enableQuestion($id)
    {
        $question = $this->questionRepository->getById($id);
        $question->setStatus(1);
        $this->questionRepository->save($question);
        return true;
    }

    /**
     * Disable a question by ID.
     *
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     */
    public function disableQuestion($id)
    {
        $question = $this->questionRepository->getById($id);
        $question->setStatus(0);
        $this->questionRepository->save($question);
        return true;
    }
}
