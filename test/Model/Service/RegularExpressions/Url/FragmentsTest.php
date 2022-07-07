<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\RegularExpressions\Url;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class FragmentsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->fragmentsServiceTest = new ContentModerationService\RegularExpressions\Url\Fragments();
    }

    public function test_getRegularExpressions()
    {
        $this->assertIsArray(
            $this->fragmentsServiceTest->getRegularExpressions()
        );
    }
}
