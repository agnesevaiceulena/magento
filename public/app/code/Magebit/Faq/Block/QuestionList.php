<?php

namespace Magebit\Faq\Block;

use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

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
     * QuestionList constructor.
     *
     * @param Template\Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        QuestionRepositoryInterface $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->questionRepository = $questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Get all FAQ questions, ordered by position.
     *
     * @return \Magebit\Faq\Api\Data\QuestionInterface[]
     */
    public function getQuestions()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addSortOrder('position', 'ASC')
            ->create();

        $questions = $this->questionRepository->getList($searchCriteria);

        return $questions->getItems();
    }
}
