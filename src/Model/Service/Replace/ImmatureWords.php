<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ImmatureWords
{
    public function __construct(
        ContentModerationService\RegularExpressions\ImmatureWords $regularExpressionsOfImmatureWords
    ) {
        $this->regularExpressionsOfImmatureWords = $regularExpressionsOfImmatureWords;
    }

    public function replaceImmatureWords(
        string $string,
        string $replacement = ''
    ): string {
        $patterns = $this->regularExpressionsOfImmatureWords
            ->getRegularExpressionsOfImmatureWords();
        $string = preg_replace($patterns, $replacement, $string);
        return is_null($string) ? '' : $string;
    }
}
