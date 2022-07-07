<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Contains\Url;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class Fragments
{
    public function __construct(
        ContentModerationService\RegularExpressions\Url\Fragments $fragmentsService
    ) {
        $this->fragmentsService = $fragmentsService;
    }

    public function containsUrlFragments(
        string $string
    ): bool {
        $patterns = $this->fragmentsService->getRegularExpressions();

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $string)) {
                return true;
            }
        }

        return false;
    }
}
