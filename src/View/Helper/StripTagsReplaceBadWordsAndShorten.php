<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class StripTagsReplaceBadWordsAndShorten extends AbstractHelper
{
    public function __construct(
        ContentModerationService\StripTagsReplaceBadWordsAndShorten $stripTagsReplaceBadWordsAndShortenService
    ) {
        $this->stripTagsReplaceBadWordsAndShortenService = $stripTagsReplaceBadWordsAndShortenService;
    }

    public function __invoke(
        string $string,
        int $maxLength
    ): string {
        return $this->stripTagsReplaceBadWordsAndShortenService->stripTagsReplaceBadWordsAndShorten(
            $string,
            $maxLength
        );
    }
}
