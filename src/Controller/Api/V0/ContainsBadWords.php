<?php
namespace MonthlyBasis\ContentModeration\Controller\Api\V0;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ContainsBadWords extends AbstractActionController
{
    public function __construct()
    {
    }

    public function indexAction()
    {
        $this->getResponse()->getHeaders()->addHeaderLine(
            'Content-Type',
            'application/json'
        );

        if (isset($_GET['string'])) {
            $array = [
                'success' => true,
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
