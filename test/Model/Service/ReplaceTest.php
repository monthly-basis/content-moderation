<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class ReplaceTest extends TestCase
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
        $this->replaceSocialMediaServiceMock = $this->createMock(
            ContentModerationService\Replace\SocialMedia::class
        );
        $this->replaceSpacesServiceMock = $this->createMock(
            ContentModerationService\Replace\Spaces::class
        );

        $this->replaceService = new ContentModerationService\Replace(
            $this->replaceBadWordsServiceMock,
            $this->replaceEmailAddressesServiceMock,
            $this->replaceImmatureWordsServiceMock,
            $this->replaceSocialMediaServiceMock,
            $this->replaceSpacesServiceMock,
        );
    }

    public function test_replace_allBooleansOmitted_expectedString()
    {
        $string = '👤 🔪 hello world';

        $this->replaceBadWordsServiceMock
            ->expects($this->once())
            ->method('replaceBadWords')
            ->with('  hello world')
            ->willReturn('replace bad words result')
            ;
        $this->replaceImmatureWordsServiceMock
            ->expects($this->once())
            ->method('replaceImmatureWords')
            ->with('replace bad words result')
            ->willReturn('replace immature words result')
            ;
        $this->replaceEmailAddressesServiceMock
            ->expects($this->once())
            ->method('replaceEmailAddresses')
            ->with('replace immature words result')
            ->willReturn('replace email addresses result')
            ;
        $this->replaceSocialMediaServiceMock
            ->expects($this->exactly(0))
            ->method('replaceSocialMedia')
            ;
        $this->replaceSpacesServiceMock
            ->expects($this->once())
            ->method('replaceSpaces')
            ->with('replace email addresses result')
            ->willReturn('replace spaces result')
            ;

        $this->assertSame(
            'replace spaces result',
            $this->replaceService->replace(
                string: $string,
                replacement: '',
            )
        );
    }

    public function test_replace_allBooleansFalse_expectedString()
    {
        $string = '👤 🔪 hello world';

        $this->replaceBadWordsServiceMock
            ->expects($this->once())
            ->method('replaceBadWords')
            ->with('  hello world')
            ->willReturn('replace bad words result')
            ;
        $this->replaceImmatureWordsServiceMock
            ->expects($this->once())
            ->method('replaceImmatureWords')
            ->with('replace bad words result')
            ->willReturn('replace immature words result')
            ;
        $this->replaceEmailAddressesServiceMock
            ->expects($this->once())
            ->method('replaceEmailAddresses')
            ->with('replace immature words result')
            ->willReturn('replace email addresses result')
            ;
        $this->replaceSocialMediaServiceMock
            ->expects($this->exactly(0))
            ->method('replaceSocialMedia')
            ;
        $this->replaceSpacesServiceMock
            ->expects($this->exactly(0))
            ->method('replaceSpaces')
            ;

        $this->assertSame(
            'replace email addresses result',
            $this->replaceService->replace(
                string: $string,
                replacement: '',
                replaceSocialMedia: false,
                replaceSpaces: false,
            )
        );
    }

    public function test_replace_allBooleansTrue_expectedString()
    {
        $string = '👤 🔪 hello world';

        $this->replaceBadWordsServiceMock
            ->expects($this->once())
            ->method('replaceBadWords')
            ->with('  hello world')
            ->willReturn('replace bad words result')
            ;
        $this->replaceImmatureWordsServiceMock
            ->expects($this->once())
            ->method('replaceImmatureWords')
            ->with('replace bad words result')
            ->willReturn('replace immature words result')
            ;
        $this->replaceEmailAddressesServiceMock
            ->expects($this->once())
            ->method('replaceEmailAddresses')
            ->with('replace immature words result')
            ->willReturn('replace email addresses result')
            ;
        $this->replaceSocialMediaServiceMock
            ->expects($this->once())
            ->method('replaceSocialMedia')
            ->with('replace email addresses result')
            ->willReturn('replace social media result')
            ;
        $this->replaceSpacesServiceMock
            ->expects($this->once())
            ->method('replaceSpaces')
            ->with('replace social media result')
            ->willReturn('replace spaces result')
            ;

        $this->assertSame(
            'replace spaces result',
            $this->replaceService->replace(
                string: $string,
                replacement: '',
                replaceSocialMedia: true,
                replaceSpaces: true,
            )
        );
    }
}
