<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Psr\Log\LoggerInterface;

class InlineEdit extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param Action\Context $context
     * @param JsonFactory $jsonFactory
     * @param QuestionRepositoryInterface $questionRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        QuestionRepositoryInterface $questionRepository,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->questionRepository = $questionRepository;
        $this->logger = $logger;
    }

    /**
     * Inline edit action for FAQ Questions
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $messages = [];
        $error = false;

        $this->logger->info('InlineEdit request data: ', $this->getRequest()->getParams());

        if (!$this->getRequest()->isAjax()) {
            $this->logger->error('Not an AJAX request.');
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        $postItems = $this->getRequest()->getParam('items', []);

        $this->logger->info('Post items: ', $postItems);

        if (!count($postItems)) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach ($postItems as $questionId => $data) {
            try {
                $question = $this->questionRepository->getById((int) $questionId);

                $question->setData(array_merge($question->getData(), $data));

                $this->questionRepository->save($question);
            } catch (\Exception $e) {
                $messages[] = "[ID: {$questionId}] " . $e->getMessage();
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error,
        ]);
    }
}
