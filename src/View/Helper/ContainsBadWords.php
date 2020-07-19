<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use Laminas\View\Helper\AbstractHelper;

class ContainsBadWords extends AbstractHelper
{
    public function __construct(
        ContentModerationService\ContainsBadWords $containsBadWordsService
    ) {
        $this->containsBadWordsService = $containsBadWordsService;
    }

    public function __invoke(string $string): string
    {
        return $this->containsBadWordsService->containsBadWords($string);
    }
}
