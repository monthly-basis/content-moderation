<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ToHtml extends AbstractHelper
{
    public function __construct(
        ContentModerationService\ToHtml $toHtmlService
    ) {
        $this->toHtmlService = $toHtmlService;
    }

    public function __invoke(string $string): string
    {
        return $this->toHtmlService->toHtml($string);
    }
}
