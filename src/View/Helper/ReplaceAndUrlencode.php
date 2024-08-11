<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ReplaceAndUrlEncode extends AbstractHelper
{
    public function __construct(
        protected ContentModerationService\Replace $replaceService,
    ) {}

    public function __invoke(
        string $string,
        string $replacement = '',
        bool $replaceSocialMedia = false,
        bool $replaceSpaces = false,
    ): string {
        $string = $this->replaceService->replace(
            string: $string,
            replacement: $replacement,
            replaceSocialMedia: $replaceSocialMedia,
            replaceSpaces: $replaceSpaces,
        );

        return urlencode($string);
    }
}
