<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ReplaceBadWords
{
    public function __construct(
        ContentModerationService\RegularExpressionsOfBadWords $regularExpressionsOfBadWords
    ) {
        $this->regularExpressionsOfBadWords = $regularExpressionsOfBadWords;
    }

    public function replaceBadWords(
        string $string
    ): string {
        $patterns    = $this->regularExpressionsOfBadWords
                            ->getRegularExpressionsOfBadWords();
        $replacement = '!@#$%^&';
        $string = preg_replace($patterns, $replacement, $string);
        return is_null($string) ? '' : $string;
    }
}
