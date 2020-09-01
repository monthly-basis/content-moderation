<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Contains;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class RepeatingCharactersTest extends TestCase
{
    protected function setUp(): void
    {
        $config = require_once($_SERVER['PWD'] . '/config/autoload/local.php');

        $this->containsRepeatingCharactersService = new ContentModerationService\Contains\RepeatingCharacters(
            $config['content-moderation']['contains-repeating-characters']
        );
    }

    public function testContainsRepeatingCharacters()
    {
        // 1 character
        $this->assertFalse(
            $this->containsRepeatingCharactersService->containsRepeatingCharacters('abbccccddd')
        );
        $this->assertTrue(
            $this->containsRepeatingCharactersService->containsRepeatingCharacters('abbcccccddd')
        );
    }
}
