<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class SocialMediaTest extends TestCase
{
    protected function setUp(): void
    {
        $this->socialMediaServiceTest = new ContentModerationService\RegularExpressions\SocialMedia();
    }

    public function test_getRegularExpressions()
    {
        $this->assertIsArray(
            $this->socialMediaServiceTest->getRegularExpressions()
        );
    }
}
