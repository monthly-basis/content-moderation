<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ContainsBadWords
{
    public function __construct(
        ContentModerationService\RegularExpressionsOfBadWords $regularExpressionsOfBadWords
    ) {
        $this->regularExpressionsOfBadWords = $regularExpressionsOfBadWords;
    }

    public function containsBadWords(
        string $string
    ): bool {
        $patterns = $this->regularExpressionsOfBadWords
                         ->getRegularExpressionsOfBadWords();

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $string)) {
                return true;
            }
        }

        return false;
    }
}
