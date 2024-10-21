<?php
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
