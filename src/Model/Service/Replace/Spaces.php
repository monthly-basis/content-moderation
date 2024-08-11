<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Replace;

class Spaces
{
    public function replaceSpaces($string): string
    {
        $string = preg_replace('/\s+/', ' ', $string);
        return is_null($string) ? '' : trim($string);
    }
}
