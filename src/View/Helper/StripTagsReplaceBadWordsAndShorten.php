<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use MonthlyBasis\String\Model\Service as StringService;

class StripTagsReplaceBadWordsAndShorten extends AbstractHelper
{
    public function __construct(
        ContentModerationService\Replace\BadWords $replaceBadWordsService,
        StringService\Shorten $shortenService
    ) {
        $this->replaceBadWordsService = $replaceBadWordsService;
        $this->shortenService         = $shortenService;
    }

    public function __invoke(
        string $string,
        int $maxLength
    ): string {
        $string = strip_tags($string);
        $string = $this->replaceBadWordsService->replacebadWords($string);
        return $this->shortenService->shorten(
            $string,
            $maxLength
        );
    }
}
