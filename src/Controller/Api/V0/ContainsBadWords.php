<?php
namespace MonthlyBasis\ContentModeration\Controller\Api\V0;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
    }
}
