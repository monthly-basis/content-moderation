<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ReplaceAndEscape extends AbstractHelper
{
    public function __construct(
        protected ContentModerationService\Replace $replaceService,
        protected StringService\Escape $escapeService,
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

        return $this->escapeService->escape($string);
    }
}
