<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceEmailService = new ContentModerationService\Replace\Email();
    }

    public function test_replaceEmailAddresses()
    {
        $string = '';
        $this->assertSame(
            $string,
            $this->replaceEmailService->replaceEmailAddresses($string)
        );

        $string = 'hello world';
        $this->assertSame(
            $string,
            $this->replaceEmailService->replaceEmailAddresses($string)
        );

        $string = 'hello test@domain.com world';
        $this->assertSame(
            'hello test world',
            $this->replaceEmailService->replaceEmailAddresses($string)
        );

        $string = 'hello test@domain.com world USER@EXAMPLE.COM';
        $this->assertSame(
            'hello test world USER',
            $this->replaceEmailService->replaceEmailAddresses($string)
        );

        $string = 'foo@example.com';
        $this->assertSame(
            'foo',
            $this->replaceEmailService->replaceEmailAddresses($string)
        );
    }
}
