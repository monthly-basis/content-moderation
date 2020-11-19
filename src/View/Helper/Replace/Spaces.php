<?php
namespace MonthlyBasis\ContentModeration\View\Helper\Replace;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class Spaces extends AbstractHelper
{
    public function __construct(
        ContentModerationService\Replace\Spaces $spacesService
    ) {
        $this->spacesService = $spacesService;
    }

    public function __invoke(string $string): string
    {
        return $this->spacesService->replaceSpaces($string);
    }
}
