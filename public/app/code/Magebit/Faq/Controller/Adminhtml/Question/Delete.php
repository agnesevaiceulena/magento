<?php
namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Framework\Exception\LocalizedException;

class Delete extends Action
{
    protected $questionFactory;

    public function __construct(
        Action\Context $context,
        QuestionFactory $questionFactory
    ) {
        parent::__construct($context);
        $this->questionFactory = $questionFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->questionFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('The FAQ has been deleted.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while deleting the FAQ.'));
            }
        }

        return $this->_redirect('faq/question/index');
    }
}
