<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Replace;

class EmailAddresses
{
    public function replaceEmailAddresses($string): string
    {
        $pattern = '/(\b[A-Z0-9._%+-]+)@[A-Z0-9.-]+\.[A-Z]{2,}\b/i';
        return preg_replace($pattern, '$1', $string);
    }
}
