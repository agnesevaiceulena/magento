<?php
namespace Magebit\Faq\Api;

interface QuestionManagementInterface
{
    public function enableQuestion($id);
    public function disableQuestion($id);
}
