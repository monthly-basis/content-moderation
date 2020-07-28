<?php
namespace MonthlyBasis\ContentModeration\Model\Factory;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ContainsBadWords
{
    public function __construct(
        ContentModerationService\RegularExpressionsOfBadWords $regularExpressionsOfBadWords
    ) {
        $this->regularExpressionsOfBadWords = $regularExpressionsOfBadWords;
    }

    public static function build(): ContentModerationService\ContainsBadWords
    {
        $regularExpressionsOfBadWordsService = new ContentModerationService\RegularExpressionsOfBadWords();

        return new ContentModerationService\ContainsBadWords(
            $regularExpressionsOfBadWordsService
        );
    }
}
