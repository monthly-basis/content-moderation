<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Contains;

class RepeatingCharacters
{
    public function __construct(
        array $config
    ) {
        $this->config = $config;
    }

    public function containsRepeatingCharacters(string $string): bool
    {
        /*
         * The original pattern to match one character at least 5 times is:
         * $pattern = '/(.)\1{4,}/';
         *
         * This will match any character once followed by at least 4 of the same
         * character.
         *
         * However, with double quotes and variable, backslash must
         * be escaped, and curly braces must surround variable.
         */

        // Match 1 character at least n times.
        $nMinusOne = (int) $this->config[1] - 1;
        $pattern = "/(.)\\1{{$nMinusOne},}/";
        if (preg_match($pattern, $string)) {
            return true;
        }

        return false;
    }
}
