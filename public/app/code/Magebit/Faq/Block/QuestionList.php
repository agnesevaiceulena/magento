<?php
/**
 * This file is part of the Magebit_BackOrder package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit_BackOrder
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2024 Magebit, Ltd.
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */
declare(strict_types=1);

namespace Magebit\Faq\Block;

use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;

class QuestionList extends Template
{
    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;

    /**
     * QuestionList constructor.
     *
     * @param Template\Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        QuestionRepositoryInterface $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        $this->questionRepository = $questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Get all FAQ questions, ordered by position.
     *
     * @return \Magebit\Faq\Api\Data\QuestionInterface[]
     */
    public function getQuestions()
    {
        $sortOrder = $this->sortOrderBuilder
            ->setField('position')
            ->setDirection(SortOrder::SORT_ASC)
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addSortOrder($sortOrder)
            ->create();

        $questions = $this->questionRepository->getList($searchCriteria);

        return $questions->getItems();
    }
}
