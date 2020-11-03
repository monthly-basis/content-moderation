<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Contains;

class Email
{
    public function containsEmailAddress($string): bool
    {
        $pattern = '/(\b[A-Z0-9._%+-]+)@[A-Z0-9.-]+\.[A-Z]{2,}\b/i';
        return preg_match($pattern, $string);
    }
}
