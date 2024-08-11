<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ContainsBadWords extends AbstractHelper
{
    public function __construct(
        protected ContentModerationService\ContainsBadWords $containsBadWordsService
    ) {
    }

    public function __invoke(string $string): bool
    {
        return $this->containsBadWordsService->containsBadWords($string);
    }
}
