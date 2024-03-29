<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service;

use MonthlyBasis\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class ToHtmlTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceBadWordsServiceMock = $this->createMock(
            ContentModerationService\Replace\BadWords::class
        );
        $this->replaceEmailAddressesServiceMock = $this->createMock(
            ContentModerationService\Replace\EmailAddresses::class
        );
        $this->replaceImmatureWordsServiceMock = $this->createMock(
            ContentModerationService\Replace\ImmatureWords::class
        );
        $this->replaceLineBreaksServiceMock = $this->createMock(
            ContentModerationService\Replace\LineBreaks::class
        );
        $this->replaceSocialMediaServiceMock = $this->createMock(
            ContentModerationService\Replace\SocialMedia::class
        );
        $this->escapeServiceMock = $this->createMock(
            StringService\Escape::class
        );

        $this->toHtmlService = new ContentModerationService\ToHtml(
            $this->replaceBadWordsServiceMock,
            $this->replaceEmailAddressesServiceMock,
            $this->replaceImmatureWordsServiceMock,
            $this->replaceLineBreaksServiceMock,
            $this->replaceSocialMediaServiceMock,
            $this->escapeServiceMock,
        );
    }

    public function test_toHtml_optionsSet_expectedString()
    {
        $string = "string which gets processed by services";

        $this->replaceBadWordsServiceMock
            ->expects($this->once())
            ->method('replaceBadWords')
            ->with($string)
            ->willReturn('replace bad words return value')
            ;
        $this->replaceImmatureWordsServiceMock
            ->expects($this->once())
            ->method('replaceImmatureWords')
            ->with('replace bad words return value')
            ->willReturn('replace immature words return value')
            ;
        $this->replaceEmailAddressesServiceMock
            ->expects($this->once())
            ->method('replaceEmailAddresses')
            ->with('replace immature words return value')
            ->willReturn('replace email addresses return value')
            ;
        $this->replaceSocialMediaServiceMock
            ->expects($this->once())
            ->method('replaceSocialMedia')
            ->with('replace email addresses return value')
            ->willReturn('replace social media return value')
            ;
        $this->replaceLineBreaksServiceMock
            ->expects($this->once())
            ->method('replaceLineBreaks')
            ->with('replace social media return value')
            ->willReturn('replace line breaks return value')
            ;
        $this->escapeServiceMock
            ->expects($this->once())
            ->method('escape')
            ->with('replace line breaks return value')
            ->willReturn(" https://www.jiskha.com &lt;b&gt;bold&lt;/b&gt;\n\n\n\n\n&lt;sup&gt;sup&lt;/sup&gt; https://www.yahoo.com ")
            ;

        $this->assertSame(
            "https://www.jiskha.com <b>bold</b><br>\n<br>\n<sup>sup</sup> https://www.yahoo.com",
            $this->toHtmlService->toHtml(
                string: $string,
                replaceImmatureWords: true,
                replaceSocialMedia: true,
            )
        );
    }

    public function test_toHtml_optionsOmitted_expectedString()
    {
        $string = "string which gets processed by services";

        $this->replaceBadWordsServiceMock
            ->expects($this->once())
            ->method('replaceBadWords')
            ->with($string)
            ->willReturn('replace bad words return value')
            ;
        $this->replaceImmatureWordsServiceMock
            ->expects($this->exactly(0))
            ->method('replaceImmatureWords')
            ;
        $this->replaceEmailAddressesServiceMock
            ->expects($this->once())
            ->method('replaceEmailAddresses')
            ->with('replace bad words return value')
            ->willReturn('replace email addresses return value')
            ;
        $this->replaceSocialMediaServiceMock
            ->expects($this->exactly(0))
            ->method('replaceSocialMedia')
            ;
        $this->replaceLineBreaksServiceMock
            ->expects($this->once())
            ->method('replaceLineBreaks')
            ->with('replace email addresses return value')
            ->willReturn('replace line breaks return value')
            ;
        $this->escapeServiceMock
            ->expects($this->once())
            ->method('escape')
            ->with('replace line breaks return value')
            ->willReturn(" https://www.jiskha.com &lt;b&gt;bold&lt;/b&gt;\n\n\n\n\n&lt;sup&gt;sup&lt;/sup&gt; https://www.yahoo.com ")
            ;

        $this->assertSame(
            "https://www.jiskha.com <b>bold</b><br>\n<br>\n<sup>sup</sup> https://www.yahoo.com",
            $this->toHtmlService->toHtml(
                $string
            )
        );
    }
}
