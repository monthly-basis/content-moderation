<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class EmailAddressesTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceEmailAddressesService = new ContentModerationService\Replace\EmailAddresses();
    }

    public function test_replaceEmailAddresses()
    {
        $string = '';
        $this->assertSame(
            $string,
            $this->replaceEmailAddressesService->replaceEmailAddresses($string)
        );

        $string = 'hello world';
        $this->assertSame(
            $string,
            $this->replaceEmailAddressesService->replaceEmailAddresses($string)
        );

        $string = 'hello test@domain.com world';
        $this->assertSame(
            'hello test world',
            $this->replaceEmailAddressesService->replaceEmailAddresses($string)
        );

        $string = 'hello test@domain.com world USER@EXAMPLE.COM';
        $this->assertSame(
            'hello test world USER',
            $this->replaceEmailAddressesService->replaceEmailAddresses($string)
        );

        $string = 'foo@example.com';
        $this->assertSame(
            'foo',
            $this->replaceEmailAddressesService->replaceEmailAddresses($string)
        );
    }
}
