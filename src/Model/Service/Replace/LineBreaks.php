<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Replace;

class LineBreaks
{
    /**
     * @todo Do we need to use is_null() to check for instances where
     * $string is null?
     */
    public function replaceLineBreaks($string): string
    {
        $string = preg_replace('/\r\n|\n\r|\r|\n/', "\n", $string);
        return is_null($string) ? '' : $string;
    }
}
