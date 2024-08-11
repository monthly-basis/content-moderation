<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Contains\Url;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class FragmentsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->regularExpressionsOfUrlFragmentsService = new ContentModerationService\RegularExpressions\Url\Fragments();

        $this->containsUrlFragmentsService = new ContentModerationService\Contains\Url\Fragments(
            $this->regularExpressionsOfUrlFragmentsService
        );
    }

    public function test_containsUrlFragments()
    {
        $this->assertFalse(
            $this->containsUrlFragmentsService->containsUrlFragments('hello world')
        );

        /*
         * http
         */
        $this->assertTrue(
            $this->containsUrlFragmentsService->containsUrlFragments('http hello world')
        );

        /*
         * .com
         */
        $this->assertTrue(
            $this->containsUrlFragmentsService->containsUrlFragments('.com')
        );
        $this->assertTrue(
            $this->containsUrlFragmentsService->containsUrlFragments('.𝐜𝐨𝐦')
        );
        $this->assertTrue(
            $this->containsUrlFragmentsService->containsUrlFragments('.𝙘𝙤𝙢')
        );
    }
}
