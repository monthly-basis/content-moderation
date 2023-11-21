<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Contains;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class BadWords
{
    public function __construct(
        protected ContentModerationService\OpenAi\InputResultsInFlags $inputResultsInFlagsService,
        protected ContentModerationService\RegularExpressions\BadWords $regularExpressionsOfBadWords,
    ) {
    }

    /**
     * @throws \Exception If checking with Open AI, and if timeout is reached
     *                    while calling Open AI API, then method will
     *                    throw \Exception.
     */
    public function containsBadWords(
        string $string,
        bool $checkWithOpenAi = false
    ): bool {
        $patterns = $this->regularExpressionsOfBadWords
            ->getRegularExpressionsOfBadWords();

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $string)) {
                return true;
            }
        }

        if ($checkWithOpenAi) {
            return $this->inputResultsInFlagsService->doesInputResultInFlags(
                $string
            );
        }

        return false;
    }
}
