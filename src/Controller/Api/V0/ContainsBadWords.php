<?php
namespace MonthlyBasis\ContentModeration\Controller\Api\V0;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ContainsBadWords extends AbstractActionController
{
    public function __construct(
        ContentModerationService\ContainsBadWords $containsBadWordsService
    ) {
        $this->containsBadWordsService = $containsBadWordsService;
    }

    public function indexAction()
    {
        $this->getResponse()->getHeaders()->addHeaderLine(
            'Content-Type',
            'application/json'
        );

        if (isset($_GET['string'])) {
            $containsBadWords = $this->containsBadWordsService->containsBadWords(
                $_GET['string']
            );
            $array = [
                'contains-bad-words' => $containsBadWords,
                'success'            => true,
            ];
        } else {
            $array = [
                'success' => false,
            ];
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariables([
            'array' => $array,
        ]);
        return $viewModel;
    }
}
