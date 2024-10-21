<?php
namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchResultsInterfaceFactory;



class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @var QuestionResource
     */
    protected $resource;

    /**
     * @var QuestionFactory
     */
    protected $questionFactory;

    /**
     * @var QuestionCollectionFactory
     */
    protected $questionCollectionFactory;

    /**
     * @var SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * QuestionRepository constructor.
     *
     * @param QuestionResource $resource
     * @param QuestionFactory $questionFactory
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        QuestionResource $resource,
        QuestionFactory $questionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Get question by ID.
     *
     * @param int $id
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $id);

        if (!$question->getId()) {
            throw new NoSuchEntityException(__('The FAQ question with ID "%1" doesn\'t exist.', $id));
        }

        return $question;
    }

    /**
     * Save question.
     *
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function save(QuestionInterface $question)
    {
        try {
            if (!$question instanceof \Magebit\Faq\Model\Question) {
                $question = $this->questionFactory->create();
                $question->setData($question->getData());
            }

            $this->resource->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the question: %1', $exception->getMessage()));
        }
        return $question;
    }

    /**
     * Delete question.
     *
     * @param QuestionInterface $question
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(QuestionInterface $question)
    {
        try {
            if (!$question instanceof \Magebit\Faq\Model\Question) {
                $question = $this->questionFactory->create();
                $question->setData($question->getData());
            }

            $this->resource->delete($question);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('Could not delete the question: %1', $exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete question by ID.
     *
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        $question = $this->getById($id);
        return $this->delete($question);
    }

    /**
     * Get list of questions based on search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->questionCollectionFactory->create();

        foreach ($searchCriteria->getFilterGroups() as $group) {
            foreach ($group->getFilters() as $filter) {
                $field = $filter->getField();
                $condition = $filter->getConditionType() ?: 'eq';
                $value = $filter->getValue();
                $collection->addFieldToFilter($field, [$condition => $value]);
            }
        }

        /** @var \Magebit\Faq\Api\Data\QuestionSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
