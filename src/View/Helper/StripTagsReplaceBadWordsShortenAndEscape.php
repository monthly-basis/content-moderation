<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use MonthlyBasis\String\Model\Service as StringService;

class StripTagsReplaceBadWordsShortenAndEscape extends AbstractHelper
{
    public function __construct(
        ContentModerationService\Replace\BadWords $replaceBadWordsService,
        StringService\Escape $escapeService,
        StringService\Shorten $shortenService
    ) {
        $this->replaceBadWordsService = $replaceBadWordsService;
        $this->escapeService          = $escapeService;
        $this->shortenService         = $shortenService;
    }

    public function __invoke(
        string $string,
        int $maxLength,
        string $replacement = '!@#$%^&'
    ): string {
        $string = strip_tags($string);
        $string = $this->replaceBadWordsService->replacebadWords(
            $string,
            $replacement
        );
        $string = $this->shortenService->shorten(
            $string,
            $maxLength
        );
        return $this->escapeService->escape($string);
    }
}
