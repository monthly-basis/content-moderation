<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use LeoGalleguillos\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class EscapeAndReplaceBadWords extends AbstractHelper
{
    public function __construct(
        StringService\Escape $escapeService,
        ContentModerationService\ReplaceBadWords $replaceBadWordsService
    ) {
        $this->escapeService          = $escapeService;
        $this->replaceBadWordsService = $replaceBadWordsService;
    }

    public function __invoke(
        string $string,
        string $replacement = '!@#$%^&'
    ): string {
        $stringEscaped = $this->escapeService->escape($string);

        return $this->replaceBadWordsService->replaceBadWords(
            $stringEscaped,
            $replacement
        );
    }
}
