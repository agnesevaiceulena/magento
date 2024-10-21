<?php
namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface QuestionRepositoryInterface
{
    public function getById($id);
    public function save(QuestionInterface $question);
    public function delete(QuestionInterface $question);
    public function deleteById($id);
    public function getList(SearchCriteriaInterface $criteria);
}
