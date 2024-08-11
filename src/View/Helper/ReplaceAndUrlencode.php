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
    ): string {
        $string = $this->replaceService->replace(
            string: $string,
            replacement: $replacement,
            replaceSocialMedia: $replaceSocialMedia,
        );

        return urlencode($string);
    }
}
