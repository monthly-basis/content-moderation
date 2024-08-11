<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use Laminas\View\Helper\AbstractHelper;

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
    ) : string {
        return $this->stripTagsReplaceBadWordsAndShortenService->stripTagsReplaceBadWordsAndShorten(
            $string,
            $maxLength
        );
    }
}
