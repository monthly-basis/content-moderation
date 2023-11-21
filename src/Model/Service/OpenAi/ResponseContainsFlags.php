<?php
namespace MonthlyBasis\ContentModeration\Model\Service\OpenAi;

class ResponseContainsFlags
{
    public function doesResponseContainFlags(string $response): bool
    {
        $responseArray = json_decode($response, true);
        $resultArray = $responseArray['results'][0];

        if ($resultArray['flagged']) {
            return true;
        }

        foreach ($resultArray['categories'] as $category => $bool) {
            if ($bool) {
                return true;
            }
        }

        foreach ($resultArray['category_scores'] as $category => $score) {
            if ($score > 0.5) {
                return true;
            }
        }

        return false;
    }
}
